<section class="card narrow">
    <h1>Nueva contraseña</h1>

    <?php if (!$valido): ?>
        <div class="alert alert-error">El enlace no es válido o ya venció.</div>
        <p class="links"><a href="<?= e(url('/password/olvide')) ?>">Solicitar un enlace nuevo</a></p>
    <?php else: ?>
        <form method="post" action="<?= e(url('/password/restablecer')) ?>" novalidate>
            <?= csrf_field() ?>
            <input type="hidden" name="token" value="<?= e($token) ?>">
            <?= field('password', 'Nueva contraseña', 'password', ['required' => '', 'autocomplete' => 'new-password', 'data-rules' => 'required|password']) ?>
            <?= field('password_confirmation', 'Confirmar contraseña', 'password', ['required' => '', 'autocomplete' => 'new-password', 'data-rules' => 'required|same:password']) ?>
            <button type="submit" class="btn">Guardar contraseña</button>
        </form>
    <?php endif; ?>
</section>
