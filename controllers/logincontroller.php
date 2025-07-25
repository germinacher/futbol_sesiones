<?php
require_once "../includes/db.php";
require_once "../models/usermodel.php";
session_start();

$message = "";
$userModel = new UserM($mysqli);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $user = $userModel->getUserByUsername($username);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $username;
        header("Location: ../index.php");
        exit;
    } else {
        $message = "Usuario o contraseña incorrectos.";
    }
}

require_once '../views/auth/loginview.php';
?>