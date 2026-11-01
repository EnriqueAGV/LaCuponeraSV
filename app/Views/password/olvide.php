<section class="card narrow">
    <h1>Recuperar contraseña</h1>
    <p class="muted">Escribe el correo de tu cuenta. Te enviaremos un enlace para crear una nueva contraseña.</p>

    <form method="post" action="<?= e(url('/password/olvide')) ?>" novalidate>
        <?= csrf_field() ?>
        <?= field('correo', 'Correo electrónico', 'email', ['required' => '', 'data-rules' => 'required|email']) ?>
        <button type="submit" class="btn">Enviar enlace</button>
    </form>

    <p class="links"><a href="<?= e(url('/login')) ?>">Volver a iniciar sesión</a></p>
</section>
