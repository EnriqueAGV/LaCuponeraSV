<?php
/** @var string $content */
/** @var string|null $title */
$user = auth();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? app_name()) ?> · <?= e(app_name()) ?></title>
    <link rel="stylesheet" href="<?= e(url('/css/app.css')) ?>">
</head>
<body>
<header class="topbar">
    <a class="brand" href="<?= e(url('/')) ?>"><?= e(app_name()) ?></a>

    <nav class="nav">
        <?php if ($user !== null): ?>
            <?php if ($user['rol'] === 'administrador'): ?>
                <a href="<?= e(url('/dashboard')) ?>">Panel</a>
                <a href="<?= e(url('/admin/empresas')) ?>">Empresas</a>
                <a href="<?= e(url('/admin/administradores')) ?>">Administradores</a>
            <?php else: ?>
                <a href="<?= e(url('/dashboard')) ?>">Panel</a>
            <?php endif; ?>
            <span class="badge"><?= e($user['usuario']) ?> · <?= e(role_label($user['rol'])) ?></span>
            <form method="post" action="<?= e(url('/logout')) ?>" class="inline">
                <?= csrf_field() ?>
                <button type="submit" class="link">Salir</button>
            </form>
        <?php else: ?>
            <a href="<?= e(url('/login')) ?>">Iniciar sesión</a>
            <a href="<?= e(url('/registro/cliente')) ?>">Registro cliente</a>
            <a href="<?= e(url('/registro/empresa')) ?>">Registro empresa</a>
        <?php endif; ?>
    </nav>
</header>

<main class="container">
    <?php if ($msg = flashed('success')): ?>
        <div class="alert alert-success"><?= e($msg) ?></div>
    <?php endif; ?>
    <?php if ($msg = flashed('error')): ?>
        <div class="alert alert-error"><?= e($msg) ?></div>
    <?php endif; ?>

    <?= $content ?>
</main>
<script src="<?= e(url('/js/forms.js')) ?>" defer></script>
</body>
</html>
