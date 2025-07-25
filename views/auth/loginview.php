<!DOCTYPE html>
<html>
<?php 
        $titulo = "Iniciar sesión"; 
        require_once 'views/partials/head.php'; 
?>
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

    <?php require_once 'views/partials/footer.php'; ?>

</body>
</html>
