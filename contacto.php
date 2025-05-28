<?php
include 'includes/header.php';
include 'includes/db.php';
?>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<div class="min-vh-100 bg-light">
    <!-- Header con Estilo Coherente -->
    <div class="bg-primary2 text-white pt-13 py-13">
        <div class="container px-4">
            <div class="d-flex flex-column flex-md-row align-items-md-end">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-2 text-info">
                        <a href="inicio.php" class="text-decoration-none text-white">
                            <i class="bi bi-house-door me-1"></i>Inicio
                        </a>
                        <span class="mx-2 text-white">›</span>
                        <a href="contacto.php" class="text-decoration-none text-white">
                            Contacto
                        </a>
                    </div>
                    
                    <h1 class="display-5 font-serif fw-extrabold mb-2">Contacta al equipo Thoth</h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-headset fs-5 me-2"></i>
                        <span class="h5 mb-0">Tu guía para encontrar el programa académico perfecto</span>
                    </div> 
                    
                    <div class="d-flex flex-wrap gap-2">
                        
                        <div class="me-4 d-flex align-items-center">
                            <i class="bi bi-telephone text-primary me-1"></i>
                            <span>+1 (555) 123-4567</span>
                        </div>
                        
                        <div class="me-4 d-flex align-items-center">
                            <i class="bi bi-clock text-primary me-1"></i>
                            <span>Lunes a Viernes: 9am - 6pm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-lg-6">
                <div class="pe-lg-4">
                    <h2 class="fw-bold mb-4 text-gradient-primary">¿Cómo podemos ayudarte?</h2>
                    <p class="lead text-muted mb-5">
                        En Thoth transformamos tu búsqueda académica. Descubre entre miles de maestrías, doctorados y certificaciones internacionales el programa que impulse tu carrera profesional.
                    </p>
                    
                    <!-- Preguntas Frecuentes Mejoradas -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                <i class="bi bi-patch-question-fill text-primary fs-4"></i>
                            </div>
                            <h4 class="fw-bold mb-0">Preguntas frecuentes</h4>
                        </div>
                        
                        <!-- Pregunta 1 - Mejorada -->
                        <div class="card card-hover mb-3 border-0 shadow-sm rounded-lg">
                            <div class="card-header bg-white border-0 p-0">
                                <button class="btn btn-link text-decoration-none w-100 text-start px-4 py-3 d-flex justify-content-between align-items-center" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq1">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-bar-chart-line text-primary me-3"></i>
                                        <span class="fw-semibold">¿Cómo funciona el comparador inteligente de Thoth?</span>
                                    </span>
                                    <i class="bi bi-chevron-down text-muted transition-icon"></i>
                                </button>
                            </div>
                            <div id="faq1" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="card-body px-4 pb-4 pt-0">
                                    <div class="ps-4 ms-2 border-start border-2 border-primary">
                                        <p class="text-muted mb-0">
                                            Nuestra plataforma utiliza algoritmos avanzados para comparar programas académicos en 12 dimensiones clave, incluyendo:
                                        </p>
                                        <ul class="text-muted mt-2 mb-0">
                                            <li>Inversión y opciones de financiamiento</li>
                                            <li>Duración y flexibilidad de horarios</li>
                                            <li>Reconocimiento internacional y acreditaciones</li>
                                            <li>Enfoque profesional vs. investigación</li>
                                            <li>Tasa de empleabilidad post-grado</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pregunta 2 - Mejorada -->
                        <div class="card card-hover mb-3 border-0 shadow-sm rounded-lg">
                            <div class="card-header bg-white border-0 p-0">
                                <button class="btn btn-link text-decoration-none w-100 text-start px-4 py-3 d-flex justify-content-between align-items-center" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq2">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-person-badge text-primary me-3"></i>
                                        <span class="fw-semibold">¿Ofrecen asesoría profesional para selección de programas?</span>
                                    </span>
                                    <i class="bi bi-chevron-down text-muted transition-icon"></i>
                                </button>
                            </div>
                            <div id="faq2" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="card-body px-4 pb-4 pt-0">
                                    <div class="ps-4 ms-2 border-start border-2 border-primary">
                                        <p class="text-muted mb-2">
                                            Nuestros consultores académicos (todos con maestría o doctorado) ofrecen:
                                        </p>
                                        <div class="d-flex align-items-start mb-2">
                                            <i class="bi bi-check-circle-fill text-success mt-1 me-2"></i>
                                            <span class="text-muted">Evaluación de perfil con recomendaciones personalizadas</span>
                                        </div>
                                        <div class="d-flex align-items-start mb-2">
                                            <i class="bi bi-check-circle-fill text-success mt-1 me-2"></i>
                                            <span class="text-muted">Estrategia de aplicación para maximizar aceptaciones</span>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-check-circle-fill text-success mt-1 me-2"></i>
                                            <span class="text-muted">Análisis de retorno de inversión por programa</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pregunta 3 - Mejorada -->
                        <div class="card card-hover mb-3 border-0 shadow-sm rounded-lg">
                            <div class="card-header bg-white border-0 p-0">
                                <button class="btn btn-link text-decoration-none w-100 text-start px-4 py-3 d-flex justify-content-between align-items-center" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq3">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-building text-primary me-3"></i>
                                        <span class="fw-semibold">¿Cómo colaboran con las instituciones educativas?</span>
                                    </span>
                                    <i class="bi bi-chevron-down text-muted transition-icon"></i>
                                </button>
                            </div>
                            <div id="faq3" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="card-body px-4 pb-4 pt-0">
                                    <div class="ps-4 ms-2 border-start border-2 border-primary">
                                        <p class="text-muted mb-2">
                                            Mantenemos alianzas estratégicas con más de 350 instituciones premium mundialmente reconocidas:
                                        </p>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex align-items-start mb-2">
                                                    <i class="bi bi-shield-check text-primary mt-1 me-2"></i>
                                                    <span class="text-muted">Verificación directa de datos</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-start mb-2">
                                                    <i class="bi bi-speedometer2 text-primary mt-1 me-2"></i>
                                                    <span class="text-muted">Procesos de admisión ágiles</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-start">
                                                    <i class="bi bi-bell text-primary mt-1 me-2"></i>
                                                    <span class="text-muted">Alertas de nuevos programas</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-start">
                                                    <i class="bi bi-file-earmark-text text-primary mt-1 me-2"></i>
                                                    <span class="text-muted">Documentación actualizada</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pregunta 4 - Mejorada -->
                        <div class="card card-hover border-0 shadow-sm rounded-lg">
                            <div class="card-header bg-white border-0 p-0">
                                <button class="btn btn-link text-decoration-none w-100 text-start px-4 py-3 d-flex justify-content-between align-items-center" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq4">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-arrow-repeat text-primary me-3"></i>
                                        <span class="fw-semibold">¿Cómo garantizan la actualización de la información?</span>
                                    </span>
                                    <i class="bi bi-chevron-down text-muted transition-icon"></i>
                                </button>
                            </div>
                            <div id="faq4" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="card-body px-4 pb-4 pt-0">
                                    <div class="ps-4 ms-2 border-start border-2 border-primary">
                                        <p class="text-muted mb-2">
                                            Implementamos un riguroso proceso de verificación en 3 fases:
                                        </p>
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill me-3">1</div>
                                            <div>
                                                <h6 class="mb-1">Revisión trimestral formal</h6>
                                                <p class="text-muted small mb-0">Contacto directo con las oficinas académicas</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill me-3">2</div>
                                            <div>
                                                <h6 class="mb-1">Monitoreo automatizado</h6>
                                                <p class="text-muted small mb-0">Sistema de alertas para cambios en requisitos</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill me-3">3</div>
                                            <div>
                                                <h6 class="mb-1">Verificación comunitaria</h6>
                                                <p class="text-muted small mb-0">Reportes de usuarios validados por nuestro equipo</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    
                    <a href="nuestros-programas.php" class="btn btn-outline-primary px-4 py-2 rounded-pill d-inline-flex align-items-center">
                        <i class="bi bi- me-2"></i>Explora nuestros programas
                    </a>
                </div>
            </div>
                
            <!-- Columna derecha (Formulario) -->
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="card border-0 shadow-lg rounded-xl overflow-hidden h-100 card-hover">
                    <div class="card-header bg-gradient-primary text-white py-4 px-5">
                        <h4 class="fw-bold mb-1">Contacto Exclusivo</h4>
                        <p class="mb-0 opacity-75">Nuestro equipo especializado responderá en menos de 24h</p>
                    </div>
                    <div class="card-body p-0 position-relative">
                        <!-- Contenedor del formulario responsive -->
                        <div style="min-height: 855px; width: 100%;">
                            <iframe
                                src="https://b24-atnnfq.bitrix24.site/crm_form_iq60u/"
                                style="width: 100%; height: 100%; border: none;"
                                title="Formulario Bitrix24"
                                loading="lazy"
                                class="rounded-bottom">
                            </iframe>
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-white text-primary rounded-pill px-3 py-2 shadow-sm">
                                    <i class="bi bi-shield-lock me-1"></i> Conexión segura
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Tus estilos existentes (los mantuvimos igual) */
            .text-gradient-primary {
                background: linear-gradient(90deg, #1a3a8f 0%, #3a6eff 100%);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            .bg-gradient-primary {
                background: linear-gradient(135deg, #1a3a8f 0%, #3a6eff 100%);
            }
            
            .card-hover:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08) !important;
            }
            
            .transition-icon {
                transition: transform 0.3s ease;
            }
            
            .card-hover .card-header[aria-expanded="true"] .transition-icon {
                transform: rotate(180deg);
            }
            
            .rounded-xl {
                border-radius: 1rem !important;
            }
            
            /* Estilos adicionales específicos para el iframe */
            .card-body iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
            
            /* Mejora de transición para consistencia */
            .card-hover {
                transition: all 0.3s ease;
            }
            
            /* Ajuste para el badge de seguridad */
            .position-absolute .badge {
                z-index: 10;
            }
        </style>

        <!-- Información adicional de contacto 
        <div class="row mt-6">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 hover-effect">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                            <i class="bi bi-geo-alt-fill text-primary fs-3"></i>
                        </div>
                        <h5 class="fw-bold">Oficinas </h5>
                        <p class="text-muted">
                            <small>
                                <strong>México:</strong> Av. Universidad 123, CDMX<br>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 hover-effect">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                            <i class="bi bi-people-fill text-primary fs-3"></i>
                        </div>
                        <h5 class="fw-bold">Asesoría Académica</h5>
                        <p class="text-muted">
                            <small>
                                <strong>WhatsApp:</strong> +52 55 1234 5678<br>
                                <strong>Zoom:</strong> agenda una cita<br>
                                <strong>Email:</strong> asesoria@thoth.com
                            </small>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 hover-effect">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                            <i class="bi bi-lightbulb-fill text-primary fs-3"></i>
                        </div>
                        <h5 class="fw-bold">Para Instituciones</h5>
                        <p class="text-muted">
                            <small>
                                ¿Eres una universidad y quieres listar tus programas?<br>
                                <strong>Email:</strong> instituciones@thoth.com<br>
                                <strong>Tel:</strong> +1 (555) 987-6543
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>

<style>
    .bg-primary2 {
        background-color: #1a3a8f;
    }
    
    .hover-effect {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: rgba(26, 58, 143, 0.05);
        color: #1a3a8f;
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,0.1);
    }
</style>

<?php
include 'includes/footer.php';
?>