<?php
require_once "../includes/db.php";
require_once "../models/insert_teammodel.php";

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: logincontroller.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$message = "";

$teamModel = new InsertT($mysqli);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $team = strtoupper(trim($_POST["name"]));

    if (empty($team)) {
        $message = "Por favor, introduce un nombre de equipo.";
    } elseif ($teamModel->teamExists($team, $user_id)) {
        $message = "Ese equipo ya existe.";
    } else {
        $teamModel->insertTeam($team, $user_id);
        $message = "Equipo creado correctamente.";
    }
}

require_once "../views/insert_teamview.php";
?>