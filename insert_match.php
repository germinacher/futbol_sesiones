<?php
require_once "includes/db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$message = "";
$teams = [];

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

require_once 'views/insert_matchview.php';
?>