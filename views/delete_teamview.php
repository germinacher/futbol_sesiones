<!DOCTYPE html>
<html>
    <?php 
        $titulo = "Eliminar equipo"; 
        require_once 'partials/head.php'; 
    ?>
    <body>

        <?php require_once 'partials/navbar.php'; ?>

        <main class="container-fluid py-5 text-center">
            <h1>Eliminar equipo</h1>
            <?php if ($message): ?>
                <div class="alert alert-info"><?= $message ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <select name="name" class="form-select mx-auto w-auto">
                        <option value="">Seleccione equipo</option>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?= $team ?>"><?= $team ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </main>

        <?php require_once 'partials/footer.php'; ?>

    </body>
</html>