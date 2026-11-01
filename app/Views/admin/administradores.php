<section>
    <h1>Administradores</h1>

    <div class="grid-2 layout-admin">
        <div class="card">
            <h2>Nuevo administrador</h2>
            <form method="post" action="<?= e(url('/admin/administradores')) ?>" novalidate>
                <?= csrf_field() ?>
                <?= field('usuario', 'Usuario', 'text', ['required' => '', 'autocomplete' => 'off', 'data-rules' => 'required|username']) ?>
                <?= field('correo', 'Correo electrónico', 'email', ['required' => '', 'data-rules' => 'required|email']) ?>
                <?= field('password', 'Contraseña', 'password', ['required' => '', 'autocomplete' => 'new-password', 'data-rules' => 'required|password']) ?>
                <?= field('password_confirmation', 'Confirmar contraseña', 'password', ['required' => '', 'autocomplete' => 'new-password', 'data-rules' => 'required|same:password']) ?>
                <button type="submit" class="btn">Crear administrador</button>
            </form>
        </div>

        <div class="card">
            <h2>Administradores actuales</h2>
            <ul class="list">
                <?php foreach ($administradores as $admin): ?>
                    <li>
                        <strong><?= e($admin['usuario']) ?></strong>
                        <span class="muted"><?= e($admin['correo']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
