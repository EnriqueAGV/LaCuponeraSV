# Tareas de la Fase 1 para Trello: La Cuponera SV

Proyecto de cátedra **Lenguajes Interpretados en el Servidor (LIS941)**, Fase 1 (25 %).
Entrega y defensas: **26 al 31 de octubre**. Grupo de hasta 5 personas.

## Cómo cargar el tablero

1. Crea un tablero en Trello con estas listas, en este orden: **Backlog**, **Por hacer**, **En progreso**, **Hecho**.
2. Crea una etiqueta por cada área: `Documentación`, `Base de datos`, `Backend`, `Seguridad`, `Frontend`, `Pruebas`, `Entrega`.
3. Crea cada tarjeta con el título y la descripción de esta lista. Los puntos marcados como `[x]` van en la lista **Hecho**; los demás, en **Por hacer**.
4. Copia cada checklist a la tarjeta correspondiente.

Las tarjetas marcadas como **Hecho** ya están implementadas en el código del repositorio (`lacuponerasv/`). Se verificaron con pruebas unitarias y con un recorrido completo del flujo.

## Requerimientos identificados

Se usan en el documento de la Fase 1 y en el backlog.

**Funcionales**

| ID | Requerimiento |
|---|---|
| RF-01 | Login para empresas, clientes y administradores, con usuario o correo. |
| RF-02 | Cierre de sesión. |
| RF-03 | Registro de empresas: nombre, NIT, dirección, teléfono, correo, usuario y contraseña. La solicitud queda pendiente. |
| RF-04 | El administrador aprueba o rechaza empresas. Al aprobar define el porcentaje de comisión por cupón (0 a 100). |
| RF-05 | Registro de clientes: usuario, correo, contraseña, nombre, apellidos, DUI y fecha de nacimiento. Debe tener más de 18 años. |
| RF-06 | Un administrador crea otros administradores. |
| RF-07 | Recuperación de contraseña para todos los tipos de usuario. |
| RF-08 | Panel diferente para administrador, empresa y cliente. |
| RF-09 | Validación de formularios con mensajes de error claros. |

**No funcionales**

| ID | Requerimiento |
|---|---|
| RNF-01 | Seguridad: contraseñas con hash, protección CSRF, consultas preparadas, control de acceso por rol. |
| RNF-02 | Diseño responsive y legible, con modo oscuro. |
| RNF-03 | PHP con MVC propio y MySQL/MariaDB. |
| RNF-04 | Código separado en capas: Core, Controllers, Models y Views. |
| RNF-05 | Pruebas de validación ejecutables con un comando. |

---

## Resumen de tarjetas

| ID | Tarjeta | Lista | Etiqueta |
|---|---|---|---|
| F1-01 | Elegir metodología (Scrum o Kanban) | Por hacer | Documentación |
| F1-02 | Documentar requerimientos funcionales y no funcionales | Por hacer | Documentación |
| F1-03 | Crear tablero Trello con backlog, progreso y realizados | Por hacer | Documentación |
| F1-04 | Carátula del documento | Por hacer | Documentación |
| F1-05 | Redactar documento de la Fase 1 con APA 7 | Por hacer | Documentación |
| F1-06 | Diagrama relacional y descripción de tablas | Por hacer | Base de datos |
| F1-07 | Capturas de pantalla de la aplicación | Por hacer | Documentación |
| F1-08 | Repositorio en GitHub o GitLab y acceso al docente | Por hacer | Entrega |
| F1-10 | Esquema de base de datos | Hecho | Base de datos |
| F1-11 | Script de instalación y administrador inicial | Hecho | Base de datos |
| F1-12 | Configuración por variables de entorno | Hecho | Backend |
| F1-20 | Front controller y autoload | Hecho | Backend |
| F1-21 | Router con parámetros y errores 404 y 405 | Hecho | Backend |
| F1-22 | Layout base con mensajes flash | Hecho | Frontend |
| F1-23 | Sesiones seguras | Hecho | Seguridad |
| F1-24 | Protección CSRF en formularios | Hecho | Seguridad |
| F1-25 | Motor de validación | Hecho | Backend |
| F1-26 | Acceso a datos con PDO y transacciones | Hecho | Backend |
| F1-30 | Login de empresas, clientes y administradores | Hecho | Backend |
| F1-31 | Cierre de sesión | Hecho | Backend |
| F1-32 | Control de acceso por rol | Hecho | Seguridad |
| F1-40 | Registro de empresas | Hecho | Backend |
| F1-41 | Registro de clientes con validación de edad | Hecho | Backend |
| F1-42 | Validación de duplicados | Hecho | Backend |
| F1-50 | Listado de solicitudes de empresas | Hecho | Frontend |
| F1-51 | Aprobar empresa con comisión | Hecho | Backend |
| F1-52 | Rechazar empresa | Hecho | Backend |
| F1-53 | Impedir reprocesar solicitudes | Hecho | Backend |
| F1-54 | Crear administradores | Hecho | Backend |
| F1-55 | Panel del administrador | Hecho | Frontend |
| F1-60 | Panel de empresa | Hecho | Frontend |
| F1-61 | Panel de cliente | Hecho | Frontend |
| F1-70 | Solicitar enlace de recuperación | Hecho | Backend |
| F1-71 | Token seguro y envío de correo | Hecho | Seguridad |
| F1-72 | Restablecer contraseña | Hecho | Backend |
| F1-73 | Respuesta genérica al solicitar enlace | Hecho | Seguridad |
| F1-74 | Envío de correo real por SMTP | Por hacer | Backend |
| F1-80 | Pruebas unitarias de validación | Hecho | Pruebas |
| F1-81 | Prueba de integración del flujo completo | Por hacer | Pruebas |
| F1-82 | Revisión de diseño en celular (375 px) | Por hacer | Frontend |
| F1-83 | Revisión de seguridad | Por hacer | Seguridad |
| F1-84 | Páginas de error 403, 404, 419 y 500 | Hecho | Frontend |
| F1-90 | Preparar demo para la defensa | Por hacer | Entrega |
| F1-91 | Subir la entrega antes del 31 de octubre | Por hacer | Entrega |

