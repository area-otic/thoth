<?php 
http_response_code(404);
include 'includes/header.php'; 
?>

<style>
    /* Estructura principal */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    
    /* Contenedor de contenido que crece */
    .content-wrapper {
        flex: 1;
    }
    
    /* Asegura que el footer no se superponga */
    footer {
        margin-top: auto;
    }
</style>

<div class="content-wrapper">
    <div class="py-2">
    </div>
    <div class="container py-13">
        <div class="text-center">

            <h1 class="display-1 text-danger">404</h1>
            <h2>Página no encontrada</h2>
            <p class="lead"><?= $_SESSION['error_message'] ?? 'La página que buscas no existe o ha sido movida' ?></p>
            <a href="universidades.php" class="btn btn-primary">Ver todas las instituciones</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>