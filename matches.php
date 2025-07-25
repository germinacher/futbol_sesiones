<?php
require_once "includes/db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$query = "SELECT home_team, home_score, away_team, away_score, date 
          FROM matches 
          WHERE user_id = ?
          ORDER BY date DESC";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$matches = $result->fetch_all(MYSQLI_ASSOC);

require_once 'views/matchesview.php';
?>