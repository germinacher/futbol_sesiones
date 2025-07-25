<nav class="bg-light border navbar navbar-expand-md navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/futbol_php_usuarios_sesion/index.php">
            <span class="blue">L</span><span class="red">I</span><span class="yellow">G</span><span class="green">A</span> <span class="red">Futbol</span>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mt-2">
                <li class="nav-item"><a class="nav-link" href="/futbol_php_usuarios_sesion/controllers/insert_teamcontroller.php?action=insert">Agregar equipo</a></li>
                <li class="nav-item"><a class="nav-link" href="/futbol_php_usuarios_sesion/controllers/insert_matchcontroller.php?action=insert">Registrar partido</a></li>
                <li class="nav-item"><a class="nav-link" href="/futbol_php_usuarios_sesion/controllers/delete_teamcontroller.php?action=delete">Eliminar equipo</a></li>
                <li class="nav-item"><a class="nav-link" href="/futbol_php_usuarios_sesion/controllers/matchescontroller.php?action=list">Partidos jugados</a></li>
                <li class="nav-item"><a class="nav-link" href="/futbol_php_usuarios_sesion/index.php">TABLA DE POSICIONES</a></li>
            </ul>
            <ul class="navbar-nav ms-auto mt-2">
                <li class="nav-item"><a class="nav-link" href="/futbol_php_usuarios_sesion/controllers/delete_allcontroller.php?action=reset">Reiniciar liga</a></li>
                <li class="nav-item"><a href="/futbol_php_usuarios_sesion/controllers/logoutcontroller.php" class="btn btn-outline-danger">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>