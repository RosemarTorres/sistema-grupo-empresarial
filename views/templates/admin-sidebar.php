<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo strpos($_SERVER['REQUEST_URI'], '/admin/dashboard') !== false ? 'active' : ''; ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">Inicio</span>
        </a>
        <a href="/admin/dashboard" class="dashboard__enlace">
            <i  class="fa-solid fa-users-gear dashboard__icono"></i>
            <span class="dashboard__menu-texto">Registros</span>
        </a>

        <!-- ... (otros enlaces) ... -->
    </nav>
</aside>