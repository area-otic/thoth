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

    /* Estilos para los acordeones en móvil */
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: var(--primary-blue);
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,.125);
    }

    /* Estilos para el texto truncado con líneas limitadas */
    .text-truncate-container {
        display: -webkit-box;
        -webkit-line-clamp: var(--lines, 3);
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Mejoras para los popovers de docentes */
    .teacher-popover-content {
        max-width: 300px;
        max-height: 300px;
        overflow-y: auto;
        padding: 0.5rem;
    }

    /* Mejoras para las celdas en móvil */
    @media (max-width: 767.98px) {
        .comparison-row td {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        
        .mobile-optimized-cell {
            min-width: 50vw;
        }
    }

/* Estilos para los botones de toggle */
.toggle-content {
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    margin-top: 0.5rem;
}

.toggle-content:hover {
    color: var(--dark-blue) !important;
}

.toggle-content i {
    transition: transform 0.3s;
}

.toggle-content.expanded i {
    transform: rotate(180deg);
}

/* Botón de eliminar */
.remove-program {
    opacity: 0.5;
    transition: all 0.3s;
}

.remove-program:hover {
    opacity: 1;
    transform: scale(1.1);
}


/* Estilos para la versión móvil */
@media (max-width: 767.98px) {
    .comparison-row .card {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .comparison-row .card-header {
        padding: 0.75rem 1rem;
        font-weight: 600;
    }
    
    .comparison-row .card-body {
        padding: 1rem;
    }
    
    .comparison-row .feature-icon {
        width: 32px;
        height: 32px;
    }
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
                <div class="row g-0">
                    <div class="col-md-3">
                        <h5 class="fw-semibold mb-0 text-primary">
                            <i class="bi bi-bar-chart me-2"></i>Comparación Detallada
                        </h5>
                    </div>
                    
                    <?php foreach ($programs as $program): ?>

                    <div class="col-md-3 position-relative">
                        <span class="badge badge-<?= strtolower($program['tipo']) ?> mb-2">
                            <?= $program['tipo'] ?>
                        </span>
                        <h5 class="fw-medium mb-0"><?= $program['titulo'] ?></h5>
                        <p class="small text-muted mb-0"><?= $program['universidad'] ?></p>
                        
                        <!-- Botón para ver landing -->
                        <a href="programa.php?id=<?= $program['id'] ?>" class="btn btn-sm btn-link p-0 mt-1">
                            <small>Ver detalles completos</small>
                        </a>
                        
                        <!-- Botón para eliminar de comparación -->
                        <button class="btn btn-sm btn-link text-danger p-0 remove-program" 
                                data-id="<?= $program['id'] ?>"
                                style="position: absolute; top: 0; right: 0;">
                            <i class="bi bi-x-lg"></i>
                        </button>
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
                            <td class="fw-medium ps-4 col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bx bx-building"></i>
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
                        
                        <!-- Plan de Estudios - Versión optimizada -->
                        <tr class="comparison-row">
                            <!-- Columna de título (solo visible en desktop) -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                    Plan de Estudios
                                </div>
                            </td>
                            
                            <?php foreach ($programs as $program): ?>
                            <!-- Versión desktop (horizontal) -->
                            <td class="d-none d-md-table-cell">
                                <?php if (!empty($program['plan_estudios'])): ?>
                                    <?php 
                                    $lineas = explode("\n", $program['plan_estudios']);
                                    $lineas_limpias = array_filter(array_map('trim', $lineas));
                                    ?>
                                    
                                    <ul class="list-unstyled mb-1" id="planList-<?= $program['id'] ?>">
                                        <?= generateTruncatedPlan($lineas_limpias, 3) ?>
                                    </ul>
                                    
                                    <?php if(count($lineas_limpias) > 3): ?>
                                        <a href="#" class="text-primary small toggle-plan" 
                                        data-target="planList-<?= $program['id'] ?>" 
                                        data-full="<?= htmlspecialchars(generateFullPlan($lineas_limpias)) ?>"
                                        data-truncated="<?= htmlspecialchars(generateTruncatedPlan($lineas_limpias, 3)) ?>">
                                            Ver más <i class="bi bi-chevron-down"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                <?php else: ?>
                                    <span class="text-muted small">No disponible</span>
                                <?php endif; ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil (vertical) -->
                            <td class="d-md-none" colspan="<?= count($programs) ?>">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                    <h6 class="mb-0">Plan de Estudios</h6>
                                </div>
                                
                                <div class="row g-3">
                                    <?php foreach ($programs as $program): ?>
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><?= htmlspecialchars($program['titulo']) ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <?php if (!empty($program['plan_estudios'])): ?>
                                                    <?php 
                                                    $lineas = explode("\n", $program['plan_estudios']);
                                                    $lineas_limpias = array_filter(array_map('trim', $lineas));
                                                    ?>
                                                    
                                                    <ul class="list-unstyled mb-1" id="planListMobile-<?= $program['id'] ?>">
                                                        <?= generateTruncatedPlan($lineas_limpias, 3) ?>
                                                    </ul>
                                                    
                                                    <?php if(count($lineas_limpias) > 3): ?>
                                                        <a href="#" class="text-primary small toggle-plan" 
                                                        data-target="planListMobile-<?= $program['id'] ?>" 
                                                        data-full="<?= htmlspecialchars(generateFullPlan($lineas_limpias)) ?>"
                                                        data-truncated="<?= htmlspecialchars(generateTruncatedPlan($lineas_limpias, 3)) ?>">
                                                            Ver más <i class="bi bi-chevron-down"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    
                                                <?php else: ?>
                                                    <span class="text-muted small">No disponible</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                        <!-- Objetivos - Versión optimizada -->
                        <tr class="comparison-row">
                            <!-- Columna de título (solo visible en desktop) -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-bullseye"></i>
                                    </div>
                                    Objetivos
                                </div>
                            </td>
                            
                            <?php foreach ($programs as $program): ?>
                            <!-- Versión desktop (horizontal) -->
                            <td class="d-none d-md-table-cell">
                                <?php if (!empty($program['objetivos'])): ?>
                                    <div class="small text-muted" id="objectivesDesktop-<?= $program['id'] ?>">
                                        <?= nl2br(htmlspecialchars(truncateText($program['objetivos'], 200))) ?>
                                    </div>
                                    <?php if(strlen($program['objetivos']) > 200): ?>
                                        <a href="#" class="text-primary small toggle-objectives" 
                                        data-target="objectivesDesktop-<?= $program['id'] ?>" 
                                        data-full="<?= htmlspecialchars($program['objetivos']) ?>"
                                        data-truncated="<?= htmlspecialchars(truncateText($program['objetivos'], 200)) ?>">
                                            Ver más <i class="bi bi-chevron-down"></i>
                                        </a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-muted small">--</span>
                                <?php endif; ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil (vertical) -->
                            <td class="d-md-none" colspan="<?= count($programs) ?>">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-bullseye"></i>
                                    </div>
                                    <h6 class="mb-0">Objetivos</h6>
                                </div>
                                
                                <div class="row g-3">
                                    <?php foreach ($programs as $program): ?>
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0"><?= htmlspecialchars($program['titulo']) ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <?php if (!empty($program['objetivos'])): ?>
                                                    <div class="small text-muted" id="objectivesMobile-<?= $program['id'] ?>">
                                                        <?= nl2br(htmlspecialchars(truncateText($program['objetivos'], 200))) ?>
                                                    </div>
                                                    <?php if(strlen($program['objetivos']) > 200): ?>
                                                        <a href="#" class="text-primary small toggle-objectives" 
                                                        data-target="objectivesMobile-<?= $program['id'] ?>" 
                                                        data-full="<?= htmlspecialchars($program['objetivos']) ?>"
                                                        data-truncated="<?= htmlspecialchars(truncateText($program['objetivos'], 200)) ?>">
                                                            Ver más <i class="bi bi-chevron-down"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="text-muted small">--</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>

                        <!-- Docentes - Versión optimizada -->
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
                                    <!-- Versión móvil - Texto completo en vertical -->
                                    <div class="d-block d-md-none">
                                        <div class="small">
                                            <?= nl2br(htmlspecialchars($program['docentes'])) ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Versión desktop - Popover -->
                                    <div class="d-none d-md-block">
                                        <button class="btn btn-sm btn-outline-primary" 
                                                data-bs-toggle="popover" 
                                                data-bs-html="true"
                                                title="Cuerpo docente" 
                                                data-bs-content="<?= htmlspecialchars(nl2br($program['docentes'])) ?>">
                                            Ver docentes
                                        </button>
                                    </div>
                                    
                                <?php else: ?>
                                    <span class="text-muted small">No disponible</span>
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
                        <a class="btn btn-primary me-2" href="contacto.php">
                            <i class="bi bi-envelope me-1"></i> Contactar
                            </a>                            
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
<?php
function truncateText($text, $length = 200) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}

function generateFullPlan($lines) {
    return array_reduce($lines, function($carry, $line) {
        return $carry . '<li class="mb-1 small">' . htmlspecialchars($line) . '</li>';
    }, '');
}

function generateTruncatedPlan($lines, $limit) {
    $truncated = array_slice($lines, 0, $limit);
    return generateFullPlan($truncated);
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar "Ver más/Ver menos" para todos los elementos
    function handleToggleClick(e) {
        e.preventDefault();
        const toggle = e.currentTarget;
        const targetId = toggle.getAttribute('data-target');
        const target = document.getElementById(targetId);
        const isExpanded = toggle.classList.contains('expanded');
        
        // Para ambos casos (plan de estudios y objetivos)
        if (isExpanded) {
            // Mostrar versión corta
            target.innerHTML = toggle.getAttribute('data-truncated');
            toggle.innerHTML = 'Ver más <i class="bi bi-chevron-down"></i>';
        } else {
            // Mostrar versión completa
            target.innerHTML = toggle.getAttribute('data-full');
            toggle.innerHTML = 'Ver menos <i class="bi bi-chevron-up"></i>';
        }
        
        toggle.classList.toggle('expanded');
    }
    
    // Asignar eventos a todos los toggles
    document.querySelectorAll('.toggle-plan, .toggle-objectives').forEach(toggle => {
        toggle.addEventListener('click', handleToggleClick);
    });
    
    // Inicializar popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(popoverEl => {
        return new bootstrap.Popover(popoverEl, {
            html: true,
            container: 'body'
        });
    });
    
    // Eliminar programa de comparación
    document.querySelectorAll('.remove-program').forEach(btn => {
        btn.addEventListener('click', function() {
            const programId = this.getAttribute('data-id');
            let programIds = new URLSearchParams(window.location.search).get('ids').split(',');
            
            // Filtrar el ID a eliminar
            programIds = programIds.filter(id => id !== programId);
            
            // Redirigir con los IDs actualizados
            if (programIds.length > 0) {
                window.location.href = `comparacion.php?ids=${programIds.join(',')}`;
            } else {
                window.location.href = 'nuestros-programas.php';
            }
        });
    });
    
    // Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(tooltipEl => {
        return new bootstrap.Tooltip(tooltipEl);
    });
});
</script>

<?php include 'includes/footer.php'; ?>