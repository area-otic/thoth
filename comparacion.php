<?php
include 'includes/header.php';
include 'includes/db.php';
?>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
    /* Paleta de colores mejorada */
    :root {
        --primary-blue: #2563eb;
        --primary-purple: #7c3aed;
        --primary-orange: #f97316;
        --primary-gray: #4b5563;
        --light-bg: #f8fafc;
    }
    
    .comparison-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    }
    
    .type-masters {
        background-color: var(--primary-blue);
    }
    .type-doctorate {
        background-color: var(--primary-purple);
    }
    .type-certification {
        background-color: var(--primary-orange);
    }
    .type-default {
        background-color: var(--primary-gray);
    }
    
    .comparison-row {
        padding: 1.25rem 0;
        border-bottom: 1px solid #e2e8f0;
        transition: background-color 0.2s;
    }
    
    .comparison-row:hover {
        background-color: #f8fafc;
    }
    
    .program-card {
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }
    
    .program-card.masters {
        border-left-color: var(--primary-blue);
    }
    
    .program-card.doctorate {
        border-left-color: var(--primary-purple);
    }
    
    .program-card.certification {
        border-left-color: var(--primary-orange);
    }
    
    .program-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    .feature-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 12px;
    }
    
    .feature-icon.available {
        background-color: #dcfce7;
        color: #16a34a;
    }
    
    .feature-icon.unavailable {
        background-color: #fee2e2;
        color: #dc2626;
    }
    
    .value-highlight {
        font-weight: 600;
        color: #1e40af;
    }
    
    .badge-pill {
        border-radius: 50rem;
        padding: 0.35em 0.65em;
    }
    
    .sticky-header {
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
</style>

<!-- Header Especial para Comparación -->
<div class="comparison-header text-white py-6">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item">
                            <a href="inicio.php" class="text-decoration-none text-light opacity-75">
                                <i class="bi bi-house-door"></i> Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="buscar.php" class="text-decoration-none text-light opacity-75">
                                <i class="bi bi-search"></i> Buscar Programas
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-light" aria-current="page">
                            <i class="bi bi-bar-chart"></i> Comparar Programas
                        </li>
                    </ol>
                </nav>
                
                <div class="d-flex align-items-center mb-4">
                    <h1 class="display-5 fw-bold mb-0 me-3">Comparación de Programas</h1>
                    <span class="badge bg-white text-primary fs-6 fw-normal">3 seleccionados</span>
                </div>
                
                <p class="lead mb-0 opacity-85">
                    Compara lado a lado los programas seleccionados para tomar la mejor decisión académica
                </p>
            </div>
            
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <h5 class="fw-semibold text-dark mb-3">Resumen Rápido</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Programas:</span>
                        <span class="fw-medium">3</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Rango de costos:</span>
                        <span class="fw-medium">$3.5K - $50K</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Duración:</span>
                        <span class="fw-medium">6 meses - 5 años</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contenido Principal -->
<main class="container py-5">
    <!-- Controles de Comparación -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="buscar.php" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-2"></i>Volver a búsqueda
        </a>
        
        <div class="d-flex">
            <button class="btn btn-light me-2">
                <i class="bi bi-download me-2"></i>Exportar
            </button>
            <button class="btn btn-primary">
                <i class="bi bi-bookmark me-2"></i>Guardar comparación
            </button>
        </div>
    </div>

    <!-- Tarjeta de Comparación -->
    <div class="card shadow-sm border-0 overflow-hidden">
        <!-- Encabezado Pegajoso -->
        <div class="sticky-header p-4 border-bottom">
            <div class="row g-4 align-items-center">
                <div class="col-md-3">
                    <h5 class="fw-semibold mb-0 text-primary">
                        <i class="bi bi-bar-chart me-2"></i>Comparación Detallada
                    </h5>
                </div>
                <div class="col-md-3">
                    <span class="badge type-masters text-white mb-2">Maestría</span>
                    <h5 class="fw-medium mb-1">Maestría en Ciencias Computacionales</h5>
                    <p class="text-muted small mb-0">Stanford University</p>
                </div>
                <div class="col-md-3">
                    <span class="badge type-doctorate text-white mb-2">Doctorado</span>
                    <h5 class="fw-medium mb-1">PhD en Ciencias Computacionales</h5>
                    <p class="text-muted small mb-0">Massachusetts Institute of Technology</p>
                </div>
                <div class="col-md-3">
                    <span class="badge type-certification text-white mb-2">Certificación</span>
                    <h5 class="fw-medium mb-1">Certificación en Ciencia de Datos</h5>
                    <p class="text-muted small mb-0">Harvard University</p>
                </div>
            </div>
        </div>

        <!-- Grid de Comparación -->
        <div class="p-0">
            <!-- Información Básica -->
            <div class="p-4 bg-light">
                <h6 class="fw-semibold text-uppercase text-muted mb-3">Información Básica</h6>
            </div>
            
            <!-- Duración -->
            <div class="row comparison-row g-4 align-items-center px-4">
                <div class="col-md-3 fw-medium text-muted d-flex align-items-center">
                    <i class="bi bi-calendar3 me-2"></i> Duración
                </div>
                <div class="col-md-3">
                    <span class="value-highlight">2 años</span>
                </div>
                <div class="col-md-3">
                    <span class="value-highlight">4-5 años</span>
                </div>
                <div class="col-md-3">
                    <span class="value-highlight">6 meses</span>
                </div>
            </div>

            <!-- Costo -->
            <div class="row comparison-row g-4 align-items-center px-4">
                <div class="col-md-3 fw-medium text-muted d-flex align-items-center">
                    <i class="bi bi-currency-dollar me-2"></i> Costo Total
                </div>
                <div class="col-md-3">
                    <span class="value-highlight">$50,000 USD</span>
                    <small class="text-muted d-block">$25K/año</small>
                </div>
                <div class="col-md-3">
                    <span class="badge bg-success bg-opacity-10 text-success">Totalmente financiado</span>
                    <small class="text-muted d-block">+$30K estipendio anual</small>
                </div>
                <div class="col-md-3">
                    <span class="value-highlight">$3,500 USD</span>
                    <small class="text-muted d-block">Pago único</small>
                </div>
            </div>

            <!-- Modalidad -->
            <div class="row comparison-row g-4 align-items-center px-4">
                <div class="col-md-3 fw-medium text-muted d-flex align-items-center">
                    <i class="bi bi-laptop me-2"></i> Modalidad
                </div>
                <div class="col-md-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary">Presencial</span>
                </div>
                <div class="col-md-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary">Presencial</span>
                </div>
                <div class="col-md-3">
                    <span class="badge bg-info bg-opacity-10 text-info">100% Online</span>
                </div>
            </div>

            <!-- Campo de Estudio -->
            <div class="row comparison-row g-4 align-items-center px-4">
                <div class="col-md-3 fw-medium text-muted d-flex align-items-center">
                    <i class="bi bi-book me-2"></i> Campo de Estudio
                </div>
                <div class="col-md-3">
                    Ciencias Computacionales
                </div>
                <div class="col-md-3">
                    Ciencias Computacionales
                </div>
                <div class="col-md-3">
                    Ciencia de Datos
                </div>
            </div>

            <!-- Calificación -->
            <div class="row comparison-row g-4 align-items-center px-4">
                <div class="col-md-3 fw-medium text-muted d-flex align-items-center">
                    <i class="bi bi-star-fill text-warning me-2"></i> Calificación
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <span class="fw-bold me-2">4.8</span>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <span class="fw-bold me-2">4.9</span>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <span class="fw-bold me-2">4.5</span>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Características Principales -->
            <div class="p-4 bg-light mt-4">
                <h6 class="fw-semibold text-uppercase text-muted mb-3">Características Principales</h6>
            </div>
            
            <div class="px-4">
                <!-- Investigación -->
                <div class="row comparison-row g-4 align-items-center">
                    <div class="col-md-3 fw-medium text-muted d-flex align-items-center">
                        <div class="feature-icon available">
                            <i class="bi bi-search"></i>
                        </div>
                        Oportunidades de Investigación
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Disponible
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Enfocado en investigación
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-x-circle-fill text-danger me-2"></i> No disponible
                    </div>
                </div>
                
                <!-- Financiamiento -->
                <div class="row comparison-row g-4 align-items-center">
                    <div class="col-md-3 fw-medium text-muted d-flex align-items-center">
                        <div class="feature-icon available">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        Financiamiento/Asistencia
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Asistencia de enseñanza
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Totalmente financiado
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-x-circle-fill text-danger me-2"></i> No disponible
                    </div>
                </div>
                
                <!-- Flexibilidad -->
                <div class="row comparison-row g-4 align-items-center">
                    <div class="col-md-3 fw-medium text-muted d-flex align-items-center">
                        <div class="feature-icon available">
                            <i class="bi bi-clock"></i>
                        </div>
                        Horario Flexible
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-x-circle-fill text-danger me-2"></i> No disponible
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-x-circle-fill text-danger me-2"></i> No disponible
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Totalmente flexible
                    </div>
                </div>
            </div>

            <!-- Análisis Comparativo -->
            <div class="p-4 mt-5 bg-blue-50 rounded-lg">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary rounded-circle p-2 me-3">
                        <i class="bi bi-lightbulb text-white"></i>
                    </div>
                    <h5 class="fw-semibold text-primary mb-0">Análisis Comparativo</h5>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="h-100 d-flex flex-column">
                            <p class="text-muted mb-3">
                                Esta comparación te ayuda a identificar las diferencias clave entre los programas seleccionados.
                            </p>
                            <div class="mt-auto">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="bi bi-chat-square-text me-2"></i>Recibir asesoría
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="program-card masters bg-white p-4 rounded-lg h-100">
                            <h6 class="fw-semibold mb-3">Maestría en Ciencias Computacionales</h6>
                            <ul class="list-unstyled small">
                                <li class="mb-2">
                                    <span class="text-muted">Mejor para:</span>
                                    <span class="d-block fw-medium">Profesionales que buscan especialización</span>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted">Inversión:</span>
                                    <span class="d-block fw-medium">$$$ (Alto costo)</span>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted">Salida laboral:</span>
                                    <span class="d-block fw-medium">Industria tecnológica</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="program-card doctorate bg-white p-4 rounded-lg h-100">
                            <h6 class="fw-semibold mb-3">PhD en Ciencias Computacionales</h6>
                            <ul class="list-unstyled small">
                                <li class="mb-2">
                                    <span class="text-muted">Mejor para:</span>
                                    <span class="d-block fw-medium">Aspirantes a carrera académica/investigación</span>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted">Inversión:</span>
                                    <span class="d-block fw-medium">Tiempo (4-5 años)</span>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted">Salida laboral:</span>
                                    <span class="d-block fw-medium">Academia/Investigación</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="program-card certification bg-white p-4 rounded-lg h-100">
                            <h6 class="fw-semibold mb-3">Certificación en Ciencia de Datos</h6>
                            <ul class="list-unstyled small">
                                <li class="mb-2">
                                    <span class="text-muted">Mejor para:</span>
                                    <span class="d-block fw-medium">Actualización profesional rápida</span>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted">Inversión:</span>
                                    <span class="d-block fw-medium">$ (Bajo costo)</span>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted">Salida laboral:</span>
                                    <span class="d-block fw-medium">Roles especializados</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Acciones Finales -->
    <div class="d-flex justify-content-between mt-5">
        <button class="btn btn-outline-secondary">
            <i class="bi bi-trash me-2"></i>Limpiar comparación
        </button>
        <div>
            <button class="btn btn-outline-primary me-2">
                <i class="bi bi-plus-circle me-2"></i>Añadir otro programa
            </button>
            <button class="btn btn-primary">
                <i class="bi bi-send me-2"></i>Contactar instituciones
            </button>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>