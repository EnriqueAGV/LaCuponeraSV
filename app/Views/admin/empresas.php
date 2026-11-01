<section>
    <h1>Solicitudes de empresas</h1>
    <p class="muted">Aprueba o rechaza cada solicitud. Al aprobar, define el porcentaje de comisión por cupón vendido.</p>

    <?php if ($empresas === []): ?>
        <p class="card">Todavía no hay empresas registradas.</p>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>Empresa</th>
                    <th>NIT</th>
                    <th>Contacto</th>
                    <th>Estado</th>
                    <th>Comisión</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($empresas as $empresa): ?>
                    <tr>
                        <td>
                            <strong><?= e($empresa['nombre']) ?></strong><br>
                            <small class="muted">Usuario: <?= e($empresa['usuario']) ?></small>
                        </td>
                        <td><?= e($empresa['nit']) ?></td>
                        <td>
                            <?= e($empresa['correo']) ?><br>
                            <small class="muted"><?= e($empresa['telefono']) ?> · <?= e($empresa['direccion']) ?></small>
                        </td>
                        <td>
                            <span class="estado estado-<?= e($empresa['estado']) ?>"><?= e(ucfirst($empresa['estado'])) ?></span>
                        </td>
                        <td>
                            <?= $empresa['porcentaje_comision'] !== null ? e($empresa['porcentaje_comision']) . '%' : '—' ?>
                        </td>
                        <td>
                            <?php if ($empresa['estado'] === 'pendiente'): ?>
                                <form method="post" action="<?= e(url('/admin/empresas/' . $empresa['id'] . '/aprobar')) ?>" class="row-form">
                                    <?= csrf_field() ?>
                                    <input type="number" name="porcentaje_comision" min="0" max="100" step="0.01" placeholder="%" required>
                                    <button type="submit" class="btn btn-small">Aprobar</button>
                                </form>
                                <form method="post" action="<?= e(url('/admin/empresas/' . $empresa['id'] . '/rechazar')) ?>" class="inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-small btn-danger">Rechazar</button>
                                </form>
                            <?php else: ?>
                                <span class="muted">Procesada</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
