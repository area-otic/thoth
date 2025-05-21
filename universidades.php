<?php
include 'includes/header.php';
include 'includes/db.php'; // Adjust according to your structure
?>

 <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    .hero-section {
        background: linear-gradient(135deg, #001f3f 0%, #003366 50%, #00509e 100%);
    }
    .program-image {
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
</style>

<!-- Program Content -->
<div class=" min-vh-100 bg-light">
    <!-- Header -->
    <div class="bg-primary2 text-white pt-13 py-12">
        <div class="container-fluid px-12">
            <div class="row align-items-center">
                <!-- Breadcrumb y Título -->
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item">
                                <a href="inicio.php" class="text-decoration-none text-light-emphasis">
                                    <i class="bi bi-house-door"></i> Inicio
                                </a>
                            </li>
                            <li class="breadcrumb-item text-light-emphasis active" aria-current="page">
                                <i class="bi bi-search"></i> Buscar Programa
                            </li>
                        </ol>
                    </nav>
                    
                    <h1 class="display-4 font-serif fw-extrabold mb-3">
                        Encuentra tu <span class="text-primary">Programa Académico Ideal</span>
                    </h1>
                    
                    <p class="lead mb-4 opacity-75">
                        Explora entre miles de programas de posgrado en las mejores universidades del mundo
                    </p>
                    
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center me-4">
                            <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i>
                            <span>+2,000 Programas</span>
                        </div>
                        <div class="d-flex align-items-center me-4">
                            <i class="bi bi-globe-americas text-info me-2 fs-5"></i>
                            <span>30+ Países</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-award text-warning me-2 fs-5"></i>
                            <span>Instituciones Certificadas</span>
                        </div>
                    </div>
                </div>
                
                <!-- Imagen decorativa (visible solo en desktop) 
                <div class="col-lg-4 d-none d-lg-block text-center">
                    <img src="assets/img/graduation-cap.png" alt="Estudiantes de posgrado" class="img-fluid" style="max-height: 200px;">
                </div>-->
            </div>
        </div>

    </div>

<style>
    
    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }
    
    .breadcrumb-item a:hover {
        color: white !important;
    }

    .pagination-container {
        margin: 20px 0;
    }
    .pagination-container button {
        min-width: 40px;
        text-align: center;
    }
    .filter-chip {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        background-color: #e9ecef;
        border-radius: 50rem;
        font-size: 0.875rem;
        color: #495057;
    }

    .filter-chip .close-btn {
        margin-left: 0.5rem;
        cursor: pointer;
        color: #6c757d;
        font-size: 1rem;
        line-height: 1;
    }

    .filter-chip .close-btn:hover {
        color: #dc3545;
    }
</style>

    <!-- Content -->
    <div class="container-fluid mx-auto px-lg-12 px-6 py-8">
        <div class="row g-4">
            <!-- Sidebar - 1/3 -->
            <div class="col-lg-2">
                
                
            </div>
            <!-- Main Content - 2/3 -->
            <div class="col-lg-10">         
                <!-- Chips de filtros activos -->
                <div id="activeFiltersChips" class="mb-4 d-flex flex-wrap gap-2"></div>                   
                
                <!-- Programs Section -->
                <section class="section-py2 bg-white rounded landing-features" id="landingFeatures">
                    <div class="container">
                                                
                                
                        <div class="load-more-container text-center mt-4">
                            <button id="loadMoreBtn3" class="btn btn-primary" onclick="cargarMasProgramas3()">
                                <span>Ver más programas</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>  
                    </div>
                </section>
            </div>
        </div>
    </div>

    <section class="section-py position-relative ">
        
    </section>
</div>
<?php include 'includes/footer.php'; ?>