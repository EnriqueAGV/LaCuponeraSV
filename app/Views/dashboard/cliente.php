<section class="card">
    <h1>Mi cuenta</h1>

    <?php if ($cliente === null): ?>
        <div class="alert alert-error">No encontramos los datos de tu cuenta.</div>
    <?php else: ?>
        <p class="muted">Bienvenido, <?= e(auth()['usuario']) ?>.</p>

        <h2>Datos personales</h2>
        <dl class="details">
            <dt>Nombre</dt><dd><?= e($cliente['nombre']) ?> <?= e($cliente['apellidos']) ?></dd>
            <dt>DUI</dt><dd><?= e($cliente['dui']) ?></dd>
            <dt>Fecha de nacimiento</dt><dd><?= e($cliente['fecha_nacimiento']) ?></dd>
            <dt>Correo</dt><dd><?= e(auth()['correo']) ?></dd>
        </dl>
    <?php endif; ?>

    <p class="muted">La compra de cupones y el historial de compras se habilitarán en la Fase 2.</p>
</section>
