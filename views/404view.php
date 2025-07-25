<!DOCTYPE html>
<html>
    <?php 
        $titulo = "Página no encontrada"; 
        require_once 'partials/head.php'; 
    ?>
    <body class="text-center py-5">
        <p class="lead">La página que buscas no existe o fue removida.</p>
        <div>
            <img src="assets/images/pelota_error404.jpg" alt="Error 404" width="300px">
        </div>
        <a href="index.php" class="btn btn-primary">Volver al inicio</a>
        <?php require_once 'partials/footer.php'; ?>
    </body>
</html>