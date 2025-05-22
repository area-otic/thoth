<?php
include 'includes/header.php';
include 'includes/db.php';

// Obtener programas a comparar
$programIds = isset($_GET['ids']) ? explode(',', $_GET['ids']) : [];
$programs = [];

if (!empty($programIds)) {
    $placeholders = implode(',', array_fill(0, count($programIds), '?'));
    $stmt = $conn->prepare("SELECT * FROM data_programas WHERE id IN ($placeholders)");
    $stmt->execute($programIds);
    $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<style>
    /* Estilos base de tu plantilla */
    :root {
        --primary-blue: #3b82f6;
        --primary-purple: #8b5cf6;
        --primary-orange: #f97316;
        --primary-gray: #64748b;
        --dark-blue: #1e40af;
        --light-bg: #f8fafc;
    }
    
    .comparison-header {
        background: linear-gradient(135deg, #001f3f 0%, #003366 50%, #00509e 100%);
    }
    
    .program-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .feature-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 15px;
    }
    
    .comparison-row {
        border-bottom: 1px solid #e9ecef;
        transition: background-color 0.2s;
    }
    
    .comparison-row:hover {
        background-color: #f8f9fa;
    }
    
    .value-highlight {
        font-weight: 600;
        color: var(--dark-blue);
    }
    
    .badge-type {
        padding: 0.35em 0.65em;
        font-weight: 500;
        border-radius: 50rem;
    }
    
    .badge-masters {
        background-color: var(--primary-blue);
    }
    
    .badge-doctorate {
        background-color: var(--primary-purple);
    }
    
    .badge-certification {
        background-color: var(--primary-orange);
    }
    
    .sticky-comparison-header {
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }
    
    .comparison-table th {
        font-weight: 500;
        color: #6c757d;
        background-color: #f8f9fa;
    }
    
    .help-tooltip {
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .help-tooltip:hover {
        color: var(--primary-blue);
    }
    .section-title {
        position: relative;
        padding-left: 1rem;
        font-weight: 600;
    }
    
    .section-title::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--dark-blue);
        border-radius: 4px;
    }
