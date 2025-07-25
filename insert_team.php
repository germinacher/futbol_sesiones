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
    $team = strtoupper(trim($_POST["name"]));

    if (empty($team)) {
        $message = "Por favor, introduce un nombre de equipo.";
    } else {
        $stmt = $mysqli->prepare("SELECT team FROM register WHERE team = ? AND user_id = ?");
        $stmt->bind_param("si", $team, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Ese equipo ya existe.";
        } else {
            $stmt = $mysqli->prepare("INSERT INTO register (team, user_id) VALUES (?, ?)");
            $stmt->bind_param("si", $team, $user_id);
            $stmt->execute();
            $message = "Equipo creado correctamente.";
        }
        $stmt->close();
    }
}

require_once 'views/insert_teamview.php';
?>