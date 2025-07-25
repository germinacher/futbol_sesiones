<!DOCTYPE html>
<html>
    <?php 
        $titulo = "Partidos"; 
        require_once 'partials/head.php'; 
    ?>
    <body>

        <?php require_once 'partials/navbar.php'; ?>

        <main class="container-fluid py-5 text-center">
            <h1>Partidos</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">EQUIPO LOCAL</th>
                        <th scope="col">RESULTADO</th>
                        <th scope="col">EQUIPO VISITANTE</th>
                        <th scope="col">FECHA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matches as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["home_team"]) ?></td>
                            <td><?= $row["home_score"] ?> &#45; <?= $row["away_score"] ?></td>
                            <td><?= htmlspecialchars($row["away_team"]) ?></td>
                            <td><?= $row["date"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>

        <?php require_once 'partials/footer.php'; ?>

    </body>
</html>