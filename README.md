# La Cuponera SV: Fase 1

Aplicación web en PHP, con un MVC propio y sin framework, para vender cupones de descuento. Esta fase incluye el acceso de empresas, clientes y administradores, la aprobación de empresas y la recuperación de contraseña.

## Requisitos

- PHP 8.2 o superior, con las extensiones `pdo_mysql` y `mbstring`
- MySQL 8 o MariaDB 10.5 o superior

En macOS, con Homebrew:

```bash
brew install php mariadb
brew services start mariadb
```

## Instalación

1. Crea la base de datos y el usuario de la aplicación. Ejecuta estas sentencias con `mariadb -u root -p` o con un usuario que tenga permisos para crear bases de datos:

   ```sql
   CREATE DATABASE lacuponerasv CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   CREATE USER 'cupon_app'@'localhost' IDENTIFIED BY 'cupon_app_dev';
   GRANT ALL PRIVILEGES ON lacuponerasv.* TO 'cupon_app'@'localhost';
   ```

2. Desde la carpeta del proyecto, crea las tablas y el administrador inicial:

   ```bash
   php database/setup.php
   ```

   El administrador inicial es `admin` con la contraseña `Admin12345`. Para usar otra, define `ADMIN_PASSWORD` antes de ejecutar el comando.

3. Inicia el servidor de desarrollo:

   ```bash
   php -S localhost:8000 -t public
   ```

4. Abre http://localhost:8000

La conexión a la base de datos se configura con las variables `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER` y `DB_PASS`. Si no las defines, la aplicación usa los valores de `config/config.php`, pensados para desarrollo local.

## Cómo probar la aplicación

### Pruebas automáticas

```bash
php tests/run.php
```

El comando ejecuta 26 pruebas de las reglas de validación: NIT, DUI, teléfono, usuario, contraseña, mayoría de edad, comisión y formato de los datos. El resultado esperado es `26 correctas, 0 fallidas.`, con código de salida 0.

### Pruebas manuales

Con el servidor en marcha, sigue estos pasos en el navegador. Cada paso indica qué debe pasar.

1. Iniciar sesión como administrador. Entra con `admin` y `Admin12345`. Debe aparecer el panel con cuatro indicadores.
2. Probar una contraseña incorrecta. Debe aparecer el mensaje "Usuario o contraseña incorrectos.", sin indicar cuál de los dos datos falló.
3. Dar formato al NIT. Abre el registro de empresa y escribe `0614010101011` en el campo NIT. El campo debe mostrar `0614-010101-011`. Si sales del campo antes de completarlo, aparece el error de formato.
4. Registrar una empresa. Completa el formulario con un NIT de 14 dígitos, un teléfono de 8 dígitos, un usuario de 4 a 20 caracteres y una contraseña con letras y números. Debe aparecer "Solicitud enviada" y la página debe volver al login.
5. Revisar la solicitud como empresa. Inicia sesión con la empresa. El panel debe mostrar el estado "Pendiente".
6. Aprobar la empresa. Como administrador, abre Empresas, escribe `12.5` en la comisión y pulsa Aprobar. Debe aparecer "Empresa ... aprobada con 12.5% de comisión." y el estado debe cambiar a "Aprobada". El navegador no deja enviar valores fuera de 0 a 100, y el servidor también los rechaza.
7. Probar la validación de edad. Abre el registro de cliente y escribe una fecha de nacimiento de hace 10 años. Al salir del campo debe aparecer "Debes tener al menos 18 años.".
8. Registrar un cliente. Usa una fecha de nacimiento válida y completa el resto del formulario. Debe aparecer el mensaje de cuenta creada y poder iniciar sesión.
9. Revisar el control de acceso. Con la cuenta de cliente abierta, entra a `/admin/empresas`. Debe aparecer el error 403.
10. Recuperar la contraseña. En `/password/olvide`, escribe el correo de la empresa. El mensaje es el mismo exista o no el correo. Abre `storage/logs/mail.log`, copia el enlace y ábrelo. Escribe una nueva contraseña. Debe aparecer "Contraseña actualizada". Si vuelves a abrir el mismo enlace, debe aparecer "El enlace no es válido o ya venció.".
11. Quitar errores al corregirlos. Envía un formulario con datos incorrectos. Corrige un campo marcado en rojo: el mensaje debe desaparecer en cuanto el valor sea válido, sin reenviar el formulario.
12. Probar una página inexistente. Abre `/no-existe`. Debe aparecer el error 404.

