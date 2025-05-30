<?php
include 'includes/header.php';
include 'includes/db.php';

// Obtener IDs de programas a comparar
$programIds = [];
if (isset($_GET['ids'])) {
    $programIds = explode(',', $_GET['ids']);
} elseif (isset($_SESSION['compare_programs'])) {
    $programIds = $_SESSION['compare_programs'];
}

// Verificar si hay programas para comparar
$showComparison = !empty($programIds);

if ($showComparison) {
    // Solo ejecutar la consulta si hay IDs
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
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    /* Distribución exacta de columnas */
    .sticky-comparison-header .col {
        flex: 1 0 0%;
        min-width: 0;
    }

    /* Bordes divisores entre programas */
    .sticky-comparison-header .col:not(:first-child) {
        border-left: 1px solid #f0f0f0 !important;
    }

    /* Mejoras visuales para las tarjetas de programa */
    .sticky-comparison-header .bg-light {
        background-color: #f8f9fa !important;
        transition: all 0.3s ease;
    }
    .sticky-comparison-header .bg-light:hover {
        background-color: #e9ecef !important;
    }

    /* Scroll horizontal suave en móvil */
    @media (max-width: 767.98px) {
        .overflow-auto {
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Firefox */
        }
        
        .overflow-auto::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }
    }
    
    /* Espaciado responsive */
    @media (max-width: 767.98px) {
        .sticky-comparison-header {
            padding: 1rem !important;
        }
        
        .sticky-comparison-header .p-2 {
            padding: 0.5rem !important;
        }
        
        .sticky-comparison-header h5 {
            font-size: 1rem;
        }
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

    .d-fluid {
        width: 100%;
        max-width: 100%;
        padding-right: var(--bs-gutter-x, 1rem);
        padding-left: var(--bs-gutter-x, 1rem);
        margin-right: auto;
        margin-left: auto;
    }
    
    @media (min-width: 992px) {
        .d-fluid {
            --bs-gutter-x: 1.5rem;
            width: 100%;
            max-width: 1320px; /* O el ancho máximo que uses */
        }
    }

    .card-content {
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 16px;
        background: white;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Mejoras tipográficas */
    .program-title {
        font-weight: 600;
        margin: 12px 0 4px;
        color: #1a1a1a;
        font-size: 1.05rem;
        line-height: 1.3;
    }

    .program-university {
        color: #666;
        font-size: 0.85rem;
        margin-bottom: 16px;
        line-height: 1.4;
    }

    /* Estilos para el badge */
    .program-badge {
        font-size: 0.75rem;
        padding: 4px 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        align-self: flex-start; /* Mantiene el badge al inicio */
    }

    /* Mejoras UX para los botones */
    .program-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto; /* Empuja los botones hacia abajo */
        padding-top: 12px;
        border-top: 1px solid #f0f0f0;
    }

    .btn-details {
        color: #3b82f6;
        font-size: 0.8rem;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
        padding: 4px 0;
    }

    .btn-details:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    .btn-remove {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-remove:hover {
        background: #fecaca;
        transform: scale(1.1);
    }

    .card-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        background-color: white;
    }


    @media (min-width: 992px) {
        .program-card {
            width: 320px; /* Más espacio en desktop */
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
                            <span class="fw-medium"><?= $showComparison ? count($programs) : 0 ?></span>
                        </div>
                        
                        <?php if ($showComparison): ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Rango de precios:</span>
                            <span class="fw-medium">
                                <?= min(array_column($programs, 'precio_monto')) ?> - <?= max(array_column($programs, 'precio_monto')) ?> <?= $programs[0]['precio_moneda'] ?>
                            </span>
                        </div>
                        <?php endif; ?>
                        
                        <!--<button class="btn btn-sm btn-primary w-100 mt-2" <?= !$showComparison ? 'disabled' : '' ?>>
                            <i class="bi bi-download me-2"></i>Exportar comparación
                        </button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class=" min-vh-100 bg-light">
    <!-- Contenido Principal -->
    <div class="container py-5 d-lg-block d-fluid">
        <?php if (!$showComparison): ?>
            <!-- Mostrar mensaje cuando no hay programas -->
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i> No has seleccionado programas para comparar.
                <a href="nuestros-programas.php" class="alert-link ms-2">Buscar programas</a>
            </div>
        <?php else: ?>

        <!-- Tabla de Comparación -->
        <div class="card border-0 shadow-sm mb-5 overflow-hidden" style="border-radius: 14px;">
            <!-- Encabezado Pegajoso - Versión Mejorada Responsive -->
            <div class="sticky-comparison-header p-3 p-md-4 border-bottom" style="border-radius: 14px;">
                <div class="row g-0 align-items-center">
                    <!-- Título Comparación (ancho fijo) -->
                    <div class="col-md-3 pe-3">
                        <h5 class="fw-semibold mb-0 text-primary">
                            <i class="bi bi-bar-chart me-2"></i>Comparación Detallada
                        </h5>
                    </div>
                    
                    <!-- Contenedor de programas (HTML) -->
                    <div class="col">
                        <div class="row g-0 program-cards-container">
                            <?php foreach ($programs as $program): ?>
                            <div class="col program-card">  <!-- Eliminé position-relative si no es necesaria -->
                                <div class="card-content">  <!-- Este será el único elemento con sombra -->
                                    <span class="badge program-badge badge-<?= strtolower($program['tipo']) ?>">
                                        <?= $program['tipo'] ?>
                                    </span>
                                    <h5 class="program-title"><?= $program['titulo'] ?></h5>
                                    <p class="program-university"><?= $program['universidad'] ?></p>
                                    
                                    <div class="program-actions">
                                        <a href="programa.php?id=<?= $program['id'] ?>" class="btn-details">
                                            Ver detalles
                                        </a>
                                        <button class="btn-remove remove-program" data-id="<?= $program['id'] ?>">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tabla de Comparación -->
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                     <colgroup>
                        <col style="width: 25%;"> <!-- Columna de características fija al 25% -->
                        <?php foreach ($programs as $program): ?>
                        <col style="width: <?= 75/count($programs) ?>%;"> <!-- Columnas de programas dividen el 75% restante -->
                        <?php endforeach; ?>
                    </colgroup>
                    <tbody>
                        <!-- Información Básica -->
                        <tr class="bg-light">
                            <td colspan="<?= count($programs) + 1 ?>" class="fw-bold p-4">
                                <h6 class="section-title text-uppercase text-muted mb-0">Información Básica</h6>
                            </td>
                        </tr>

                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bx bx-building"></i>
                                    </div>
                                    Universidad
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <?= $program['universidad'] ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bx bx-building"></i>
                                    </div>
                                    <h6 class="mb-0">Universidad</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal (estilo igual al header) -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <?= $program['universidad'] ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Tipo de programa -->
                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    Tipo de Programa
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <?= $program['tipo'] ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2 ">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    <h6 class="mb-0">Tipo de Programa</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal (estilo igual al header) -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <?= $program['tipo'] ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Duración -->
                         <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    Duración
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <span class="value-highlight"><?= $program['duracion'] ?></span>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <h6 class="mb-0">Duración</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal (estilo igual al header) -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <span class="value-highlight"><?= $program['duracion'] ?></span>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Modalidad -->
                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-laptop"></i>
                                    </div>
                                    Modalidad
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <?= $program['modalidad'] ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-laptop"></i>
                                    </div>
                                    <h6 class="mb-0">Modalidad</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <?= $program['modalidad'] ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Precio -->
                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    Precio
                                    <i class="bi bi-question-circle ms-2 help-tooltip" title="Precio total del programa"></i>
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <span class="value-highlight"><?= $program['precio_moneda'] ?> <?= $program['precio_monto'] ?></span>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    <h6 class="mb-0">Precio</h6>
                                    <i class="bi bi-question-circle ms-2 help-tooltip" title="Precio total del programa"></i>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <span class="value-highlight"><?= $program['precio_moneda'] ?> <?= $program['precio_monto'] ?></span>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Idioma -->
                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-translate"></i>
                                    </div>
                                    Idioma
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <?= !empty($program['idioma']) ? $program['idioma'] : '--' ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-translate"></i>
                                    </div>
                                    <h6 class="mb-0">Idioma</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <?= !empty($program['idioma']) ? $program['idioma'] : '--' ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Título Obtenido -->
                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-award"></i>
                                    </div>
                                    Título Obtenido
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <?= !empty($program['titulo_grado']) ? $program['titulo_grado'] : '--' ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-award"></i>
                                    </div>
                                    <h6 class="mb-0">Título Obtenido</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <?= !empty($program['titulo_grado']) ? $program['titulo_grado'] : '--' ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
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
                            <td class="d-md-none" colspan="4">
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
                            <td class="d-md-none" colspan="4">
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

                        <!-- Cuerpo Docente - Versión responsive -->
                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    Cuerpo Docente
                                </div>
                            </td>
                            
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <?php if (!empty($program['docentes'])): ?>
                                    <button class="btn btn-sm btn-outline-primary" 
                                            data-bs-toggle="popover" 
                                            data-bs-html="true"
                                            title="Cuerpo docente" 
                                            data-bs-content="<?= htmlspecialchars(nl2br($program['docentes'])) ?>">
                                        Ver docentes
                                    </button>
                                <?php else: ?>
                                    <span class="text-muted small">No disponible</span>
                                <?php endif; ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <h6 class="mb-0">Cuerpo Docente</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <?php if (!empty($program['docentes'])): ?>
                                                <div class="small">
                                                    <?= nl2br(htmlspecialchars($program['docentes'])) ?>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted small">No disponible</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Separador - Información Adicional -->
                        <tr class="bg-light">
                            <td colspan="<?= count($programs) + 1 ?>" class="fw-bold p-4">
                                <h6 class="section-title text-uppercase text-muted mb-0">Información Adicional</h6>
                            </td>
                        </tr>
                        
                        <!-- Fecha Admisión -->
                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                    Próxima Admisión
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <?= $program['fecha_admision'] ?? 'No especificada' ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                    <h6 class="mb-0">Próxima Admisión</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <?= $program['fecha_admision'] ?? 'No especificada' ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Brochure -->
                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </div>
                                    Brochure
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <?php if (!empty($program['url_brochure'])): ?>
                                    <a href="<?= $program['url_brochure'] ?>" target="_blank" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-file-earmark-pdf me-1"></i>Descargar
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No disponible</span>
                                <?php endif; ?>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </div>
                                    <h6 class="mb-0">Brochure</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <?php if (!empty($program['url_brochure'])): ?>
                                                <a href="<?= $program['url_brochure'] ?>" target="_blank" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-file-earmark-pdf me-1"></i>Descargar
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">No disponible</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- URL Oficial -->
                        <tr class="comparison-row">
                            <!-- Título para desktop -->
                            <td class="fw-medium ps-4 d-none d-md-table-cell col-md-3">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon fs-5 text-primary">
                                        <i class="bi bi-link-45deg"></i>
                                    </div>
                                    Sitio Oficial
                                </div>
                            </td>
                            <!-- Contenido para desktop -->
                            <?php foreach ($programs as $program): ?>
                            <td class="d-none d-md-table-cell">
                                <a href="<?= $program['url'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                    Visitar sitio <i class="bi bi-box-arrow-up-right ms-1"></i>
                                </a>
                            </td>
                            <?php endforeach; ?>
                            
                            <!-- Versión móvil -->
                            <td class="d-md-none" colspan="4">
                                <!-- Título arriba en móvil -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="feature-icon fs-5 text-primary me-2">
                                        <i class="bi bi-link-45deg"></i>
                                    </div>
                                    <h6 class="mb-0">Sitio Oficial</h6>
                                </div>
                                
                                <!-- Contenedor scrollable horizontal -->
                                <div class="col">
                                    <div class="row g-0">
                                        <?php foreach ($programs as $program): ?>
                                        <div class="col position-relative p-2 p-md-3" style="border-left: 1px solid #eee;">
                                            <a href="<?= $program['url'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                Visitar sitio <i class="bi bi-box-arrow-up-right ms-1"></i>
                                            </a>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
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
            <!--<div>                    
                <button class="btn btn-primary">
                    <i class="bi bi-download me-2"></i> Exportar PDF
                </button>
            </div>-->
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

    document.querySelectorAll('.remove-program').forEach(btn => {
        btn.addEventListener('click', function() {
            const programId = this.getAttribute('data-id');
            
            // Obtener programas actuales del localStorage
            const currentPrograms = JSON.parse(localStorage.getItem('comparePrograms')) || [];
            
            // Filtrar el ID a eliminar
            const updatedPrograms = currentPrograms.filter(id => id !== programId);
            
            // Actualizar localStorage
            localStorage.setItem('comparePrograms', JSON.stringify(updatedPrograms));
            
            // Disparar evento para actualizar el contador en otras pestañas
            window.dispatchEvent(new Event('storage'));
            
            // Redirigir con los IDs actualizados
            if (updatedPrograms.length > 0) {
                window.location.href = `comparacion.php?ids=${updatedPrograms.join(',')}`;
            } else {
                window.location.href = 'nuestros-programas.php';
            }
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