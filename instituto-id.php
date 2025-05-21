<?php
include 'includes/header.php';
include 'includes/db.php';
?>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-blue: #3b82f6;
        --primary-purple: #8b5cf6;
        --primary-orange: #f97316;
        --primary-gray: #64748b;
        --dark-blue: #1e40af;
        --light-bg: #f8fafc;
        --soft-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
    }
    
    .type-masters {
        background-color: var(--primary-blue);
        box-shadow: 0 4px 14px -2px rgba(59, 130, 246, 0.3);
    }
    .type-doctorate {
        background-color: var(--primary-purple);
        box-shadow: 0 4px 14px -2px rgba(139, 92, 246, 0.3);
    }
    .type-certification {
        background-color: var(--primary-orange);
        box-shadow: 0 4px 14px -2px rgba(249, 115, 22, 0.3);
    }
    .type-default {
        background-color: var(--primary-gray);
    }
    
    .comparison-row {
        padding: 1.5rem 0;
        border-bottom: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .comparison-row:hover {
        background-color: #f8fafc;
    }
    
    .program-card {
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: 1px solid rgba(226, 232, 240, 0.7);
        overflow: hidden;
        height: 100%;
    }
    
    .program-card.masters {
        border-top: 3px solid var(--primary-blue);
    }
    
    .program-card.doctorate {
        border-top: 3px solid var(--primary-purple);
    }
    
    .program-card.certification {
        border-top: 3px solid var(--primary-orange);
    }
    
    .program-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
    }
    
    .feature-icon {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        margin-right: 12px;
        flex-shrink: 0;
    }
    
    .feature-icon.available {
        background-color: rgba(34, 197, 94, 0.1);
        color: #16a34a;
    }
    
    .feature-icon.unavailable {
        background-color: rgba(239, 68, 68, 0.1);
        color: #dc2626;
    }
    
    .value-highlight {
        font-weight: 600;
        color: var(--dark-blue);
        font-size: 1.05rem;
    }
    
    .badge-pill {
        border-radius: 50rem;
        padding: 0.4em 0.75em;
        font-weight: 500;
        letter-spacing: 0.02em;
    }
    
    .sticky-header {
        position: sticky;
        top: 0;
        background: white;
        box-shadow: var(--soft-shadow);
        backdrop-filter: blur(8px);
        background-color: rgba(255, 255, 255, 0.85);
    }
    
    .breadcrumb-item a {
        transition: all 0.2s ease;
    }
    
    .breadcrumb-item a:hover {
        opacity: 0.9;
        text-decoration: underline;
    }
    
    .btn-elegant {
        border-radius: 8px;
        padding: 0.6rem 1.25rem;
        font-weight: 500;
        letter-spacing: 0.02em;
        transition: all 0.3s ease;
        border-width: 1px;
    }
    
    .btn-elegant-primary {
        background-color: var(--dark-blue);
        border-color: var(--dark-blue);
    }
    
    .btn-elegant-primary:hover {
        background-color: #1e3a8a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px -2px rgba(30, 64, 175, 0.3);
    }
    
    .summary-card {
        border-radius: 12px;
        border: 1px solid rgba(226, 232, 240, 0.7);
        box-shadow: var(--soft-shadow);
        overflow: hidden;
        background: white;
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
    
    .comparison-table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .comparison-table th {
        font-weight: 500;
        color: #64748b;
        background-color: #f8fafc;
    }
    
    .comparison-table td, .comparison-table th {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
    }
    
    .comparison-table tr:not(:last-child) td {
        border-bottom: 1px solid #e2e8f0;
    }
    
    .institution-logo {
        width: 40px;
        height: 40px;
        object-fit: contain;
        border-radius: 8px;
        margin-right: 12px;
        box-shadow: var(--soft-shadow);
        border: 1px solid #e2e8f0;
    }
    
    .floating-action-btn {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 16px -2px rgba(0, 0, 0, 0.1);
        z-index: 20;
        transition: all 0.3s ease;
    }
    
    .floating-action-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px -2px rgba(0, 0, 0, 0.15);
    }
</style>

