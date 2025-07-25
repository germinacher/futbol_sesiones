<!DOCTYPE html>
<html>
    <?php 
        $titulo = "Agregar equipo"; 
        require_once 'partials/head.php'; 
    ?>
    <body>

        <?php require_once 'partials/navbar.php'; ?>

        <main class="container-fluid py-5 text-center">
            <h1>Agregar equipo</h1>
            <br>
            <?php if ($message): ?>
                <div class="alert alert-info"><?= $message ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control mx-auto w-auto" placeholder="Nombre del equipo" autofocus autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </main>

        <?php require_once 'partials/footer.php'; ?>

    </body>
</html>