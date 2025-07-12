<?php
require_once "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$message = "";
$teams = [];

// Obtener equipos del usuario
$stmt = $mysqli->prepare("SELECT team FROM register WHERE user_id = ? GROUP BY team");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $teams[] = $row["team"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $home = $_POST["name1"];
    $away = $_POST["name2"];
    $home_score = $_POST["home_score"];
    $away_score = $_POST["away_score"];

    if (!$home || !$away || $home == $away || !is_numeric($home_score) || !is_numeric($away_score)) {
        $message = "Por favor, completa todos los campos correctamente.";
    } else {
        $home_score = (int)$home_score;
        $away_score = (int)$away_score;

        $stmt = $mysqli->prepare("SELECT 1 FROM matches WHERE home_team = ? AND away_team = ? AND user_id = ?");
        $stmt->bind_param("ssi", $home, $away, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Ese partido ya fue jugado.";
        } else {
            $now = date("Y-m-d H:i:s");

            if ($home_score > $away_score) {
                $mysqli->query("INSERT INTO register (team, played, win, points, gf, gc, user_id)
                                VALUES ('$home', 1, 1, 3, $home_score, $away_score, $user_id)");
                $mysqli->query("INSERT INTO register (team, played, defeat, gf, gc, user_id)
                                VALUES ('$away', 1, 1, $away_score, $home_score, $user_id)");
                $home_result = 'W'; $away_result = 'L';
            } elseif ($home_score < $away_score) {
                $mysqli->query("INSERT INTO register (team, played, win, points, gf, gc, user_id)
                                VALUES ('$away', 1, 1, 3, $away_score, $home_score, $user_id)");
                $mysqli->query("INSERT INTO register (team, played, defeat, gf, gc, user_id)
                                VALUES ('$home', 1, 1, $home_score, $away_score, $user_id)");
                $home_result = 'L'; $away_result = 'W';
            } else {
                $mysqli->query("INSERT INTO register (team, played, draw, points, gf, gc, user_id)
                                VALUES ('$home', 1, 1, 1, $home_score, $away_score, $user_id)");
                $mysqli->query("INSERT INTO register (team, played, draw, points, gf, gc, user_id)
                                VALUES ('$away', 1, 1, 1, $away_score, $home_score, $user_id)");
                $home_result = $away_result = 'D';
            }

            $stmt = $mysqli->prepare("INSERT INTO matches (home_team, away_team, home_score, away_score, home_result, away_result, date, user_id) 
                                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiiissi", $home, $away, $home_score, $away_score, $home_result, $away_result, $now, $user_id);
            $stmt->execute();

            $message = "Partido registrado correctamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, width=device-width">
        <title>Registrar partido</title>
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
            <h1>Registrar partido</h1>
            <?php if ($message): ?>
                <div class="alert alert-info"><?= $message ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <select name="name1" class="form-select mx-auto w-auto">
                        <option value="" disabled selected>Equipo local</option>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?= $team ?>"><?= $team ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label><h6>Goles</h6></label>
                    <input type="number" min="0" max="99" name="home_score" class="form-control mx-auto w-auto">
                </div>
                <h2>VS</h2>
                <div class="mb-3">
                    <select name="name2" class="form-select mx-auto w-auto">
                        <option value="" disabled selected>Equipo visitante</option>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?= $team ?>"><?= $team ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label><h6>Goles</h6></label>
                    <input type="number" min="0" max="99" name="away_score" class="form-control mx-auto w-auto">
                </div>
                <button type="submit" class="btn btn-primary">Registrar partido</button>
            </form>
        </main>

    </body>
</html>