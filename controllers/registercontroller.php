<?php
require_once "../includes/db.php";
require_once "../models/usermodel.php";
session_start();

$message = "";
$userModel = new UserM($mysqli);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        $message = "Por favor, completa todos los campos.";
    } elseif ($userModel->usernameExists($username)) {
        $message = "El nombre de usuario ya está en uso.";
    } else {
        $userModel->registerUser($username, $password);
        $message = "Usuario registrado con éxito. Ahora puedes iniciar sesión.";
    }
}

require_once '../views/auth/registerview.php';
?>