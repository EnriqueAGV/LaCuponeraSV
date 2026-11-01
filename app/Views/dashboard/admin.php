<section>
    <h1>Panel administrativo</h1>
    <p class="muted">Bienvenido, <?= e(auth()['usuario']) ?>. Revisa las solicitudes de empresas y administra el acceso.</p>

    <div class="stats">
        <div class="stat"><span><?= (int) $stats['pendientes'] ?></span>Empresas pendientes</div>
        <div class="stat"><span><?= (int) $stats['aprobadas'] ?></span>Empresas aprobadas</div>
        <div class="stat"><span><?= (int) $stats['rechazadas'] ?></span>Empresas rechazadas</div>
        <div class="stat"><span><?= (int) $stats['administradores'] ?></span>Administradores</div>
    </div>

    <div class="actions">
        <a class="btn" href="<?= e(url('/admin/empresas')) ?>">Revisar empresas</a>
        <a class="btn btn-secondary" href="<?= e(url('/admin/administradores')) ?>">Administrar administradores</a>
    </div>
</section>
