<?php
// Iniciar la sesión y manejar cookies ANTES de cualquier output
session_start();

// Configurar la cookie con los programas a comparar
if (!empty($_GET['ids'])) {
    $programIds = explode(',', $_GET['ids']);
    setcookie('comparePrograms', json_encode($programIds), time() + 3600, '/');
    header('Location: comparar.php');
    exit;
}

// Ahora incluir el header
include 'includes/header.php';
include 'includes/db.php';

// Obtener programas a comparar
$programIds = [];
if (!empty($_COOKIE['comparePrograms'])) {
    $programIds = json_decode($_COOKIE['comparePrograms'], true) ?: [];
}

// Si no hay IDs en la cookie, verificar localStorage via JavaScript
if (empty($programIds)) {
    echo '
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const programsToCompare = JSON.parse(localStorage.getItem("comparePrograms")) || [];
        if (programsToCompare.length > 0) {
            window.location.href = "comparar.php?ids=" + programsToCompare.join(",");
        }
    });
    </script>
    ';
}

// Obtener datos de los programas
$programs = [];
if (!empty($programIds)) {
    $placeholders = implode(',', array_fill(0, count($programIds), '?'));
    $stmt = $conn->prepare("SELECT * FROM data_programas WHERE id IN ($placeholders)");
    $stmt->execute($programIds);
    $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Limpiar la comparación (usando JavaScript para localStorage)
echo '<script>localStorage.removeItem("comparePrograms");</script>';
// No necesitamos setcookie() aquí ya que se manejará en el próximo acceso
?>

<div class="container mt-5">
    <h2 class="mb-4">Comparación de Programas</h2>
    
    <?php if (empty($programs)): ?>
        <div class="alert alert-info">
            No hay programas seleccionados para comparar.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Característica</th>
                        <?php foreach ($programs as $program): ?>
                            <th><?= htmlspecialchars($program['titulo']) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Universidad</td>
                        <?php foreach ($programs as $program): ?>
                            <td><?= htmlspecialchars($program['universidad']) ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Tipo</td>
                        <?php foreach ($programs as $program): ?>
                            <td><?= htmlspecialchars($program['tipo']) ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Duración</td>
                        <?php foreach ($programs as $program): ?>
                            <td><?= htmlspecialchars($program['duracion']) ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Modalidad</td>
                        <?php foreach ($programs as $program): ?>
                            <td><?= htmlspecialchars($program['modalidad']) ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>País</td>
                        <?php foreach ($programs as $program): ?>
                            <td><?= htmlspecialchars($program['pais']) ?></td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>