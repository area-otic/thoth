<?php
include 'includes/header.php';
include 'includes/db.php';

// Obtener ID de la institución desde la URL y validarlo
$id_institucion = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar la institución específica
$stmt = $conn->prepare("SELECT * FROM data_instituciones WHERE id = ? AND convenio = 'Si' AND estado = 'Activo'");
$stmt->execute([$id_institucion]);
$institucion = $stmt->fetch(PDO::FETCH_ASSOC);

// Si la institución no existe, no tiene convenio o no está activa, redirigir
if(!$institucion) {
    header("Location: universidades.php");
    exit;
}

// Consultar programas de esta institución (si existe una tabla programas)
try {
    $stmt_programas = $conn->prepare("SELECT * FROM data_programas WHERE universidad = ?");
    $stmt_programas->execute([$id_institucion]);
    $programas = $stmt_programas->fetchAll(PDO::FETCH_ASSOC);
    $totalPrograms = count($programas);
} catch(PDOException $e) {
    $programas = [];
    $totalPrograms = 0;
}

// Calcular estadísticas (usando campos disponibles)
$totalFaculty = $institucion['user_encargado'] ? 1 : 0; // Ejemplo básico
$fechaCreacion = new DateTime($institucion['fecha_creacion']);
$antiguedad = $fechaCreacion->diff(new DateTime())->y;
?>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    .bg-primary2 {
        background-color: #1a3a8f;
    }
    .institution-image {
        height: 250px;
        object-fit: cover;
    }
    .feature-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        margin-right: 15px;
    }
    .stat-card {
        transition: transform 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
</style>

<!-- Institution Content -->
<div class="min-vh-100 bg-light">
    <!-- Header -->
    <div class="bg-primary2 text-white pt-13 py-13">
        <div class="container px-4">
            <div class="d-flex flex-column flex-md-row align-items-md-end">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-2 text-info">
                        <a href="universidades.php" class="text-decoration-none text-white">Instituciones</a>
                        <span class="mx-2">›</span>
                        <a href="universidades.php?pais=<?= urlencode($institucion['pais']) ?>" class="text-decoration-none text-white">
                            <?= htmlspecialchars($institucion['pais']) ?>
                        </a>
                    </div>
                    
                    <h1 class="display-5 font-serif fw-extrabold mb-2"><?= htmlspecialchars($institucion['nombre']) ?></h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-geo-alt-fill fs-5 me-2"></i>
                        <span class="h5 mb-0"><?= htmlspecialchars($institucion['ciudad']) ?>, <?= htmlspecialchars($institucion['pais']) ?></span>
                    </div>
                    
                    <div class="d-flex flex-wrap gap-2">
                        
                        <div class="me-4 d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-primary me-1"></i>
                            <span>Convenio Activo</span>
                        </div>                        
                        
                    </div>
                </div>
                
                <div class="col-md-4 mt-3 mt-md-0 text-md-end">
                    <a href="<?= htmlspecialchars($institucion['url']) ?>" target="_blank" class="btn btn-dark px-4 py-2 fw-medium">
                        <i class="bi bi-globe me-2"></i>
                        Visitar Sitio Web
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Content -->
    <div class="container px-4 py-5">
        <div class="row g-4">
            <!-- Main Content - 2/3 -->
            <div class="col-lg-8">
                <!-- Institution Image -->
                <img src="<?= htmlspecialchars($institucion['imagen_url']) ?>" 
                     alt="<?= htmlspecialchars($institucion['nombre']) ?>" 
                     class="w-100 img-fluid rounded shadow-md mb-4 institution-image">
                
                <!-- Description -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="h4 fw-bold mb-3 d-flex align-items-center">
                            <i class="bi bi-info-circle-fill text-primary me-2"></i>
                            Acerca de la Institución
                        </h2>
                        <div class="mb-4">
                            <?= nl2br(htmlspecialchars($institucion['descripcion'])) ?>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Programs Section -->
                <?php if($totalPrograms > 0): ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="h4 fw-bold mb-3 d-flex align-items-center">
                            <i class="bi bi-book-fill text-primary me-2"></i>
                            Programas Disponibles (<?= $totalPrograms ?>)
                        </h2>
                        <div class="list-group">
                            <?php foreach($programas as $programa): ?>
                                <a href="programa.php?id=<?= $programa['id'] ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-1"><?= htmlspecialchars($programa['titulo'] ?? 'Programa') ?></h5>
                                        <span class="badge bg-primary"><?= htmlspecialchars($programa['tipo'] ?? '') ?></span>
                                    </div>
                                    <?php if(!empty($programa['duracion'])): ?>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i><?= htmlspecialchars($programa['duracion']) ?></small>
                                    <?php endif; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar - 1/3 -->
            <div class="col-lg-4">
                <!-- Quick Stats -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="h4 fw-bold mb-3 d-flex align-items-center">
                            <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                            Programas
                        </h2>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="stat-card text-center p-3 bg-light rounded">
                                    <div class="h4 fw-bold text-primary"><?= $totalPrograms ?></div>
                                    <small class="text-muted">Programas</small>
                                </div>
                            </div>
                            <!--<div class="col-6">
                                <div class="stat-card text-center p-3 bg-light rounded">
                                    <div class="h4 fw-bold text-primary"><?= $antiguedad ?></div>
                                    <small class="text-muted">Años de antigüedad</small>
                                </div>
                            </div>-->
                            <div class="col-12 mt-3">
                                <div class="stat-card p-3 bg-primary text-white rounded">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill fs-3 me-3"></i>
                                        <div>
                                            <div class="h5 fw-bold mb-0">Convenio Activo</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="h4 fw-bold mb-3 d-flex align-items-center">
                            <i class="bi bi-envelope-fill text-primary me-2"></i>
                            Información de Contacto
                        </h2>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-globe me-2 text-muted"></i>
                                <a href="<?= htmlspecialchars($institucion['url']) ?>" target="_blank" class="text-decoration-none">
                                    <?= parse_url($institucion['url'], PHP_URL_HOST) ?>
                                </a>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-geo-alt me-2 text-muted"></i>
                                <span><?= htmlspecialchars($institucion['ciudad']) ?>, <?= htmlspecialchars($institucion['pais']) ?></span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bx bx-building me-2 text-muted"></i>
                                <span>Institución: <?= htmlspecialchars($institucion['tipo']) ?></span>
                            </li>
                        </ul>
                        <a href="<?= htmlspecialchars($institucion['url']) ?>" target="_blank" class="btn btn-primary w-100">
                            <i class="bi bi-globe me-2"></i>Visitar Sitio Web
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>