---

## Documentación

### F1-01 · Elegir metodología (Scrum o Kanban)
- **Lista:** Por hacer · **Etiqueta:** Documentación
- **Descripción:** Comparar Scrum y Kanban y justificar la elección en el documento.
- **Checklist:**
  - [ ] Cuadro comparativo de Scrum y Kanban (roles, eventos, tablero, ritmo de entrega)
  - [ ] Elegir una metodología y justificarla con al menos 2 razones
  - [ ] Incluir el cuadro y la justificación en el documento

### F1-02 · Documentar requerimientos funcionales y no funcionales
- **Lista:** Por hacer · **Etiqueta:** Documentación
- **Descripción:** Usar la tabla de la sección *Requerimientos identificados* de este archivo.
- **Checklist:**
  - [ ] Pasar RF-01 a RF-09 y RNF-01 a RNF-05 al documento
  - [ ] Revisar que cada requerimiento tenga una tarjeta del tablero

### F1-03 · Crear tablero Trello con backlog, progreso y realizados
- **Lista:** Por hacer · **Etiqueta:** Documentación
- **Descripción:** Cargar las tarjetas de este archivo. Compartir el tablero con el docente.
- **Checklist:**
  - [ ] Crear las listas Backlog, Por hacer, En progreso y Hecho
  - [ ] Cargar todas las tarjetas
  - [ ] Compartir el tablero y copiar el enlace en el documento

### F1-04 · Carátula del documento
- **Lista:** Por hacer · **Etiqueta:** Documentación
- **Descripción:** Carátula con institución, nombre de la materia, nombre del proyecto e integrantes.
- **Checklist:**
  - [ ] Institución: Universidad Don Bosco, UDB Virtual
  - [ ] Materia: Lenguajes Interpretados en el Servidor LIS941
  - [ ] Proyecto: La Cuponera SV, Fase 1
  - [ ] Integrantes

### F1-05 · Redactar documento de la Fase 1 con APA 7
- **Lista:** Por hacer · **Etiqueta:** Documentación
- **Descripción:** El documento tiene orden, ortografía, gramática y citas en APA 7 con fuentes confiables. Debe ser original y tener menos de 50 % de probabilidad de IA.
- **Checklist:**
  - [ ] Metodología (F1-01)
  - [ ] Requerimientos (F1-02)
  - [ ] Enlace al tablero (F1-03)
  - [ ] Diagrama y tablas (F1-06)
  - [ ] Capturas de pantalla (F1-07)
  - [ ] Enlace al repositorio (F1-08)
  - [ ] Revisión de ortografía y citas

