<section class="card">
    <h1>Registro de empresa ofertante</h1>
    <p class="muted">Tu solicitud será revisada por un administrador antes de que puedas publicar ofertas.</p>

    <form method="post" action="<?= e(url('/registro/empresa')) ?>" novalidate>
        <?= csrf_field() ?>

        <h2>Datos de la empresa</h2>
        <div class="grid-2">
            <?= field('nombre', 'Nombre de la empresa', 'text', ['required' => '', 'maxlength' => '150', 'data-rules' => 'required']) ?>
            <?= field('nit', 'NIT', 'text', ['required' => '', 'placeholder' => '0614-010101-101-1', 'inputmode' => 'numeric', 'data-mask' => 'nit', 'data-rules' => 'required|nit']) ?>
            <?= field('direccion', 'Dirección', 'text', ['required' => '', 'maxlength' => '255', 'data-rules' => 'required']) ?>
            <?= field('telefono', 'Teléfono', 'text', ['required' => '', 'placeholder' => '2222-3333', 'inputmode' => 'numeric', 'data-mask' => 'phone', 'data-rules' => 'required|phone']) ?>
        </div>

        <h2>Datos de acceso</h2>
        <div class="grid-2">
            <?= field('correo', 'Correo electrónico', 'email', ['required' => '', 'maxlength' => '150', 'data-rules' => 'required|email']) ?>
            <?= field('usuario', 'Usuario', 'text', ['required' => '', 'autocomplete' => 'username', 'data-rules' => 'required|username']) ?>
            <?= field('password', 'Contraseña', 'password', ['required' => '', 'autocomplete' => 'new-password', 'data-rules' => 'required|password']) ?>
            <?= field('password_confirmation', 'Confirmar contraseña', 'password', ['required' => '', 'autocomplete' => 'new-password', 'data-rules' => 'required|same:password']) ?>
        </div>

        <button type="submit" class="btn">Enviar solicitud</button>
    </form>
</section>
