<?php
require_once "includes/db.php";
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

require_once 'views/delete_allview.php';
?>