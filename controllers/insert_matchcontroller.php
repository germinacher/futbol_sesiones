<?php
require_once "../includes/db.php";
require_once "../models/insert_matchmodel.php";

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: logincontroller.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$match = new InsertM($mysqli);

$teams = $match->getUserTeams($user_id);
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $home = $_POST["name1"];
    $away = $_POST["name2"];
    $home_score = $_POST["home_score"];
    $away_score = $_POST["away_score"];

    if (!$home || !$away || $home == $away || !is_numeric($home_score) || !is_numeric($away_score)) {
        $message = "Por favor, completa todos los campos correctamente.";
    } else {
        $message = $match->registerMatch($home, $away, (int)$home_score, (int)$away_score, $user_id);
        $teams = $match->getUserTeams($user_id); // actualizar lista en caso de cambios
    }
}

require_once "../views/insert_matchview.php";
?>