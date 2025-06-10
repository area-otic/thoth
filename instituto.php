<?php
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
// Definir el título de la página con el nombre de la institución
$pageTitle = htmlspecialchars($institucion['nombre']) . " - Programas Académicos - Thoth Education";

include 'includes/header.php';

// Configuración de paginación
$programasPorPagina = 10;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $programasPorPagina;

// Consultar programas de esta institución
try {
    // Primero obtener el total de programas
    $stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM data_programas WHERE id_universidad = ?");
    $stmt_total->execute([$id_institucion]);
    $totalPrograms = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Luego obtener los programas para la página actual
    $stmt_programas = $conn->prepare("SELECT * FROM data_programas WHERE id_universidad = ? LIMIT ? OFFSET ?");
    $stmt_programas->bindValue(1, $id_institucion, PDO::PARAM_INT);
    $stmt_programas->bindValue(2, $programasPorPagina, PDO::PARAM_INT);
    $stmt_programas->bindValue(3, $offset, PDO::PARAM_INT);
    $stmt_programas->execute();
    $programas = $stmt_programas->fetchAll(PDO::FETCH_ASSOC);
    
    $totalPaginas = ceil($totalPrograms / $programasPorPagina);
} catch(PDOException $e) {
    $programas = [];
    $totalPrograms = 0;
    $totalPaginas = 1;
}
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
    .program-card {
        transition: all 0.3s ease;
    }
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .pagination .page-item.active .page-link {
        background-color: #1a3a8f;
        border-color: #1a3a8f;
    }
    .pagination .page-link {
        color: #1a3a8f;
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
                        <span class="mx-2 text-white">›</span>
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
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="h4 fw-bold mb-0 d-flex align-items-center">
                                <i class="bi bi-book-fill text-primary me-2"></i>
                                Programas Disponibles (<?= $totalPrograms ?>)
                            </h2>
                        </div>
                        
                        <?php if($totalPrograms > 0): ?>
                            <div class="row">
                                <?php foreach($programas as $programa): ?>
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100 shadow-sm border-0 program-card">
                                            <div class="card-img-top overflow-hidden position-relative" style="height: 200px;">
                                                <img src="<?= htmlspecialchars($programa['imagen_url'] ?? 'https://via.placeholder.com/400x250') ?>" 
                                                     onerror="this.src='assets/img/imagen-programa.webp';" alt="<?= htmlspecialchars($programa['titulo']) ?>" 
                                                     class="img-fluid w-100 h-100 object-fit-cover">
                                                <div class="position-absolute top-0 start-0 w-100 h-100" 
                                                     style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0) 100%);">
                                                </div>
                                                <span class="position-absolute top-0 end-0 m-2 badge bg-primary rounded-pill">
                                                    <?= htmlspecialchars($programa['tipo'] ?? 'Programa') ?>
                                                </span>                      
                                            </div>
                                            
                                            <div class="card-body d-flex flex-column">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <span class="badge bg-label-info rounded-pill text-primary"><?= htmlspecialchars($programa['categoria'] ?? 'General') ?></span>
                                                    </div>

                                                    <h3 class="h5 card-title fw-bold mb-2"><?= htmlspecialchars($programa['titulo']) ?></h3>
                                                    <small class="text-muted mb-3"><?= substr(htmlspecialchars($programa['descripcion'] ?? 'Programa académico de excelencia'), 0, 100) ?>...</small>
                                                </div>
                                                
                                                <div class="mt-auto mb-3">
                                                    <div class="d-flex align-items-center text-muted mb-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                                            <circle cx="12" cy="10" r="3"></circle>
                                                        </svg>
                                                        <?= htmlspecialchars($programa['pais'] ?? 'Online') ?>
                                                    </div>

                                                    <div class="d-flex align-items-center text-muted mb-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <polyline points="12 6 12 12 16 14"></polyline>
                                                        </svg>
                                                        <?= htmlspecialchars($programa['duracion']) ?>
                                                    </div>
                                                    <div class="d-flex align-items-center text-muted mb-2">
                                                        <?php if(strtolower($programa['modalidad']) === 'presencial'): ?>
                                                            <i class="bx bx-building me-2 text-muted"></i>
                                                        <?php elseif(strtolower($programa['modalidad']) === 'online'): ?>
                                                            <i class="bi bi-laptop me-2 text-muted"></i>
                                                        <?php else: ?>
                                                            <i class="bi bi-collection me-2 text-muted"></i>
                                                        <?php endif; ?>
                                                        <?= htmlspecialchars($programa['modalidad']) ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex justify-content-between mt-auto">
                                                    <a href="programa.php?id=<?= $programa['id'] ?>" class="btn btn-label-primary d-flex align-items-center">
                                                        <span class="me-2">Ver detalles</span>
                                                        <i class="bx bx-chevron-right"></i>
                                                    </a>
                                                    <a href="comparacion.php?add=<?= $programa['id'] ?>" class="btn btn-outline-primary d-flex align-items-center compare-btn">
                                                        <i class="bx bx-book me-1"></i>
                                                        Comparar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Paginación -->
                            <?php if($totalPaginas > 1): ?>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php if($paginaActual > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?id=<?= $id_institucion ?>&pagina=<?= $paginaActual - 1 ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
                                            <li class="page-item <?= ($i == $paginaActual) ? 'active' : '' ?>">
                                                <a class="page-link" href="?id=<?= $id_institucion ?>&pagina=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        
                                        <?php if($paginaActual < $totalPaginas): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?id=<?= $id_institucion ?>&pagina=<?= $paginaActual + 1 ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="alert alert-info">
                                No se encontraron programas disponibles para esta institución.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar - 1/3 -->
            <div class="col-lg-4">
                <!-- Quick Stats -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="h4 fw-bold mb-3 d-flex align-items-center">
                            <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                            Estadísticas
                        </h2>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="stat-card text-center p-3 bg-light rounded">
                                    <div class="h4 fw-bold text-primary"><?= $totalPrograms ?></div>
                                    <small class="text-muted">Programas disponibles</small>
                                </div>
                            </div>
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