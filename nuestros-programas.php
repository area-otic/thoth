<?php
$pageTitle = "Programas Académicos - Thoth Education";
include 'includes/header.php';
include 'includes/db.php'; // Adjust according to your structure

// Obtener parámetros de búsqueda
$searchTerm = $_GET['search'] ?? '';
$tipo = $_GET['tipo'] ?? '';
$categoria = $_GET['categoria'] ?? '';
$pais = $_GET['pais'] ?? '';
$modalidad = $_GET['modalidad'] ?? '';
$universidad = $_GET['universidad'] ?? '';
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
    

    .filter-chip .close-btn:hover {
        color: #dc3545;
    }
    /* Agregar esto a tu sección de estilos */
    #compareCounter {
        background-color: #7367f0;
        transition: all 0.3s ease;
    }

    #compareCounter.pulse {
        animation: pulse 0.5s ease-in-out;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    /* Estilos para las tarjetas mejoradas */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .card-img-top {
        transition: transform 0.5s ease;
    }

    /* Estilos para los badges */
    .position-absolute.badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Botones mejorados */
    .btn-label-primary {
        transition: all 0.3s ease;
    }

    .compare-btn {
        transition: all 0.3s ease;
    }

    /* Estilos para los filtros superiores */
    .filter-options {
        padding-right: 8px;
    }
    
    .filter-options::-webkit-scrollbar {
        width: 6px;
    }
    
    .filter-options::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .filter-options::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
    
    
    /* Chips de filtros activos */
    .filter-chip {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        background-color: #f8f9fa;
        border-radius: 50rem;
        font-size: 0.875rem;
        border: 1px solid #dee2e6;
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

<!-- Program Content -->
<div class=" min-vh-100 bg-light">
    <!-- Header -->
    <div class="bg-primary2 text-white pt-13 py-12">
        <div class="container px-4">
            <div class="row align-items-center">
                <!-- Breadcrumb y Título -->
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-2 text-info">
                        <a href="inicio.php" class="text-decoration-none text-white">
                            <i class="bi bi-house-door me-1"></i>Inicio
                        </a>
                        <span class="mx-2 text-white">›</span>
                        <a href="universidades.php" class="text-decoration-none text-white">
                            <i class="bi bi-search"></i> Buscar Programa
                        </a>
                    </div>

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
                            <i class="bi bi-globe-americas text-primary me-2 fs-5"></i>
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

    <!-- Content -->
<!-- Content -->
<div class="container mx-auto px-lg-12 px-6 py-8">
    <!-- Filtros en la parte superior -->
    <div class="row mb-4">
        <div class="col-12">
            <!-- Contenedor principal de filtros -->
            <div class="bg-white p-4 rounded shadow">
                <!-- Encabezado y botones de acción -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <h2 class="h5 fw-bold mb-0 font-serif text-primary">
                        <i class="bi bi-funnel me-2"></i>Filtrar Programas
                    </h2>
                    
                    <div class="d-flex gap-2">
                        <button id="applyFilters" class="btn btn-sm btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Aplicar
                        </button>
                        <button id="resetFilters" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Limpiar
                        </button>
                    </div>
                </div>
                
                <!-- Barra de búsqueda principal -->
                

                <div class="mb-3">
                    <label for="search-filter" class="form-label small text-muted">Buscar</label>
                    <div class="input-group">
                        <input type="text" id="search-filter" class="form-control form-control-sm" placeholder="Escribe para buscar...">
                        <button class="btn btn-sm btn-outline-secondary" type="button" id="btn-search">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Filtros desplegables en fila -->
                <div class="d-flex flex-wrap gap-2 mb-2">
                    <!-- Filtro Tipo -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownTipo" data-bs-toggle="dropdown">
                            <i class="bi bi-bookmark me-1"></i> Tipo
                        </button>
                        <div class="dropdown-menu p-3" style="width: 280px;">
                            <div class="filter-options" style="max-height: 250px; overflow-y: auto;">
                                <?php
                                $tipos = $conn->query("SELECT DISTINCT tipo FROM data_programas WHERE tipo IS NOT NULL ORDER BY tipo");
                                while($tipo = $tipos->fetch(PDO::FETCH_ASSOC)) {
                                    echo '
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="'.htmlspecialchars($tipo['tipo']).'" id="tipo-'.htmlspecialchars(str_replace(' ', '-', $tipo['tipo'])).'" data-filter="tipo">
                                        <label class="form-check-label small" for="tipo-'.htmlspecialchars(str_replace(' ', '-', $tipo['tipo'])).'">
                                            '.htmlspecialchars($tipo['tipo']).'
                                        </label>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filtro Categoría -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownCategoria" data-bs-toggle="dropdown">
                            <i class="bi bi-tags me-1"></i> Área
                        </button>
                        <div class="dropdown-menu p-3" style="width: 280px;">
                            <div class="filter-options" style="max-height: 250px; overflow-y: auto;">
                                <?php
                                $categorias = $conn->query("SELECT DISTINCT categoria FROM data_programas WHERE categoria IS NOT NULL ORDER BY categoria");
                                while($categoria = $categorias->fetch(PDO::FETCH_ASSOC)) {
                                    echo '
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="'.htmlspecialchars($categoria['categoria']).'" id="categoria-'.htmlspecialchars(str_replace(' ', '-', $categoria['categoria'])).'" data-filter="categoria">
                                        <label class="form-check-label small" for="categoria-'.htmlspecialchars(str_replace(' ', '-', $categoria['categoria'])).'">
                                            '.htmlspecialchars($categoria['categoria']).'
                                        </label>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filtro Universidad -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownUniversidad" data-bs-toggle="dropdown">
                            <i class="bi bi-building me-1"></i> Universidad
                        </button>
                        <div class="dropdown-menu p-3" style="width: 280px;">
                            <div class="filter-options" style="max-height: 250px; overflow-y: auto;">
                                <?php
                                $universidades = $conn->query("SELECT DISTINCT universidad FROM data_programas WHERE universidad IS NOT NULL ORDER BY universidad");
                                while($universidad = $universidades->fetch(PDO::FETCH_ASSOC)) {
                                    echo '
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="'.htmlspecialchars($universidad['universidad']).'" id="universidad-'.htmlspecialchars(str_replace(' ', '-', $universidad['universidad'])).'" data-filter="universidad">
                                        <label class="form-check-label small" for="universidad-'.htmlspecialchars(str_replace(' ', '-', $universidad['universidad'])).'">
                                            '.htmlspecialchars($universidad['universidad']).'
                                        </label>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filtro País -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownPais" data-bs-toggle="dropdown">
                            <i class="bi bi-globe me-1"></i> País
                        </button>
                        <div class="dropdown-menu p-3" style="width: 220px;">
                            <div class="filter-options" style="max-height: 250px; overflow-y: auto;">
                                <?php
                                $paises = $conn->query("SELECT DISTINCT pais FROM data_programas WHERE pais IS NOT NULL ORDER BY pais");
                                while($pais = $paises->fetch(PDO::FETCH_ASSOC)) {
                                    echo '
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="'.htmlspecialchars($pais['pais']).'" id="pais-'.htmlspecialchars(str_replace(' ', '-', $pais['pais'])).'" data-filter="pais">
                                        <label class="form-check-label small" for="pais-'.htmlspecialchars(str_replace(' ', '-', $pais['pais'])).'">
                                            '.htmlspecialchars($pais['pais']).'
                                        </label>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filtro Modalidad -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownModalidad" data-bs-toggle="dropdown">
                            <i class="bi bi-laptop me-1"></i> Modalidad
                        </button>
                        <div class="dropdown-menu p-3" style="width: 200px;">
                            <?php
                            $modalidades = $conn->query("SELECT DISTINCT modalidad FROM data_programas WHERE modalidad IS NOT NULL ORDER BY modalidad");
                            while($modalidad = $modalidades->fetch(PDO::FETCH_ASSOC)) {
                                echo '
                                <div class="form-check mb-2">
                                    <input class="form-check-input filter-checkbox" type="checkbox" value="'.htmlspecialchars($modalidad['modalidad']).'" id="modalidad-'.htmlspecialchars(str_replace(' ', '-', $modalidad['modalidad'])).'" data-filter="modalidad">
                                    <label class="form-check-label small" for="modalidad-'.htmlspecialchars(str_replace(' ', '-', $modalidad['modalidad'])).'">
                                        '.htmlspecialchars($modalidad['modalidad']).'
                                    </label>
                                </div>';
                            }
                            ?>
                        </div>
                    </div>
                    
                    <!-- Filtro Duración -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownDuracion" data-bs-toggle="dropdown">
                            <i class="bi bi-clock me-1"></i> Duración
                        </button>
                        <div class="dropdown-menu p-3" style="width: 220px;">
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="Corto" id="duracion-corta" data-filter="duracion">
                                <label class="form-check-label small" for="duracion-corta">
                                    Cortos (hasta 6 meses)
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="Medio" id="duracion-media" data-filter="duracion">
                                <label class="form-check-label small" for="duracion-media">
                                    Medios (6-12 meses)
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="Largo" id="duracion-larga" data-filter="duracion">
                                <label class="form-check-label small" for="duracion-larga">
                                    Largos (1-2 años)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="Extenso" id="duracion-extendida" data-filter="duracion">
                                <label class="form-check-label small" for="duracion-extendida">
                                    Extendidos (+2 años)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Chips de filtros activos -->
                <div id="activeFiltersChips" class="d-flex flex-wrap gap-2 pt-2 border-top"></div>
            </div>
        </div>
    </div>
       
    <!-- Programas debajo de los filtros -->
    <div class="row">
        <div class="col-12">
            <!-- Programs Section -->
                <section class="section-py2 bg-white rounded landing-features" style="padding-block:1.25rem" id="landingFeatures">
                    <div class="container">
                                                
                        <div id="programsGrid3" class="row g-6">
                        <?php
                            // Obtener programas de la base de datos
                            $stmt = $conn->query("SELECT * FROM data_programas WHERE estado_programa = 'Publicado' LIMIT 8");
                            while ($programa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="card h-100 shadow-sm border-0 hover-shadow transition d-flex flex-column">
                                        <div class="card-img-top overflow-hidden" style="height: 200px;">
                                        <img src="'.htmlspecialchars($programa['imagen_url'] ?? 'https://via.placeholder.com/400x250').'" 
                                            alt="'.htmlspecialchars($programa['titulo']).'" class="img-fluid w-100 h-100 object-fit-cover">                          
                                        </div>
                                        
                                        <div class="card-body d-flex flex-column">
                                            <div class="flex-grow-1"> <!-- Contenido que puede crecer -->
                                                <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-label-info rounded-pill text-primary">'.htmlspecialchars($programa['tipo'] ?? 'Maestría').'</span>
                                                <span class="badge bg-label-warning rounded-pill text-warning ms-2 d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <circle cx="12" cy="8" r="6"></circle>
                                                    <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                                                    </svg>
                                                    Rank #1
                                                </span>
                                                </div>

                                                <h3 class="h5 card-title fw-bold mb-2">'.htmlspecialchars($programa['titulo']).'</h3>
                                                <p class="text-muted mb-3">'.htmlspecialchars(substr($programa['descripcion'] ?? 'Programa académico de excelencia', 0, 100)).'...</p>
                                            </div>
                                            
                                            <!-- Información fija encima de los botones -->
                                            <div class="mt-auto mb-3">
                                                <div class="d-flex align-items-center text-muted mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                                '.htmlspecialchars($programa['pais'] ?? 'Online').'
                                                </div>

                                                <div class="d-flex align-items-center text-muted mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                                '.htmlspecialchars($programa['duracion']).'
                                                </div>
                                                <div class="d-flex align-items-center text-muted mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                                                    <path d="M3 21h18M6 18V9m4 9V9m4 9V9m4 9V9M3 9l9-6 9 6" />
                                                </svg>
                                                '.htmlspecialchars($programa['universidad'] ?? 'Universidad').'
                                                </div>

                                            </div>
                                            
                                            <!-- Botones pegados al fondo -->
                                            <div class="d-flex justify-content-between mt-auto">
                                                <a href="programa.php?id='.$programa['id'].'" class="btn btn-label-primary d-flex align-items-center">
                                                <span class="me-2">Ver detalles</span>
                                                <i class="bx bx-chevron-right"></i>
                                                </a>
                                                <a href="comparacion.php?add='.$programa['id'].'" class="btn btn-outline-primary d-flex align-items-center">
                                                <i class="bx bx-book me-1"></i>
                                                Comparar2
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        ?>              
                        </div>
                        <br><br>
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
        <div class="container position-relative">
            <!-- Imagen del profesional (sobrepasando el borde) -->
            <div class="d-none d-lg-block position-absolute" style="bottom: 0; left: -50px; width: 300px; z-index: 1;">
            <img src="assets/img/profesional-1.png" 
                class="img-fluid" 
                alt="Profesional académico"
                style="max-height: 350px;">
            </div>
            
            <div class="card bg-gradient-primary-dark text-white shadow-lg border-0 overflow-hidden">
                <div class="card-body p-6 py-md-10 px-md-8 ps-lg-15">
                    <div class="row align-items-center">
                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <h2 class="text-white mb-3">Transforma tu futuro académico hoy</h2>
                        <p class="lead mb-4 opacity-75">
                        Conectamos aspirantes con <strong>las mejores universidades</strong> del mundo.<br>
                        Accede a programas exclusivos de maestrías, doctorados y especializaciones.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                        <a href="inicio.php" class="btn btn-light btn-lg px-5 flex-grow-1 flex-lg-grow-0">
                            <i class="bx bx-search-alt me-2"></i> Buscar Programas
                        </a>
                        <a href="contacto.php" class="btn btn-outline-light btn-lg px-5 flex-grow-1 flex-lg-grow-0">
                            <i class="bx bx-chat me-2"></i> Asesoría Gratis
                        </a>
                        </div>
                    </div>
                    <div class="col-lg-4 call-academico">
                        <div class="row text-center">
                        <div class="col-6 mb-4">
                            <div class="h1 fw-bolder">200+</div>
                            <div class="opacity-75">Instituciones</div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="h1 fw-bolder">2.5K+</div>
                            <div class="opacity-75">Programas</div>
                        </div>
                        <div class="col-6">
                            <div class="h1 fw-bolder">100%</div>
                            <div class="opacity-75">Orientación</div>
                        </div>
                        <div class="col-6">
                            <div class="h1 fw-bolder">30+</div>
                            <div class="opacity-75">Países</div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {

    // Variables globales
    let currentPage = 1;
    const itemsPerPage = 9;
    let activeFilters = {
        tipo: [],
        categoria: [],
        pais: [],
        modalidad: [],
        universidad: [],
        duracion: []
    };
    
    // Elementos del DOM
    const programsContainer = document.getElementById('programsGrid3');
    const loadMoreBtn = document.getElementById('loadMoreBtn3');
    const applyFiltersBtn = document.getElementById('applyFilters');
    const resetFiltersBtn = document.getElementById('resetFilters');
    const searchFilter = document.getElementById('search-filter');
    const btnSearch = document.getElementById('btn-search');
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    
    
    // Crear elemento para mostrar el contador de resultados
    const resultsCounter = document.createElement('div');
    resultsCounter.className = 'text-muted mb-4 text-center';
    programsContainer.parentNode.insertBefore(resultsCounter, programsContainer.nextSibling);
    
    // Ocultar el botón "Ver más" ya que manejaremos paginación
    if (loadMoreBtn) loadMoreBtn.style.display = 'none';
    
    // Crear contenedor de paginación
    const paginationContainer = document.createElement('div');
    paginationContainer.className = 'd-flex justify-content-center mt-4 gap-2';
    resultsCounter.parentNode.insertBefore(paginationContainer, resultsCounter.nextSibling);
    
    /*-----------------------*/
    // Obtener parámetros GET
    const urlParams = new URLSearchParams(window.location.search);
    const searchTerm = urlParams.get('search') || '';
    if (searchTerm) {
        document.getElementById('search-filter').value = searchTerm;
    }
    
    // Marcar checkboxes según los parámetros GET
    <?php 
    $filters = [
        'tipo' => $_GET['tipo'] ?? '',
        'categoria' => $_GET['categoria'] ?? '',
        'pais' => $_GET['pais'] ?? '',
        'modalidad' => $_GET['modalidad'] ?? '',
        'universidad' => $_GET['universidad'] ?? ''
    ];
    
    foreach ($filters as $filter => $value) {
        if (!empty($value)) {
            echo "document.querySelectorAll(`.filter-checkbox[data-filter='{$filter}'][value='".addslashes(htmlspecialchars($value))."']`).forEach(checkbox => { checkbox.checked = true; });";
        }
    }
    ?>
    
    // Inicializar filtros activos con los parámetros GET
    activeFilters = collectActiveFilters();
    loadPrograms(1, activeFilters, searchTerm);
    
    // Función para actualizar los chips de filtros activos
    function updateActiveFiltersChips(filters, searchTerm = '') {
        const chipsContainer = document.getElementById('activeFiltersChips');
        chipsContainer.innerHTML = '';
        
        // Mostrar término de búsqueda si existe
        if (searchTerm) {
            const searchChip = document.createElement('div');
            searchChip.className = 'filter-chip';
            searchChip.innerHTML = `
                Búsqueda: "${searchTerm}"
                <span class="close-btn" data-filter-type="search">&times;</span>
            `;
            chipsContainer.appendChild(searchChip);
        }
        
        // Mostrar filtros por categoría
        for (const [filterType, values] of Object.entries(filters)) {
            if (values.length > 0) {
                values.forEach(value => {
                    const chip = document.createElement('div');
                    chip.className = 'filter-chip';
                    chip.innerHTML = `
                        ${getFilterLabel(filterType)}: ${value}
                        <span class="close-btn" data-filter-type="${filterType}" data-filter-value="${value}">&times;</span>
                    `;
                    chipsContainer.appendChild(chip);
                });
            }
        }
        
        // Agregar event listeners a los botones de cerrar
        document.querySelectorAll('.filter-chip .close-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const filterType = this.getAttribute('data-filter-type');
                const filterValue = this.getAttribute('data-filter-value');
                
                if (filterType === 'search') {
                    // Limpiar búsqueda
                    searchFilter.value = '';
                } else {
                    // Desmarcar el checkbox correspondiente
                    document.querySelectorAll(`.filter-checkbox[data-filter="${filterType}"]`).forEach(checkbox => {
                        if (checkbox.value === filterValue) {
                            checkbox.checked = false;
                        }
                    });
                }
                
                // Recolectar filtros activos actualizados
                activeFilters = collectActiveFilters();
                
                // Actualizar URL y recargar resultados
                updateUrl(activeFilters, searchFilter.value.trim());
                loadPrograms(1, activeFilters, searchFilter.value.trim());
            });
        });
    }

    // Función para obtener etiquetas amigables para los tipos de filtro
    function getFilterLabel(filterType) {
        const labels = {
            'tipo': 'Tipo',
            'categoria': 'Categoría',
            'pais': 'País',
            'modalidad': 'Modalidad',
            'universidad': 'Universidad',
            'duracion': 'Duración'
        };
        return labels[filterType] || filterType;
    }

    // Función para cargar programas con filtros
    async function loadPrograms(page = 1, filters = {}, searchTerm = '') {
        currentPage = page;
        
        try {
            // Construir parámetros de filtro
            const params = new URLSearchParams();
            params.append('pagina', page);
            
            // Agregar término de búsqueda si existe
            if (searchTerm) {
                params.append('search', searchTerm);
            }
            
            // Agregar filtros seleccionados
            for (const [filterType, values] of Object.entries(filters)) {
                if (values.length > 0) {
                    values.forEach(value => {
                        params.append(`${filterType}[]`, value);
                    });
                }
            }
            
            // Mostrar loading
            programsContainer.innerHTML = 
            '<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></div>';
            
            // Realizar la petición
            const response = await fetch(`control/filtro_programas.php?${params.toString()}`);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (!data || !data.programas) {
                throw new Error('Respuesta inválida del servidor');
            }
            
            // Actualizar chips de filtros activos
            updateActiveFiltersChips(filters, searchTerm);

            // Renderizar programas
            renderPrograms(data.programas, filters, searchTerm);
            
            // Actualizar contador de resultados
            updateResultsCounter(data.total, page);
            
            // Actualizar controles de paginación
            updatePaginationControls(data.total, page);
            
        } catch (error) {
            console.error('Error:', error);
            programsContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <div class="alert alert-danger">
                        Ocurrió un error al cargar los programas. Por favor, inténtalo de nuevo.<br>
                        <small>${error.message}</small>
                    </div>
                </div>
            `;
        }
    }

    // Función para recolectar filtros activos
    function collectActiveFilters() {
        const newFilters = {
            tipo: [],
            categoria: [],
            pais: [],
            modalidad: [],
            universidad: [],
            duracion: []
        };
        
        // Solo agregar checkboxes marcados (no duplicar con parámetros GET)
        document.querySelectorAll('.filter-checkbox:checked').forEach(checkbox => {
            const filterType = checkbox.dataset.filter;
            const value = checkbox.value;
            if (filterType in newFilters && !newFilters[filterType].includes(value)) {
                newFilters[filterType].push(value);
            }
        });
        
        return newFilters;
    }

    // Función para actualizar la URL
    function updateUrl(filters, searchTerm = '') {
        const params = new URLSearchParams();
        
        // Limpiar parámetros existentes
        params.delete('search');
        Object.keys(filters).forEach(key => params.delete(key));
        
        // Agregar término de búsqueda si existe
        if (searchTerm) {
            params.set('search', searchTerm);
        }
        
        // Agregar filtros seleccionados
        for (const [filterType, values] of Object.entries(filters)) {
            if (values.length > 0) {
                values.forEach(value => {
                    params.append(filterType, value);
                });
            }
        }
        
        // Actualizar la URL sin recargar la página
        const newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
        window.history.replaceState({}, '', newUrl);
    }
    
    // Función para renderizar los programas
    function renderPrograms(programs, filters = {}, searchTerm = '') {
        programsContainer.innerHTML = '';
        
        if (programs.length === 0) {
            let message = 'No se encontraron programas con los filtros seleccionados.';
            
            // Mensaje más específico si hay búsqueda
            if (searchTerm) {
                message = `No se encontraron programas que coincidan con "${searchTerm}"`;
                
                // Si además hay otros filtros
                const hasOtherFilters = Object.values(filters).some(arr => arr.length > 0);
                if (hasOtherFilters) {
                    message += ' y los filtros aplicados.';
                }
            } 
            // Mensaje si solo hay filtros pero no búsqueda
            else if (Object.values(filters).some(arr => arr.length > 0)) {
                message = 'No se encontraron programas con los filtros aplicados.';
            }
            
            programsContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        ${message}
                        <div class="mt-3">
                            <button id="resetFiltersBtn" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Limpiar todos los filtros
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // Agregar evento al botón de reset
            document.getElementById('resetFiltersBtn')?.addEventListener('click', () => {
                // Desmarcar todos los checkboxes
                document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });
                
                // Limpiar campo de búsqueda
                searchFilter.value = '';
                
                // Resetear filtros
                activeFilters = {
                    tipo: [],
                    categoria: [],
                    pais: [],
                    modalidad: [],
                    universidad: [],
                    duracion: []
                };
                
                // Cargar primera página sin filtros
                loadPrograms(1, activeFilters, '');
            });
            
            return;
        }
        
        programs.forEach(programa => {
            const programCard = document.createElement('div');
            programCard.className = 'col-xl-4 col-lg-6 mb-3';
            programCard.innerHTML = `
                <div class="card h-100 shadow-sm border-0 hover-shadow transition d-flex flex-column">
                    <div class="card-img-top overflow-hidden position-relative" style="height: 200px;">
                        <img src="${programa.imagen_url || 'https://via.placeholder.com/400x250'}" 
                            alt="${programa.titulo}" class="img-fluid w-100 h-100 object-fit-cover">
                            <!-- Overlay degradado -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" 
                            style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0) 100%);">
                        </div>
                        <!-- Badge de tipo en esquina superior derecha -->
                        <span class="position-absolute top-0 end-0 m-2 badge bg-primary rounded-pill">
                            ${programa.tipo || 'Programa'}
                        </span>                      
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-label-info rounded-pill text-primary">${programa.categoria || 'General'}</span>
                            </div>

                            <h3 class="h5 card-title fw-bold mb-2">${programa.titulo}</h3>
                            <small class="text-muted mb-3">${(programa.descripcion || 'Programa académico de excelencia').substring(0, 100)}...</small>
                        </div>
                        
                        <div class="mt-auto mb-3">
                            <div class="d-flex align-items-center text-muted mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                ${programa.pais || 'Online'}
                            </div>

                            <div class="d-flex align-items-center text-muted mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                ${programa.duracion}
                            </div>
                            <div class="d-flex align-items-center text-muted mb-2">
                                ${programa.modalidad.toLowerCase() === 'presencial' ? 
                                    '<i class="bx bx-building me-2 text-muted"></i>' :
                                programa.modalidad.toLowerCase() === 'online' ? 
                                    '<i class="bi bi-laptop me-2 text-muted"></i>' :
                                    '<i class="bi bi-collection me-2 text-muted"></i>'}
                                ${programa.modalidad}
                            </div>
                            <div class="d-flex align-items-center text-muted mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                                    <path d="M3 21h18M6 18V9m4 9V9m4 9V9m4 9V9M3 9l9-6 9 6" />
                                </svg>
                                ${programa.universidad || 'Universidad'}
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-auto">
                            <a href="programa.php?id=${programa.id}" class="btn btn-label-primary d-flex align-items-center">
                                <span class="me-2">Ver detalles</span>
                                <i class="bx bx-chevron-right"></i>
                            </a>
                            <a href="comparacion.php?add=${programa.id}" class="btn btn-outline-primary d-flex align-items-center compare-btn">
                                <i class="bx bx-book me-1"></i>
                                Comparar
                            </a>
                        </div>
                    </div>
                </div>
            `;
            programsContainer.appendChild(programCard);
        });
    }
    
    // Función para actualizar el contador de resultados
    function updateResultsCounter(total, currentPage) {
        const start = ((currentPage - 1) * itemsPerPage) + 1;
        const end = Math.min(currentPage * itemsPerPage, total);
        
        resultsCounter.textContent = `Mostrando ${start}-${end} de ${total} resultados`;
    }
    
    // Función para actualizar los controles de paginación
    function updatePaginationControls(total, currentPage) {
        paginationContainer.innerHTML = '';
        
        const totalPages = Math.ceil(total / itemsPerPage);
        
        if (totalPages <= 1) return;
        // Botón Anterior
        const prevBtn = document.createElement('button');
        prevBtn.className = `btn btn-outline-primary ${currentPage === 1 ? 'disabled' : ''}`;
        prevBtn.innerHTML = '<i class="bi bi-chevron-left"></i> Anterior';
        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                loadPrograms(currentPage - 1, activeFilters, searchFilter.value.trim());
            }
        });
        paginationContainer.appendChild(prevBtn);
        
        // Botones de páginas (mostramos máximo 5)
        const startPage = Math.max(1, currentPage - 2);
        const endPage = Math.min(totalPages, currentPage + 2);
        
        for (let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement('button');
            pageBtn.className = `btn ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'}`;
            pageBtn.textContent = i;
            pageBtn.addEventListener('click', () => {
                loadPrograms(i, activeFilters, searchFilter.value.trim());
            });
            paginationContainer.appendChild(pageBtn);
        }
        
        // Botón Siguiente
        const nextBtn = document.createElement('button');
        nextBtn.className = `btn btn-outline-primary ${currentPage === totalPages ? 'disabled' : ''}`;
        nextBtn.innerHTML = 'Siguiente <i class="bi bi-chevron-right"></i>';
        nextBtn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                loadPrograms(currentPage + 1, activeFilters, searchFilter.value.trim());
            }
        });
        paginationContainer.appendChild(nextBtn);
    }
    
    // Event Listeners
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            activeFilters = collectActiveFilters();
            updateUrl(activeFilters, searchFilter.value.trim());
            loadPrograms(1, activeFilters, searchFilter.value.trim());
        });
    });

    applyFiltersBtn.addEventListener('click', () => {
        activeFilters = collectActiveFilters();
        updateUrl(activeFilters, searchFilter.value.trim());
        loadPrograms(1, activeFilters, searchFilter.value.trim());
    });

    resetFiltersBtn.addEventListener('click', () => {
        // Desmarcar todos los checkboxes
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Limpiar campo de búsqueda
        searchFilter.value = '';
        
        // Resetear filtros
        activeFilters = {
            tipo: [],
            categoria: [],
            pais: [],
            modalidad: [],
            universidad: [],
            duracion: []
        };
        
        // Actualizar URL
        updateUrl(activeFilters, '');
        
        // Cargar primera página sin filtros
        loadPrograms(1, activeFilters, '');
    });

    btnSearch.addEventListener('click', () => {
        const searchTerm = searchFilter.value.trim();
        activeFilters = collectActiveFilters();
        updateUrl(activeFilters, searchTerm);
        loadPrograms(1, activeFilters, searchTerm);
    });

    searchFilter.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            const searchTerm = searchFilter.value.trim();
            activeFilters = collectActiveFilters();
            updateUrl(activeFilters, searchTerm);
            loadPrograms(1, activeFilters, searchTerm);
        }
    });
    
    // Cargar programas iniciales
   // loadPrograms(1);
});
</script>