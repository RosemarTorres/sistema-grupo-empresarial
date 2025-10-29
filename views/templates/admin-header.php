<?php
use Model\FormularioTrabajador;
?>
<?php
// Consultar cantidad de planillas registradas con origen 'correo'
$notificaciones =FormularioTrabajador::totalRegistradasPorLink(); ?>


<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="/">
            <h2 class="dashboard__logo">
                GRUPO EMPRESARIAL L&H
            </h2>
        </a>

        <nav class="dashboard__nav">
    <!-- Bandeja de Notificaciones -->
    <div class="dashboard__notificaciones" id="campanaNotificaciones">
       <i class="fas fa-bell"></i>
        <?php if ($notificaciones > 0): ?>
            <span class="dashboard__notificaciones-contador"><?= $notificaciones ?></span>
        <?php endif; ?>

        <div class="dropdown-notificaciones" id="dropdownNotificaciones" style="display: none;">
             <ul id="listaNotificaciones"></ul>
        </div>
  </div>


</nav>
    <!-- Botón Cerrar Sesión -->
    <form method="POST" action="/logout" class="dashboard__form">
        <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
    </form>
    
    </div>
</header>