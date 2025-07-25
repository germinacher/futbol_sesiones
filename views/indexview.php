<!DOCTYPE html>
<html>
    <?php 
        $titulo = "Tabla de posiciones"; 
        require_once 'partials/head.php'; 
    ?>

    <body>

        <?php require_once 'partials/navbar.php'; ?>

        <main class="container-fluid py-5 text-center">
            <h1 style="color:#2e944b">Crea tu propia LIGA</h1>
            <h2>Tabla de posiciones</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Equipos</th>
                        <th scope="col">Jugados</th>
                        <th scope="col">Ganados</th>
                        <th scope="col">Empates</th>
                        <th scope="col">Perdidos</th>
                        <th scope="col">GF &#45; GC</th>
                        <th scope="col">Puntos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($register as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['team']) ?></td>
                            <td><?= $row['played'] ?></td>
                            <td><?= $row['win'] ?></td>
                            <td><?= $row['draw'] ?></td>
                            <td><?= $row['defeat'] ?></td>
                            <td><?= $row['gf'] ?> &#45; <?= $row['gc'] ?></td>
                            <td><?= $row['points'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>

        <?php require_once 'partials/footer.php'; ?>

    </body>
</html>