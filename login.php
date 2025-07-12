<?php
require_once "db.php";
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit;
        } else {
            $message = "Contraseña incorrecta.";
        }
    } else {
        $message = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.iconscout.com/icon/premium/png-256-thumb/soccer-ball-1691337-1441576.png" rel="icon">
</head>
<body>
    <main class="container-fluid py-5 text-center">
        <h1>Iniciar sesión</h1>
        <?php if ($message): ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <div class="mb-3">
                <label>Nombre de usuario</label>
                <input type="text" name="username" class="form-control mx-auto w-auto" required>
            </div>
            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control mx-auto w-auto" required>
            </div>
            <button type="submit" class="btn btn-success">Entrar</button>
        </form>
        <a href="register.php" class="btn btn-link mt-3">¿No tienes cuenta? Regístrate</a>
    </main>
</body>
</html>