### F1-06 · Diagrama relacional y descripción de tablas
- **Lista:** Por hacer · **Etiqueta:** Base de datos
- **Descripción:** Generar el diagrama con una herramienta (dbdiagram.io, MySQL Workbench o similar) a partir de `database/schema.sql`. Describir cada tabla.
- **Checklist:**
  - [ ] Diagrama exportado como imagen (PNG o PDF)
  - [ ] Tabla `users`: usuario, correo, hash de contraseña, rol y estado
  - [ ] Tabla `empresas`: datos de la empresa, estado y comisión
  - [ ] Tabla `clientes`: datos personales y DUI
  - [ ] Tabla `password_resets`: hash del token, vencimiento y uso
  - [ ] Relaciones con su cardinalidad (1 a 1 entre users y empresas o clientes)

### F1-07 · Capturas de pantalla de la aplicación
- **Lista:** Por hacer · **Etiqueta:** Documentación
- **Descripción:** Al menos 5 pantallas distintas al login y al registro.
- **Checklist:**
  - [ ] Login
  - [ ] Registro de empresa
  - [ ] Registro de cliente
  - [ ] Panel del administrador
  - [ ] Listado y aprobación de empresas
  - [ ] Panel de empresa o de cliente
  - [ ] Formulario de recuperación de contraseña

### F1-08 · Repositorio en GitHub o GitLab y acceso al docente
- **Lista:** Por hacer · **Etiqueta:** Entrega
- **Descripción:** Subir el proyecto y compartirlo con el docente. El usuario indicado en el enunciado es `@AcostaGTR`.
- **Checklist:**
  - [ ] Crear el repositorio y subir el código (sin `storage/logs/` ni `.env`)
  - [ ] Compartir el repositorio con `@AcostaGTR`
  - [ ] Confirmar que el enlace abre sin iniciar sesión (o con acceso concedido)

---

## Base de datos

### F1-10 · Esquema de base de datos
- **Lista:** Hecho · **Etiqueta:** Base de datos
- **Descripción:** Tablas `users`, `empresas`, `clientes` y `password_resets` en `database/schema.sql`.
- **Checklist:**
  - [x] Claves foráneas con `ON DELETE CASCADE`
  - [x] Campos únicos: usuario, correo, NIT y DUI
  - [x] Estado de empresa con valores `pendiente`, `aprobada` y `rechazada`

### F1-11 · Script de instalación y administrador inicial
- **Lista:** Hecho · **Etiqueta:** Base de datos
- **Descripción:** `php database/setup.php` crea el esquema y el administrador inicial si no existe.
- **Checklist:**
  - [x] Se puede ejecutar varias veces sin error
  - [x] La contraseña inicial sale de la variable `ADMIN_PASSWORD`

### F1-12 · Configuración por variables de entorno
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Valores de base de datos, correo y URL en `config/config.php`, con valores por defecto para desarrollo.
- **Checklist:**
  - [x] Variables `DB_*`, `APP_URL`, `MAIL_DRIVER` y `ADMIN_PASSWORD`

---

## Núcleo MVC

