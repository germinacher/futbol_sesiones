<?php
require_once "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $mysqli->prepare("DELETE FROM register WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $stmt = $mysqli->prepare("DELETE FROM matches WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $message = "Información de liga eliminada correctamente.";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, width=device-width">
        <title>Eliminar todo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.iconscout.com/icon/premium/png-256-thumb/soccer-ball-1691337-1441576.png" rel="icon">
        <link href="static/styles.css" rel="stylesheet" type="text/css">
    </head>
    <body>

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

        <main class="container-fluid py-5 text-center">
            <h1>Eliminar liga y todos sus datos</h1>
            <?php if ($message): ?>
                <div class="alert alert-success"><?= $message ?></div>
            <?php else: ?>
                <h2 style="color: red" class="text-danger">Esta acción eliminará todos los equipos y el historial de partidos.</h2>
                <h3>Haz clic en el botón para confirmar.</h3>
                <form method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar toda la liga?');">
                    <button type="submit" class="btn btn-danger">Eliminar todo</button>
                </form>
            <?php endif; ?>
        </main>

    </body>
</html>

