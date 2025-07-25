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
    $team = $_POST["name"];

    if (!$team) {
        $message = "Por favor, selecciona un equipo.";
    } else {
        $stmt = $mysqli->prepare("SELECT team FROM register WHERE team = ? AND user_id = ?");
        $stmt->bind_param("si", $team, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $message = "Ese equipo no existe.";
        } else {
            $stmt = $mysqli->prepare("DELETE FROM register WHERE team = ? AND user_id = ?");
            $stmt->bind_param("si", $team, $user_id);
            $stmt->execute();
            $message = "Equipo eliminado correctamente.";
        }
    }
}

require_once 'views/delete_teamview.php';
?>