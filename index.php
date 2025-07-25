<?php
require_once "includes/db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$query = "SELECT team, SUM(played) AS played, SUM(win) AS win, SUM(draw) AS draw, 
                 SUM(defeat) AS defeat, SUM(gf) AS gf, SUM(gc) AS gc, 
                 SUM(points) AS points 
          FROM register 
          WHERE user_id = ?
          GROUP BY team 
          ORDER BY points DESC, gf DESC";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$register = $result->fetch_all(MYSQLI_ASSOC);

require_once "views/indexview.php";
?>