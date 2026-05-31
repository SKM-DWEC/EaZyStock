<div class="sidebar">

<div class="text-center mt-3 mb-2">

    <a
        href="/eazystock/dashboard.php"
    >

        <img
            src="/eazystock/assets/img/logo_eazystock.png"
            alt="EaZyStock"
            class="sidebar-logo"
        >

    </a>

</div>

<hr class="text-white">

    <a href="/eazystock/dashboard.php">
    <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="/eazystock/trabajadores/listar.php">
    <i class="bi bi-people"></i> Trabajadores
    </a>

    <a href="/eazystock/material/listar.php">
    <i class="bi bi-laptop"></i> Material
    </a>

    <a href="/eazystock/asignaciones/listar.php">
    <i class="bi bi-arrow-left-right"></i> Asignaciones
    </a>

    <a href="/eazystock/asignaciones/historial.php">
    <i class="bi bi-clock-history"></i> Historial
    </a>

    <?php if ($_SESSION['rol_id'] == 1) { ?>

        <a href="/eazystock/usuarios/listar.php">
        <i class="bi bi-person-gear"></i> Usuarios
        </a>
        
    <?php } ?>

    <a href="/eazystock/auth/logout.php">
    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
    </a>

    

</div>