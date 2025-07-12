<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "sesionesfutbol";

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    die("Error de conexión: " . $mysqli->connect_error);
}
?>
