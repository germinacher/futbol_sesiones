<?php
require_once "db.php";
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        $message = "Por favor, completa todos los campos.";
    } else {
        $stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "El nombre de usuario ya está en uso.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hash);
            $stmt->execute();
            $message = "Usuario registrado con éxito. Ahora puedes iniciar sesión.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.iconscout.com/icon/premium/png-256-thumb/soccer-ball-1691337-1441576.png" rel="icon">
</head>
<body>
    <main class="container-fluid py-5 text-center">
        <h1>Registro de usuario</h1>
        <?php if ($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label>Nombre de usuario</label>
                <input type="text" name="username" class="form-control mx-auto w-auto" required>
            </div>
            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control mx-auto w-auto" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
        <a href="login.php" class="btn btn-link mt-3">¿Ya tienes una cuenta? Inicia sesión</a>
    </main>
</body>
</html>