<!-- Header Elegante -->
<div class="bg-gradient-primary-dark text-white pt-13 py-13">
    <div class="container position-relative ">
        <div class="row align-items-center">
            
            <div class="col-lg-8 py-4">
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
                        <i class="bi bi-check-circle me-2"></i>3 seleccionados
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
            
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="summary-card p-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                            <i class="bi bi-lightbulb fs-4"></i>
                        </div>
                        <h5 class="mb-0">Resumen Comparativo</h5>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Programas:</span>
                            <span class="fw-medium">3</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Rango de costos:</span>
                            <span class="fw-medium">$3.5K - $50K</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Duración:</span>
                            <span class="fw-medium">6 meses - 5 años</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Modalidades:</span>
                            <span class="fw-medium">Presencial/Online</span>
                        </div>
                    </div>
                    
                    <button class="btn btn-sm btn-primary w-100 mt-2">
                        <i class="bi bi-download me-2"></i>Exportar PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class=" min-vh-100 bg-light">
    <!-- Contenido Principal -->
    <div class="container py-5 position-relative" style=" margin-top: -2rem;">

        <!-- Tarjeta de Comparación -->
        <div class="card border-0 overflow-hidden" style="box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08); border-radius: 14px;  background-color:#f4f4f4">
            <!-- Encabezado Pegajoso -->
            <div class="sticky-header p-4 border-bottom" style="border-radius: 14px;">
                <div class="row g-4 align-items-center">
                    <div class="col-md-3">
                        <h5 class="fw-semibold mb-0 text-primary">
                            <i class="bi bi-bar-chart me-2"></i>Comparación Detallada
                        </h5>
                    </div>
                    <div class="col-md-3">
                        <span class="badge type-masters text-white mb-2">Maestría</span>
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="fw-medium mb-0">MSc Computer Science</h5>
                                <p class="text-muted small mb-0">Stanford University</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <span class="badge type-doctorate text-white mb-2">Doctorado</span>
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="fw-medium mb-0">PhD Computer Science</h5>
                                <p class="text-muted small mb-0">Massachusetts Institute of Technology</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <span class="badge type-certification text-white mb-2">Certificación</span>
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="fw-medium mb-0">Data Science Certification</h5>
                                <p class="text-muted small mb-0">Harvard University</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid de Comparación -->
            <div class="p-0" style="margin-top:10px; background-color: white;">
                <!-- Información Básica -->
                <div class="p-4 bg-light">
                    <h6 class="section-title text-uppercase text-muted mb-0">Información Básica</h6>
                </div>
                
                <!-- Tabla de Comparación -->
                <div class="table-responsive">
                    <table class="comparison-table w-100">
                        <tbody>
                            <!-- Duración -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-5" style="width: 25%;">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-blue-50 text-blue-600">
                                            <i class="bi bi-calendar3"></i>
                                        </div>
                                        Duración
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <span class="value-highlight">2 años</span>
                                    <small class="text-muted d-block mt-1">Tiempo completo</small>
                                </td>
                                <td style="width: 25%;">
                                    <span class="value-highlight">4-5 años</span>
                                    <small class="text-muted d-block mt-1">Investigación</small>
                                </td>
                                <td style="width: 25%;">
                                    <span class="value-highlight">6 meses</span>
                                    <small class="text-muted d-block mt-1">Tiempo parcial</small>
                                </td>
                            </tr>

                            <!-- Costo -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-5">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-green-50 text-green-600">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        Costo Total
                                    </div>
                                </td>
                                <td>
                                    <span class="value-highlight">$50,000 USD</span>
                                    <small class="text-muted d-block mt-1">$25K/año</small>
                                </td>
                                <td>
                                    <span class="value-highlight">$50,000 USD</span>
                                    <small class="text-muted d-block mt-1">$25K/año</small>
                                </td>
                                <td>
                                    <span class="value-highlight">$3,500 USD</span>
                                    <small class="text-muted d-block mt-1">Pago único</small>
                                </td>
                            </tr>

                            <!-- Modalidad -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-5">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-purple-50 text-purple-600">
                                            <i class="bi bi-laptop"></i>
                                        </div>
                                        Modalidad
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-blue-100 text-blue-800">Presencial</span>
                                </td>
                                <td>
                                    <span class="badge bg-blue-100 text-blue-800">Presencial</span>
                                </td>
                                <td>
                                    <span class="badge bg-indigo-100 text-indigo-800">100% Online</span>
                                </td>
                            </tr>

                            <!-- Campo de Estudio -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-5">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-amber-50 text-amber-600">
                                            <i class="bi bi-book"></i>
                                        </div>
                                        Campo de Estudio
                                    </div>
                                </td>
                                <td>
                                    Ciencias Computacionales
                                </td>
                                <td>
                                    Ciencias Computacionales
                                </td>
                                <td>
                                    Ciencia de Datos
                                </td>
                            </tr>

                            <!-- Calificación -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-5">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-yellow-50 text-yellow-600">
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        Calificación
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold me-3">4.8</span>
                                        <div class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold me-3">4.9</span>
                                        <div class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold me-3">4.5</span>
                                        <div class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Características Principales -->
                <div class="p-4 bg-light mt-4">
                    <h6 class="section-title text-uppercase text-muted mb-0">Características Principales</h6>
                </div>
                
                <div class="table-responsive">
                    <table class="comparison-table w-100">
                        <tbody>
                            <!-- Investigación -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-5" style="width: 25%;">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon available">
                                            <i class="bi bi-search"></i>
                                        </div>
                                        Oportunidades de Investigación
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i> Disponible
                                </td>
                                <td style="width: 25%;">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i> Enfocado en investigación
                                </td>
                                <td style="width: 25%;">
                                    <i class="bi bi-x-circle-fill text-danger me-2"></i> No disponible
                                </td>
                            </tr>
                            
                            <!-- Financiamiento -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-5">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon available">
                                            <i class="bi bi-cash-coin"></i>
                                        </div>
                                        Financiamiento/Asistencia
                                    </div>
                                </td>
                                <td>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i> Asistencia de enseñanza
                                </td>
                                <td>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i> Totalmente financiado
                                </td>
                                <td>
                                    <i class="bi bi-x-circle-fill text-danger me-2"></i> No disponible
                                </td>
                            </tr>
                            
                            <!-- Flexibilidad -->
                            <tr class="comparison-row">
                                <td class="fw-medium ps-5">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon available">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        Horario Flexible
                                    </div>
                                </td>
                                <td>
                                    <i class="bi bi-x-circle-fill text-danger me-2"></i> No disponible
                                </td>
                                <td>
                                    <i class="bi bi-x-circle-fill text-danger me-2"></i> No disponible
                                </td>
                                <td>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i> Totalmente flexible
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Análisis Comparativo -->
                <div class="p-5 mt-4 bg-blue-50">
                    <div class="d-flex align-items-center mb-5">
                        <div class="bg-primary rounded-circle p-3 me-4 text-white">
                            <i class="bi bi-lightbulb fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold text-primary mb-1">Análisis Comparativo</h5>
                            <p class="text-muted mb-0">Recomendaciones basadas en tus selecciones</p>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="h-100 d-flex flex-column">
                                <p class="text-muted mb-4">
                                    Esta comparación te ayuda a identificar las diferencias clave entre los programas seleccionados según tus objetivos académicos y profesionales.
                                </p>
                                <div class="mt-auto">
                                    <button class="btn btn-outline-primary w-100 btn-elegant">
                                        <i class="bi bi-chat-square-text me-2"></i>Recibir asesoría
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="program-card masters bg-white p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-blue-100 text-blue-600 rounded-circle p-3 me-3">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-0">Maestría</h6>
                                </div>
                                <ul class="list-unstyled small">
                                    <li class="mb-3">
                                        <span class="text-muted d-block mb-1">Mejor para:</span>
                                        <span class="fw-medium">Profesionales que buscan especialización</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="text-muted d-block mb-1">Inversión:</span>
                                        <span class="fw-medium">$$$ (Alto costo)</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="text-muted d-block mb-1">Salida laboral:</span>
                                        <span class="fw-medium">Industria tecnológica</span>
                                    </li>
                                    <li class="mt-4 pt-3 border-top">
                                        <a href="#" class="text-primary text-decoration-none small fw-medium">
                                            Ver detalles del programa <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="program-card doctorate bg-white p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-purple-100 text-purple-600 rounded-circle p-3 me-3">
                                        <i class="bi bi-eyeglasses"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-0">Doctorado</h6>
                                </div>
                                <ul class="list-unstyled small">
                                    <li class="mb-3">
                                        <span class="text-muted d-block mb-1">Mejor para:</span>
                                        <span class="fw-medium">Aspirantes a carrera académica</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="text-muted d-block mb-1">Inversión:</span>
                                        <span class="fw-medium">Tiempo (4-5 años)</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="text-muted d-block mb-1">Salida laboral:</span>
                                        <span class="fw-medium">Academia/Investigación</span>
                                    </li>
                                    <li class="mt-4 pt-3 border-top">
                                        <a href="#" class="text-primary text-decoration-none small fw-medium">
                                            Ver detalles del programa <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="program-card certification bg-white p-4 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-orange-100 text-orange-600 rounded-circle p-3 me-3">
                                        <i class="bi bi-award"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-0">Certificación</h6>
                                </div>
                                <ul class="list-unstyled small">
                                    <li class="mb-3">
                                        <span class="text-muted d-block mb-1">Mejor para:</span>
                                        <span class="fw-medium">Actualización profesional rápida</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="text-muted d-block mb-1">Inversión:</span>
                                        <span class="fw-medium">$ (Bajo costo)</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="text-muted d-block mb-1">Salida laboral:</span>
                                        <span class="fw-medium">Roles especializados</span>
                                    </li>
                                    <li class="mt-4 pt-3 border-top">
                                        <a href="#" class="text-primary text-decoration-none small fw-medium">
                                            Ver detalles del programa <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Acciones Finales -->
        <div class="d-flex justify-content-between mt-5 pt-4">
            <button class="btn btn-outline-secondary btn-elegant">
                <i class="bi bi-trash me-2"></i>Limpiar comparación
            </button>
            <div class="d-flex gap-3">
                <button class="btn btn-outline-primary btn-elegant">
                    <i class="bi bi-plus-circle me-2"></i>Añadir programa
                </button>
                <button class="btn btn-primary btn-elegant btn-elegant-primary">
                    <i class="bi bi-send me-2"></i>Contactar instituciones
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Botón Flotante -->
<a href="#" class="floating-action-btn bg-primary text-white">
    <i class="bi bi-question-lg"></i>
</a>

<?php include 'includes/footer.php'; ?>