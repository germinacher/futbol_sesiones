<!DOCTYPE html>
<html>
    <?php 
        $titulo = "Registro"; 
        require_once __DIR__ . '/../partials/head.php'; 
    ?>
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
            <a href="/futbol_php_usuarios_sesion/controllers/logincontroller.php" class="btn btn-link mt-3">¿Ya tienes una cuenta? Inicia sesión</a>
        </main>

        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
        
    </body>
</html>