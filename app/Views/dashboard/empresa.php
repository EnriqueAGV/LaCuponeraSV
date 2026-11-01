<section class="card">
    <h1>Panel de empresa</h1>

    <?php if ($empresa === null): ?>
        <div class="alert alert-error">No encontramos los datos de tu empresa.</div>
    <?php else: ?>
        <p>
            Estado de tu solicitud:
            <span class="estado estado-<?= e($empresa['estado']) ?>"><?= e(ucfirst($empresa['estado'])) ?></span>
        </p>

        <?php if ($empresa['estado'] === 'pendiente'): ?>
            <p class="muted">Un administrador está revisando tu solicitud. Cuando sea aprobada podrás publicar ofertas.</p>
        <?php elseif ($empresa['estado'] === 'aprobada'): ?>
            <p class="muted">Tu empresa está aprobada con una comisión de <?= e($empresa['porcentaje_comision']) ?>% por cupón vendido.</p>
        <?php else: ?>
            <p class="muted">Tu solicitud fue rechazada. Contacta al administrador para más información.</p>
        <?php endif; ?>

        <h2>Datos registrados</h2>
        <dl class="details">
            <dt>Empresa</dt><dd><?= e($empresa['nombre']) ?></dd>
            <dt>NIT</dt><dd><?= e($empresa['nit']) ?></dd>
            <dt>Dirección</dt><dd><?= e($empresa['direccion']) ?></dd>
            <dt>Teléfono</dt><dd><?= e($empresa['telefono']) ?></dd>
        </dl>
    <?php endif; ?>
</section>
