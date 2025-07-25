<!DOCTYPE html>
<html>
    <?php 
        $titulo = "Registrar partido"; 
        require_once 'partials/head.php'; 
    ?>
    <body>

        <?php require_once 'partials/navbar.php'; ?>

        <main class="container-fluid py-5 text-center">
            <h1>Registrar partido</h1>
            <?php if ($message): ?>
                <div class="alert alert-info"><?= $message ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <select name="name1" class="form-select mx-auto w-auto">
                        <option value="" disabled selected>Equipo local</option>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?= $team ?>"><?= $team ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label><h6>Goles</h6></label>
                    <input type="number" min="0" max="99" name="home_score" class="form-control mx-auto w-auto">
                </div>
                <h2>VS</h2>
                <div class="mb-3">
                    <select name="name2" class="form-select mx-auto w-auto">
                        <option value="" disabled selected>Equipo visitante</option>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?= $team ?>"><?= $team ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label><h6>Goles</h6></label>
                    <input type="number" min="0" max="99" name="away_score" class="form-control mx-auto w-auto">
                </div>
                <button type="submit" class="btn btn-primary">Registrar partido</button>
            </form>
        </main>

        <?php require_once 'partials/footer.php'; ?>
                        
    </body>
</html>