### F1-20 · Front controller y autoload
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** `public/index.php` es el único punto de entrada. `app/bootstrap.php` registra el autoload con namespace `App\`.
- **Checklist:**
  - [x] Iniciar sesión y validar CSRF antes de despachar la ruta
  - [x] Capturar excepciones y responder 500 sin mostrar detalles en producción

### F1-21 · Router con parámetros y errores 404 y 405
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Rutas en `routes/web.php`. Admite parámetros como `{id}`.
- **Checklist:**
  - [x] GET y POST por ruta
  - [x] 404 si la ruta no existe y 405 si el método no coincide

### F1-22 · Layout base con mensajes flash
- **Lista:** Hecho · **Etiqueta:** Frontend
- **Descripción:** Plantilla común con menú según el rol, mensajes de éxito y de error.
- **Checklist:**
  - [x] Menú distinto para visitantes, clientes, empresas y administradores
  - [x] Mensajes que sobreviven una redirección y se muestran una vez

### F1-23 · Sesiones seguras
- **Lista:** Hecho · **Etiqueta:** Seguridad
- **Descripción:** Cookies de sesión `HttpOnly` y `SameSite=Lax`, con regeneración del ID al iniciar sesión.
- **Checklist:**
  - [x] `session_regenerate_id` en el login
  - [x] `session.use_strict_mode` activado

### F1-24 · Protección CSRF en formularios
- **Lista:** Hecho · **Etiqueta:** Seguridad
- **Descripción:** Cada formulario POST incluye un token. Un POST sin token responde 419.
- **Checklist:**
  - [x] Token aleatorio de 64 caracteres guardado en la sesión
  - [x] Comparación con `hash_equals`

### F1-25 · Motor de validación
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Reglas `required`, `email`, `min`, `max`, `username`, `password`, `nit`, `dui`, `phone`, `date`, `adult`, `same`, `numeric` y `between`. Los mensajes están en español.
- **Checklist:**
  - [x] NIT con formato ####-######-###-#
  - [x] DUI con formato ########-#
  - [x] Teléfono con formato ####-####
  - [x] Contraseña de 8 caracteres o más con letra y número
  - [x] Un solo mensaje por campo

### F1-26 · Acceso a datos con PDO y transacciones
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Modelos `User`, `Empresa`, `Cliente` y `PasswordReset` con sentencias preparadas. El registro de empresas y clientes usa transacción.
- **Checklist:**
  - [x] `ATTR_EMULATE_PREPARES` desactivado
  - [x] Si falla el insert del perfil, no queda un usuario sin perfil

---

## Autenticación y roles

### F1-30 · Login de empresas, clientes y administradores
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Login con usuario o correo. Redirige al panel.
- **Checklist:**
  - [x] Verificación con `password_verify`
  - [x] Mismo mensaje si el usuario o la contraseña son incorrectos

### F1-31 · Cierre de sesión
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Botón de salir en el menú. Usa POST con token.
- **Checklist:**
  - [x] Destruye la sesión y redirige al login

### F1-32 · Control de acceso por rol
- **Lista:** Hecho · **Etiqueta:** Seguridad
- **Descripción:** Las rutas de administrador exigen el rol `administrador`. Sin sesión redirige al login y con rol incorrecto responde 403.
- **Checklist:**
  - [x] Cliente que entra a `/admin/empresas` recibe 403
  - [x] Visitante que entra a `/dashboard` va al login

---

## Registro

### F1-40 · Registro de empresas
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Formulario de empresa con datos de la empresa y de acceso. La cuenta se crea con estado `pendiente`.
- **Checklist:**
  - [x] Campos: nombre, NIT, dirección, teléfono, correo, usuario, contraseña
  - [x] Se normalizan NIT y teléfono antes de guardar

### F1-41 · Registro de clientes con validación de edad
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Formulario de cliente. No permite registrar menores de 18 años.
- **Checklist:**
  - [x] Fecha inválida o menor de edad muestra error en el campo
  - [x] Campos: nombre, apellidos, DUI, fecha de nacimiento, usuario, correo y contraseña

### F1-42 · Validación de duplicados
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Revisa usuario, correo, NIT y DUI antes de guardar.
- **Checklist:**
  - [x] Muestra el mensaje en el campo repetido
  - [x] Conserva los demás datos escritos en el formulario

---

## Administración

### F1-50 · Listado de solicitudes de empresas
- **Lista:** Hecho · **Etiqueta:** Frontend
- **Descripción:** Tabla con todas las empresas. Las pendientes aparecen primero.
- **Checklist:**
  - [x] Muestra NIT, contacto, estado y comisión

### F1-51 · Aprobar empresa con comisión
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Al aprobar, el administrador define el porcentaje de comisión por cupón.
- **Checklist:**
  - [x] Acepta valores de 0 a 100
  - [x] Guarda el administrador que aprobó

### F1-52 · Rechazar empresa
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Cambia el estado a `rechazada`.
- **Checklist:**
  - [x] Muestra un mensaje de confirmación después de rechazar

### F1-53 · Impedir reprocesar solicitudes
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Una empresa aprobada o rechazada no puede cambiar de estado.
- **Checklist:**
  - [x] Muestra el mensaje "Esa solicitud ya fue procesada."

### F1-54 · Crear administradores
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Un administrador crea otro administrador desde su panel.
- **Checklist:**
  - [x] Valida usuario, correo y contraseña igual que en el registro
  - [x] Muestra la lista de administradores actuales

### F1-55 · Panel del administrador
- **Lista:** Hecho · **Etiqueta:** Frontend
- **Descripción:** Indicadores de empresas pendientes, aprobadas, rechazadas y de administradores.
- **Checklist:**
  - [x] Enlaces a las pantallas de empresas y administradores

---

## Paneles por rol

### F1-60 · Panel de empresa
- **Lista:** Hecho · **Etiqueta:** Frontend
- **Descripción:** Muestra el estado de la solicitud y los datos registrados.
- **Checklist:**
  - [x] Mensaje distinto para pendiente, aprobada y rechazada

### F1-61 · Panel de cliente
- **Lista:** Hecho · **Etiqueta:** Frontend
- **Descripción:** Muestra los datos personales. El historial de compras se deja para la Fase 2.
- **Checklist:**
  - [x] Muestra nombre, DUI, fecha de nacimiento y correo

---

## Recuperación de contraseña

### F1-70 · Solicitar enlace de recuperación
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Formulario con el correo de la cuenta.
- **Checklist:**
  - [x] Valida el formato del correo

### F1-71 · Token seguro y envío de correo
- **Lista:** Hecho · **Etiqueta:** Seguridad
- **Descripción:** Token de 64 caracteres hexadecimales. Solo se guarda su hash SHA-256. Vence en 1 hora.
- **Checklist:**
  - [x] Crear un enlace nuevo invalida los anteriores
  - [x] El correo se escribe en `storage/logs/mail.log` con `MAIL_DRIVER=log`

### F1-72 · Restablecer contraseña
- **Lista:** Hecho · **Etiqueta:** Backend
- **Descripción:** Formulario de nueva contraseña con confirmación.
- **Checklist:**
  - [x] Un enlace solo se usa una vez
  - [x] Un enlace vencido o inválido muestra error

### F1-73 · Respuesta genérica al solicitar enlace
- **Lista:** Hecho · **Etiqueta:** Seguridad
- **Descripción:** El mensaje es el mismo exista o no el correo, para no revelar cuentas.
- **Checklist:**
  - [x] Mismo mensaje y misma redirección en ambos casos

### F1-74 · Envío de correo real por SMTP
- **Lista:** Por hacer · **Etiqueta:** Backend
- **Descripción:** Hoy `Mailer` usa `mail()` o un registro en archivo. Falta conectar un servidor SMTP real.
- **Checklist:**
  - [ ] Elegir servicio SMTP de prueba
  - [ ] Probar el envío desde la recuperación de contraseña

---

## Pruebas y calidad

### F1-80 · Pruebas unitarias de validación
- **Lista:** Hecho · **Etiqueta:** Pruebas
- **Descripción:** `php tests/run.php` ejecuta 26 pruebas sobre NIT, DUI, teléfono, usuario, contraseña, edad, comisión y formato.
- **Checklist:**
  - [x] Todas las pruebas pasan

### F1-81 · Prueba de integración del flujo completo
- **Lista:** Por hacer · **Etiqueta:** Pruebas
- **Descripción:** Recorrer el flujo completo con curl contra el servidor local: login, registro, aprobación, login de empresa, acceso denegado, nuevo administrador y recuperación de contraseña.
- **Checklist:**
  - [ ] Pasar el script de prueba a `tests/integration.sh` dentro del repositorio
  - [ ] Ejecutarlo antes de cada entrega

### F1-82 · Revisión de diseño en celular (375 px)
- **Lista:** Por hacer · **Etiqueta:** Frontend
- **Descripción:** Revisar que todas las pantallas se ven bien en un celular sin desplazamiento horizontal.
- **Checklist:**
  - [ ] Login y registros
  - [ ] Tabla de empresas (se desplaza dentro de su contenedor)
  - [ ] Menú superior

### F1-83 · Revisión de seguridad
- **Lista:** Por hacer · **Etiqueta:** Seguridad
- **Descripción:** Revisión final de la lista de verificación de seguridad.
- **Checklist:**
  - [ ] Escapar toda salida con `e()`
  - [ ] Confirmar que no hay consultas con concatenación
  - [ ] Confirmar que las rutas de administrador tienen `requireRole`
  - [ ] Confirmar que `storage/logs/` no se sube al repositorio

### F1-84 · Páginas de error 403, 404, 419 y 500
- **Lista:** Hecho · **Etiqueta:** Frontend
- **Descripción:** Página de error con mensaje y enlace al inicio.
- **Checklist:**
  - [x] 403 para rol incorrecto
  - [x] 404 para rutas inexistentes
  - [x] 419 para formularios sin token
  - [x] 500 con mensaje oculto cuando `APP_DEBUG=false`

---

## Entrega y defensa

### F1-90 · Preparar demo para la defensa
- **Lista:** Por hacer · **Etiqueta:** Entrega
- **Descripción:** La defensa se hace por videoconferencia. El docente la programa.
- **Checklist:**
  - [ ] Demo de cada flujo en orden: login, registro, aprobación, recuperación
  - [ ] Cada integrante puede explicar al menos una parte del código
  - [ ] Preguntas frecuentes preparadas (validación, seguridad, roles)

### F1-91 · Subir la entrega antes del 31 de octubre
- **Lista:** Por hacer · **Etiqueta:** Entrega
- **Descripción:** Entregar el documento, el enlace al tablero y el enlace al repositorio.
- **Checklist:**
  - [ ] Documento con carátula, metodología, requerimientos, tablero, diagrama, capturas y repositorio
  - [ ] Enlaces verificados
