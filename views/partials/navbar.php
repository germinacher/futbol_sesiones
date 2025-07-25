<!DOCTYPE html>
<html>
    <nav class="bg-light border navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><span class="blue">L</span><span class="red">I</span><span class="yellow">G</span><span class="green">A</span> <span class="red">Futbol</span></a>
            <button aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbar" data-bs-toggle="collapse" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mt-2">
                    <li class="nav-item"><a class="nav-link" href="insert_team.php">Agregar equipo</a></li>
                    <li class="nav-item"><a class="nav-link" href="insert_match.php">Registrar partido</a></li>
                    <li class="nav-item"><a class="nav-link" href="delete_team.php">Eliminar equipo</a></li>
                    <li class="nav-item"><a class="nav-link" href="matches.php">Partidos jugados</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">TABLA DE POSICIONES</a></li>
                </ul>
                <ul class="navbar-nav ms-auto mt-2">
                    <li class="nav-item"><a class="nav-link" href="delete_all.php">Reiniciar liga</a></li>
                    <li class="nav-item"><a href="logout.php" class="btn btn-outline-danger">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
</html>