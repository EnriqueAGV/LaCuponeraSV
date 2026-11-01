<section class="card narrow">
    <h1>Iniciar sesión</h1>

    <?php if ($general = flashed('errors', [])['general'] ?? null): ?>
        <div class="alert alert-error"><?= e($general) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= e(url('/login')) ?>" novalidate>
        <?= csrf_field() ?>
        <?= field('usuario', 'Usuario o correo', 'text', ['required' => '', 'autocomplete' => 'username', 'data-rules' => 'required']) ?>
        <?= field('password', 'Contraseña', 'password', ['required' => '', 'autocomplete' => 'current-password', 'data-rules' => 'required']) ?>
        <button type="submit" class="btn">Entrar</button>
    </form>

    <p class="links">
        <a href="<?= e(url('/password/olvide')) ?>">¿Olvidaste tu contraseña?</a>
    </p>
    <p class="muted">
        ¿No tienes cuenta?
        <a href="<?= e(url('/registro/cliente')) ?>">Regístrate como cliente</a> ·
        <a href="<?= e(url('/registro/empresa')) ?>">Registra tu empresa</a>
    </p>
</section>