### Reiniciar los datos de prueba

Para borrar todo y empezar de cero, elimina la base de datos y repite la instalación. Esta acción borra todos los datos.

```bash
mariadb -u root -p -e "DROP DATABASE lacuponerasv;"
```

Después vuelve a ejecutar las sentencias del paso 1 de la instalación y el comando `php database/setup.php`.

## Solución de problemas

- `Access denied for user 'cupon_app'`. Revisa el usuario y la contraseña en `config/config.php` o en las variables `DB_*`, y confirma que el usuario tiene permisos sobre la base de datos.
- `could not find driver`. Falta la extensión `pdo_mysql`. Revisa qué archivo `php.ini` usa PHP con `php --ini` y activa la extensión.
- La página aparece sin estilos. Confirma que el servidor usa `-t public`. Si cambiaste de puerto, recarga la página sin caché (⌘⇧R en macOS).
- No aparece el enlace de recuperación. Con `MAIL_DRIVER=log`, que es el valor por defecto, el enlace se escribe en `storage/logs/mail.log`. Revisa que esa carpeta exista.
- Error 500. Consulta `storage/logs/app.log`. Con `APP_DEBUG=true`, que es el valor por defecto, la página muestra el detalle del error.

## Roles y funcionalidades

| Rol | Puede |
|---|---|
| Administrador | Revisar, aprobar (con porcentaje de comisión) o rechazar empresas. Crear otros administradores. |
| Empresa | Registrarse, esperar la aprobación y ver el estado de su solicitud. |
| Cliente | Registrarse (con más de 18 años) y ver sus datos. |

Todos los usuarios pueden iniciar sesión y recuperar su contraseña.

## Recuperación de contraseña

El enlace vence en 1 hora y solo sirve una vez. En desarrollo, `MAIL_DRIVER=log` escribe los correos en `storage/logs/mail.log`. Para enviarlos con la función `mail()` de PHP, usa `MAIL_DRIVER=mail`.

## Estructura del proyecto

```
app/
  Core/         Router, Controller, View, Validator, Auth, Session, Csrf, Database, Mailer
  Controllers/  AuthController, RegistroController, PasswordController, DashboardController, AdminController
  Models/       User, Empresa, Cliente, PasswordReset
  Views/        Plantillas: layouts, auth, registro, password, dashboard, admin y errors
  helpers.php   Funciones para las vistas: e, url, field, old, csrf_field
config/         config.php
database/       schema.sql y setup.php
public/         index.php (punto de entrada), CSS y JavaScript de los formularios
routes/         web.php, con todas las rutas
storage/logs/   Registros de la aplicación y de los correos (no se versionan)
tests/          run.php, con las pruebas de validación
docs/           trello_tasks.md, con las tareas de la Fase 1 para Trello
```

## Seguridad

- Las contraseñas se guardan con `password_hash` y se verifican con `password_verify`.
- Todos los formularios POST llevan un token CSRF. Un POST sin token responde 419.
- Las consultas usan PDO con sentencias preparadas.
- Los tokens de recuperación se guardan como hash SHA-256. El token en claro solo aparece en el enlace del correo.
- Las cookies de sesión son `HttpOnly` y `SameSite=Lax`.
- Las rutas de administrador exigen el rol `administrador`. Si el rol no coincide, responde 403.
- El login muestra el mismo mensaje si el usuario o la contraseña son incorrectos.

## Fuera de alcance de la Fase 1

La Fase 2 incluirá el catálogo público de cupones, la publicación de ofertas, la compra con tarjeta simulada, la factura con código único, el historial de compras y los reportes del administrador.
