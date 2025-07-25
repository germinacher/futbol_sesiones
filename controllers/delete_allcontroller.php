<?php
require_once "../includes/db.php";
require_once "../models/delete_allmodel.php";
session_start();

// Redirige si el usuario no está logueado
if (!isset($_SESSION["user_id"])) {
    header("Location: logincontroller.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$message = "";

$leagueModel = new DeleteA($mysqli);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $leagueModel->resetLeagueForUser($user_id);
    $message = "Información de liga eliminada correctamente.";
}

require_once "../views/delete_allview.php";
?>