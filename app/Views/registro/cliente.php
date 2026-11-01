<section class="card">
    <h1>Registro de cliente</h1>
    <p class="muted">Debes tener al menos 18 años para registrarte.</p>

    <form method="post" action="<?= e(url('/registro/cliente')) ?>" novalidate>
        <?= csrf_field() ?>

        <h2>Datos personales</h2>
        <div class="grid-2">
            <?= field('nombre', 'Nombre completo', 'text', ['required' => '', 'maxlength' => '100', 'data-rules' => 'required']) ?>
            <?= field('apellidos', 'Apellidos', 'text', ['required' => '', 'maxlength' => '100', 'data-rules' => 'required']) ?>
            <?= field('dui', 'DUI', 'text', ['required' => '', 'placeholder' => '01234567-8', 'inputmode' => 'numeric', 'data-mask' => 'dui', 'data-rules' => 'required|dui']) ?>
            <?= field('fecha_nacimiento', 'Fecha de nacimiento', 'date', ['required' => '', 'data-rules' => 'required|date|adult']) ?>
        </div>

        <h2>Datos de acceso</h2>
        <div class="grid-2">
            <?= field('correo', 'Correo electrónico', 'email', ['required' => '', 'maxlength' => '150', 'data-rules' => 'required|email']) ?>
            <?= field('usuario', 'Usuario', 'text', ['required' => '', 'autocomplete' => 'username', 'data-rules' => 'required|username']) ?>
            <?= field('password', 'Contraseña', 'password', ['required' => '', 'autocomplete' => 'new-password', 'data-rules' => 'required|password']) ?>
            <?= field('password_confirmation', 'Confirmar contraseña', 'password', ['required' => '', 'autocomplete' => 'new-password', 'data-rules' => 'required|same:password']) ?>
        </div>

        <button type="submit" class="btn">Crear cuenta</button>
    </form>
</section>
