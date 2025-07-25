<?php
require_once "../includes/db.php";
require_once "../models/delete_teammodel.php";
session_start();

// Redirige si no hay sesión activa
if (!isset($_SESSION["user_id"])) {
    header("Location: logincontroller.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$message = "";

$teamModel = new DeleteT($mysqli);
$teams = $teamModel->getTeamsByUser($user_id);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $team = $_POST["name"] ?? "";

    if (!$team) {
        $message = "Por favor, selecciona un equipo.";
    } elseif (!$teamModel->teamExists($team, $user_id)) {
        $message = "Ese equipo no existe.";
    } else {
        $teamModel->deleteTeam($team, $user_id);
        $message = "Equipo eliminado correctamente.";
        $teams = $teamModel->getTeamsByUser($user_id); // Actualiza lista tras eliminar
    }
}

require_once "../views/delete_teamview.php";
?>