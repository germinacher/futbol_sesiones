<?php
require_once "../includes/db.php";
require_once "../models/matchesmodel.php";
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION["user_id"])) {
    header("Location: logincontroller.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$matchModel = new MatchesM($mysqli);
$matches = $matchModel->getMatchesByUser($user_id);

require_once "../views/matchesview.php";
?>