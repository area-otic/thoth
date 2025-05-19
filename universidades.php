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
                <!-- Filtros Section -->
                <section class="bg-white p-4 rounded shadow mb-4">
                    <h2 class="h5 fw-bold mb-3 font-serif text-primary">Filtrar Programas</h2>
                    
                    <!-- Filtro de Búsqueda -->
                    <div class="mb-4">
                        <label for="search-filter" class="form-label small text-muted">Buscar</label>
                        <div class="input-group">
                            <input type="text" id="search-filter" class="form-control form-control-sm" placeholder="Escribe para buscar...">
                            <button class="btn btn-sm btn-outline-secondary" type="button" id="btn-search">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Filtro Tipo de Programa -->
                    <div class="accordion mb-3" id="filterAccordion">
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterTipo" aria-expanded="false">
                                    <span class="fw-semibold">Tipo de Programa</span>
                                </button>
                            </h3>
                            <div id="filterTipo" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body pt-0 pb-2 px-3">
                                    <?php
                                    $tipos = $conn->query("SELECT DISTINCT tipo FROM data_maestrias WHERE tipo IS NOT NULL ORDER BY tipo");
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
                        
                        <!-- Filtro Categorías -->
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterCategoria" aria-expanded="false">
                                    <span class="fw-semibold">Categorías</span>
                                </button>
                            </h3>
                            <div id="filterCategoria" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body pt-0 pb-2 px-3" style="max-height: 300px; overflow-y: auto;">
                                    <?php
                                    $categorias = $conn->query("SELECT DISTINCT categoria FROM data_maestrias WHERE categoria IS NOT NULL ORDER BY categoria");
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

                        <!-- Filtro Universidades -->
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterUniversidad" aria-expanded="false">
                                    <span class="fw-semibold">Universidades</span>
                                </button>
                            </h3>
                            <div id="filterUniversidad" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body pt-0 pb-2 px-3" style="max-height: 300px; overflow-y: auto;">
                                    <?php
                                    $universidades = $conn->query("SELECT DISTINCT universidad FROM data_maestrias WHERE universidad IS NOT NULL ORDER BY universidad");
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
                        
                        <!-- Filtro Países -->
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterPais" aria-expanded="false">
                                    <span class="fw-semibold">Países</span>
                                </button>
                            </h3>
                            <div id="filterPais" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body pt-0 pb-2 px-3">
                                    <?php
                                    $paises = $conn->query("SELECT DISTINCT pais FROM data_maestrias WHERE pais IS NOT NULL ORDER BY pais");
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
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterModalidad" aria-expanded="false">
                                    <span class="fw-semibold">Modalidad</span>
                                </button>
                            </h3>
                            <div id="filterModalidad" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body pt-0 pb-2 px-3">
                                    <?php
                                    $modalidades = $conn->query("SELECT DISTINCT modalidad FROM data_maestrias WHERE modalidad IS NOT NULL ORDER BY modalidad");
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
                        </div>                    
                        <!-- Filtro Duración -->
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterDuracion" aria-expanded="false">
                                    <span class="fw-semibold">Duración</span>
                                </button>
                            </h3>
                            <div id="filterDuracion" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body pt-0 pb-2 px-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="Corto" id="duracion-corta" data-filter="duracion">
                                        <label class="form-check-label small" for="duracion-corta">
                                            Programas cortos (hasta 6 meses/1 trimestre)
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="Medio" id="duracion-media" data-filter="duracion">
                                        <label class="form-check-label small" for="duracion-media">
                                            Programas medios (6-12 meses/1-2 trimestres)
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="Largo" id="duracion-larga" data-filter="duracion">
                                        <label class="form-check-label small" for="duracion-larga">
                                            Programas largos (1-2 años)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="Extenso" id="duracion-extendida" data-filter="duracion">
                                        <label class="form-check-label small" for="duracion-extendida">
                                            Programas extendidos (+2 años)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!-- Botones de acción -->
                    <div class="d-grid gap-2">
                        <button id="applyFilters" class="btn btn-sm btn-primary">
                            <i class="bi bi-funnel me-1"></i> Aplicar Filtros
                        </button>
                        <button id="resetFilters" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Limpiar Filtros
                        </button>
                    </div>
                </section>
                
            </div>
            <!-- Main Content - 2/3 -->
            <div class="col-lg-10">         
                <!-- Chips de filtros activos -->
                <div id="activeFiltersChips" class="mb-4 d-flex flex-wrap gap-2"></div>                   
                
                <!-- Programs Section -->
                <section class="section-py2 bg-white rounded landing-features" id="landingFeatures">
                    <div class="container">
                                                
                        <div id="programsGrid3" class="row g-6">
                        <?php
                            // Obtener programas de la base de datos
                            $stmt = $conn->query("SELECT * FROM data_maestrias WHERE estado_programa = 'Publicado' LIMIT 8");
                            while ($programa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '
                                <div class="col-xl-4 col-lg-6 mb-4">
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
                                                <a href="comparar.php?add='.$programa['id'].'" class="btn btn-outline-primary d-flex align-items-center">
                                                <i class="bx bx-book me-1"></i>
                                                Comparar
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
                        <a href="#contacto" class="btn btn-outline-light btn-lg px-5 flex-grow-1 flex-lg-grow-0">
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
                            <div class="h1 fw-bolder">1.5K+</div>
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
    
    // Función para actualizar los chips de filtros activos
    function updateActiveFiltersChips(filters) {
        const chipsContainer = document.getElementById('activeFiltersChips');
        chipsContainer.innerHTML = '';
        
        // Mostrar término de búsqueda si existe
        if (searchFilter.value.trim()) {
            const searchChip = document.createElement('div');
            searchChip.className = 'filter-chip';
            searchChip.innerHTML = `
                Búsqueda: "${searchFilter.value.trim()}"
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
                    // Eliminar búsqueda
                    searchFilter.value = '';
                } else {
                    // Desmarcar checkbox correspondiente
                    const checkbox = document.querySelector(`.filter-checkbox[data-filter="${filterType}"][value="${filterValue}"]`);
                    if (checkbox) {
                        checkbox.checked = false;
                    }
                }
                
                // Recargar programas con los filtros actualizados
                activeFilters = collectActiveFilters();
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
            programsContainer.innerHTML = '<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></div>';
            
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
            updateActiveFiltersChips(filters);

            // Renderizar programas
            renderPrograms(data.programas);
            
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
    
    // Función para renderizar los programas
    function renderPrograms(programs) {
        programsContainer.innerHTML = '';
        
        if (programs.length === 0) {
            programsContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        No se encontraron programas con los filtros seleccionados.
                    </div>
                </div>
            `;
            return;
        }
        
        programs.forEach(programa => {
            const programCard = document.createElement('div');
            programCard.className = 'col-xl-4 col-lg-6 mb-4';
            programCard.innerHTML = `
                <div class="card h-100 shadow-sm border-0 hover-shadow transition d-flex flex-column">
                    <div class="card-img-top overflow-hidden" style="height: 200px;">
                        <img src="${programa.imagen_url || 'https://via.placeholder.com/400x250'}" 
                            alt="${programa.titulo}" class="img-fluid w-100 h-100 object-fit-cover">                          
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-label-info rounded-pill text-primary">${programa.tipo || 'Maestría'}</span>
                                <span class="badge bg-label-warning rounded-pill text-warning ms-2 d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                        <circle cx="12" cy="8" r="6"></circle>
                                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                                    </svg>
                                    Rank #${programa.id}
                                </span>
                            </div>

                            <h3 class="h5 card-title fw-bold mb-2">${programa.titulo}</h3>
                            <p class="text-muted mb-3">${(programa.descripcion || 'Programa académico de excelencia').substring(0, 100)}...</p>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
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
                            <a href="comparar.php?add=${programa.id}" class="btn btn-outline-primary d-flex align-items-center">
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
        
        document.querySelectorAll('.filter-checkbox:checked').forEach(checkbox => {
            const filterType = checkbox.dataset.filter;
            if (filterType in newFilters) {
                newFilters[filterType].push(checkbox.value);
            }
        });
        
        return newFilters;
    }
    
    // Event Listeners
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            activeFilters = collectActiveFilters();
            loadPrograms(1, activeFilters, searchFilter.value.trim());
        });
    });
    
    applyFiltersBtn.addEventListener('click', () => {
        activeFilters = collectActiveFilters();
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
            duracion: []
        };
        // Limpiar chips
        document.getElementById('activeFiltersChips').innerHTML = '';
        
        // Cargar primera página sin filtros
        loadPrograms(1);
    });
    
    btnSearch.addEventListener('click', () => {
        const searchTerm = searchFilter.value.trim();
        activeFilters = collectActiveFilters();
        loadPrograms(1, activeFilters, searchTerm);
    });
    
    searchFilter.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            const searchTerm = searchFilter.value.trim();
            activeFilters = collectActiveFilters();
            loadPrograms(1, activeFilters, searchTerm);
        }
    });
    
    // Cargar programas iniciales
    loadPrograms(1);
});
</script>