</style>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<!-- Encabezado de Comparación -->
<div class="comparison-header text-white pt-13 py-8">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <a href="inicio.php" class="text-decoration-none text-light-emphasis opacity-85 hover-opacity-100">
                                <i class="bi bi-house-door"></i> Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="nuestros-programas.php" class="text-decoration-none text-light-emphasis opacity-85 hover-opacity-100">
                                <i class="bi bi-search"></i> Buscar Programas
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-light-emphasis opacity-100" aria-current="page">
                            <i class="bi bi-bar-chart"></i> Comparación
                        </li>
                    </ol>
                </nav>
                
                <div class="d-flex align-items-center mb-4">
                    <h1 class="display-5 fw-bold mb-0 me-4">Comparación de Programas</h1>
                    <span class="badge bg-white text-primary fs-6 fw-normal px-3 py-2 rounded-pill">
                        <i class="bi bi-check-circle me-2"></i><?php echo count($programIds); ?> seleccionados
                    </span>
                </div>
                
                <p class="lead mb-4 opacity-85" style="max-width: 600px;">
                    Analiza detalladamente tus opciones académicas para tomar la mejor decisión
                </p>
                
                <div class="d-flex align-items-center flex-wrap gap-4">
                    <div class="d-flex align-items-center">
                        <div class="feature-icon fs-5">
                            <i class="bx bx-bxs-check-circle"></i>
                        </div>
                        <span>Comparación lado a lado</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="feature-icon text-primary fs-5">
                            <i class="bx bx-bxs-star" style="color: white;"></i>
                        </div>
                        <span>Evaluación objetiva</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><i class="bi bi-info-circle me-2"></i>Resumen</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Programas:</span>
                            <span class="fw-medium"><?= count($programs) ?></span>
                        </div>
                        
                        <?php if (!empty($programs)): ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Rango de precios:</span>
                            <span class="fw-medium">
                                <?= min(array_column($programs, 'precio_monto')) ?> - <?= max(array_column($programs, 'precio_monto')) ?> <?= $programs[0]['precio_moneda'] ?>
                            </span>
                        </div>
                        <?php endif; ?>
                        
                        <button class="btn btn-sm btn-primary w-100 mt-2">
                            <i class="bi bi-download me-2"></i>Exportar comparación
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class=" min-vh-100 bg-light">

    <!-- Contenido Principal -->
    <div class="container py-5 ">
               
        <?php if (empty($programs)): ?>
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i> No has seleccionado programas para comparar.
                <a href="nuestros-programas.php" class="alert-link ms-2">Buscar programas</a>
            </div>
        <?php else: ?>
            <!-- Tabla de Comparación -->
            <div class="card border-0 shadow-sm mb-5 overflow-hidden" style="border-radius: 14px;">
               
            <!-- Encabezado Pegajoso -->
                <div class="sticky-comparison-header p-4 border-bottom" style="border-radius: 14px;">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <h5 class="fw-semibold mb-0 text-primary">
                                <i class="bi bi-bar-chart me-2"></i>Comparación Detallada
                            </h5>
                        </div>
                        
                        <?php foreach ($programs as $program): ?>
                        <div class="col-md-3">
                            <span class="badge badge-<?= strtolower($program['tipo']) ?> mb-2">
                                <?= $program['tipo'] ?>
                            </span>
                            <h5 class="fw-medium mb-0"><?= $program['titulo'] ?></h5>
                            <p class="small text-muted mb-0"><?= $program['universidad'] ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Tabla de Comparación -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <!-- Información Básica -->
                            <tr class="bg-light">
                                <td colspan="<?= count($programs) + 1 ?>" class="fw-bold p-4">
                                    <h6 class="section-title text-uppercase text-muted mb-0">Información Básica</h6>
                                </td>
                            </tr>
                            
                            <!-- Universidad -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon fs-5 text-primary">
                                            <i class="bi bi-building"></i>
                                        </div>
                                        Universidad
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td><?= $program['universidad'] ?></td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Tipo -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon fs-5 text-primary">
                                            <i class="bi bi-mortarboard"></i>
                                        </div>
                                        Tipo de Programa
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td><?= $program['tipo'] ?></td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Duración -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-opacity-10 text-primary">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        Duración
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td>
                                    <span class="value-highlight"><?= $program['duracion'] ?></span>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Modalidad -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon fs-5 text-primary">
                                            <i class="bi bi-laptop"></i>
                                        </div>
                                        Modalidad
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td><?= $program['modalidad'] ?></td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Precio -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon fs-5 text-primary">
                                            <i class="bi bi-cash-stack"></i>
                                        </div>
                                        Precio
                                        <i class="bi bi-question-circle ms-2 help-tooltip" title="Precio total del programa"></i>
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td>
                                    <span class="value-highlight"><?= $program['precio_moneda'] ?> <?= $program['precio_monto'] ?></span>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Idioma -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon fs-5 text-primary">
                                            <i class="bi bi-translate"></i>
                                        </div>
                                        Idioma
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td><?= !empty($program['idioma']) ? $program['idioma'] : '--' ?></td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Título Obtenido -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon fs-5 text-primary">
                                            <i class="bi bi-award"></i>
                                        </div>
                                        Título Obtenido
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td><?= !empty($program['titulo_grado']) ? $program['titulo_grado'] : '--' ?></td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Separador - Detalles Académicos -->
                            <tr class="bg-light">
                                <td colspan="<?= count($programs) + 1 ?>" class="fw-bold p-4">
                                    <h6 class="section-title text-uppercase text-muted mb-0">Detalles Académicos</h6>
                                </td>
                            </tr>
                            
                            <!-- Plan de Estudios -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon fs-5 text-primary">
                                            <i class="bi bi-journal-text"></i>
                                        </div>
                                        Plan de Estudios
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td>
                                    <?php if (!empty($program['plan_estudios'])): ?>
                                        <small><?php echo htmlspecialchars($program['plan_estudios']); ?></small>
                                    <?php else: ?>
                                        <small class="text-muted">No disponible</small>
                                    <?php endif; ?>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Objetivos -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon fs-5 text-primary">
                                            <i class="bi bi-bullseye"></i>
                                        </div>
                                        Objetivos
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td>
                                    <small>
                                        <?= !empty($program['objetivos']) ? $program['objetivos'] : '--' ?>
                                    </small>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Docentes -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon text-primary">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        Cuerpo Docente
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td>
                                    <?php if (!empty($program['docentes'])): ?>
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="popover" 
                                            title="Docentes" data-bs-content="<?= htmlspecialchars($program['docentes']) ?>">
                                            Ver docentes
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted">No disponible</span>
                                    <?php endif; ?>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Separador - Información Adicional -->
                            <tr class="bg-light">
                                <td colspan="<?= count($programs) + 1 ?>" class="fw-bold p-4">
                                    <h6 class="section-title text-uppercase text-muted mb-0">Información Adicional</h6>
                                </td>
                            </tr>
                            
                            <!-- Fecha Admisión -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon  text-primary">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        Próxima Admisión
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td><?= $program['fecha_admision'] ?? 'No especificada' ?></td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- Brochure -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon text-primary">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </div>
                                        Brochure
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td>
                                    <?php if (!empty($program['url_brochure'])): ?>
                                        <a href="<?= $program['url_brochure'] ?>" target="_blank" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-file-earmark-pdf me-1"></i>Descargar
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">No disponible</span>
                                    <?php endif; ?>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                            
                            <!-- URL Oficial -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-opacity-10 text-primary">
                                            <i class="bi bi-link-45deg"></i>
                                        </div>
                                        Sitio Oficial
                                    </div>
                                </td>
                                <?php foreach ($programs as $program): ?>
                                <td>
                                    <a href="<?= $program['url'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        Visitar sitio <i class="bi bi-box-arrow-up-right ms-1"></i>
                                    </a>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Recomendación -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-4 d-inline-flex align-items-center justify-content-center">
                                <i class="bi bi-lightbulb fs-2"></i>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h4 class="mb-3">Recomendación Personalizada</h4>
                            <p class="text-muted">
                                Basado en tu comparación, te recomendamos el programa <strong><?= $programs[0]['titulo'] ?></strong> 
                                por su equilibrio entre costo, duración y prestigio académico.
                            </p>
                        </div>
                        <div class="col-md-3 text-end">
                            <button class="btn btn-primary me-2">
                                <i class="bi bi-envelope me-1"></i> Contactar
                            </button>                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Acciones Finales -->
            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-danger" onclick="localStorage.removeItem('comparePrograms'); window.location.href='nuestros-programas.php';">
                    <i class="bi bi-trash me-2"></i> Limpiar comparación
                </button>
                <div>                    
                    <button class="btn btn-primary">
                        <i class="bi bi-download me-2"></i> Exportar PDF
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Botón Flotante de Ayuda -->
<a href="#" class="position-fixed bottom-3 end-3 btn btn-primary btn-lg rounded-circle shadow" data-bs-toggle="tooltip" title="¿Necesitas ayuda?">
    <i class="bi bi-question-lg"></i>
</a>

<script>
    // Activar tooltips y popovers
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });
</script>

<?php include 'includes/footer.php'; ?>