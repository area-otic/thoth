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
    <div class="bg-primary2 text-white pt-13 py-13">
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
</style>

    <!-- Content -->
    <div class="container-fluid mx-auto px-12 py-8">
        <div class="row g-4">
            <!-- Sidebar - 1/3 -->
            <div class="col-lg-2">
                <!-- Filtros Section -->
                <section class="bg-white p-4 rounded shadow mb-4">
                    <h2 class="h5 fw-bold mb-3 font-serif text-primary">Filtrar Programas</h2>
                    
                    <!-- Filtro de Búsqueda -->
                    <div class="mb-4">
                        <label for="search-filter" class="form-label small text-muted">Buscar</label>
                        <input type="text" id="search-filter" class="form-control form-control-sm" placeholder="Escribe para buscar...">
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
                                <div class="accordion-body pt-0 pb-2 px-3">
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
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="6" id="duracion-6" data-filter="duracion">
                                        <label class="form-check-label small" for="duracion-6">
                                            Menos de 6 meses
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="12" id="duracion-12" data-filter="duracion">
                                        <label class="form-check-label small" for="duracion-12">
                                            6-12 meses
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="24" id="duracion-24" data-filter="duracion">
                                        <label class="form-check-label small" for="duracion-24">
                                            1-2 años
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input filter-checkbox" type="checkbox" value="25" id="duracion-25" data-filter="duracion">
                                        <label class="form-check-label small" for="duracion-25">
                                            Más de 2 años
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botones de acción -->
                    <div class="d-grid gap-2">
                        <button id="applyFilters" class="btn btn-sm btn-primary">Aplicar Filtros</button>
                        <button id="resetFilters" class="btn btn-sm btn-outline-secondary">Limpiar Filtros</button>
                    </div>
                </section>
                
            </div>
            <!-- Main Content - 2/3 -->
            <div class="col-lg-10">
                                
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
                                    <a href="landing-prueba.php?id='.$programa['id'].'" class="btn btn-label-primary d-flex align-items-center">
                                    <span class="me-2">Ver detalles</span>
                                    <i class="bx bx-chevron-right"></i>
                                    </a>
                                    <a href="compare.php?add='.$programa['id'].'" class="btn btn-outline-primary d-flex align-items-center">
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
<?php include 'includes/footer.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables
    const programsContainer = document.getElementById('programsGrid3');
    const applyFiltersBtn = document.getElementById('applyFilters');
    const resetFiltersBtn = document.getElementById('resetFilters');
    const searchFilter = document.getElementById('search-filter');
    let allPrograms = [];
    
    // Cargar todos los programas al inicio
    function loadAllPrograms() {
        fetch('includes/get_programs.php') // Ajusta esta URL a tu endpoint real
            .then(response => response.json())
            .then(data => {
                allPrograms = data;
                renderPrograms(allPrograms);
            });
    }
    
    // Aplicar filtros
    function applyFilters() {
        const selectedFilters = {
            tipo: [],
            categoria: [],
            pais: [],
            modalidad: [],
            duracion: []
        };
        
        // Recoger todos los checkboxes seleccionados
        document.querySelectorAll('.filter-checkbox:checked').forEach(checkbox => {
            const filterType = checkbox.getAttribute('data-filter');
            selectedFilters[filterType].push(checkbox.value);
        });
        
        // Filtrar programas
        const filteredPrograms = allPrograms.filter(program => {
            // Filtro de búsqueda
            const searchTerm = searchFilter.value.toLowerCase();
            if (searchTerm && !program.titulo.toLowerCase().includes(searchTerm) && 
                !program.descripcion.toLowerCase().includes(searchTerm)) {
                return false;
            }
            
            // Filtros por categorías
            for (const filterType in selectedFilters) {
                if (selectedFilters[filterType].length > 0) {
                    // Caso especial para duración (rangos)
                    if (filterType === 'duracion') {
                        const programDuration = parseInt(program.duracion) || 0;
                        let matchesDuration = false;
                        
                        selectedFilters.duracion.forEach(range => {
                            const numRange = parseInt(range);
                            if (numRange === 6 && programDuration < 6) matchesDuration = true;
                            else if (numRange === 12 && programDuration >= 6 && programDuration <= 12) matchesDuration = true;
                            else if (numRange === 24 && programDuration > 12 && programDuration <= 24) matchesDuration = true;
                            else if (numRange === 25 && programDuration > 24) matchesDuration = true;
                        });
                        
                        if (!matchesDuration) return false;
                    } 
                    // Filtros normales
                    else if (!selectedFilters[filterType].includes(program[filterType])) {
                        return false;
                    }
                }
            }
            
            return true;
        });
        
        renderPrograms(filteredPrograms);
    }
    
    // Renderizar programas
    function renderPrograms(programs) {
        programsContainer.innerHTML = '';
        
        if (programs.length === 0) {
            programsContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <i class="bi bi-search display-4 text-muted mb-3"></i>
                    <h4 class="text-muted">No se encontraron programas</h4>
                    <p class="text-muted">Intenta con otros criterios de búsqueda</p>
                </div>
            `;
            return;
        }
        
        programs.forEach(program => {
            const programCard = `
                <div class="col-xl-4 col-lg-6 mb-4">
                    <!-- ... tu estructura de tarjeta de programa ... -->
                </div>
            `;
            programsContainer.insertAdjacentHTML('beforeend', programCard);
        });
    }
    
    // Event Listeners
    applyFiltersBtn.addEventListener('click', applyFilters);
    
    resetFiltersBtn.addEventListener('click', function() {
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
        searchFilter.value = '';
        renderPrograms(allPrograms);
    });
    
    searchFilter.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            applyFilters();
        }
    });
    
    // Inicializar
    loadAllPrograms();
});

  // Variables globales
    let currentPage = 1;
    const programsPerPage = 8;


    // Inicializar AOS
    AOS.init({
        duration: 800,
        offset: 100,
        once: true
    });

    // Función para buscar programas con los filtros aplicados
    function buscarProgramas() {
        // Crear objeto con todos los posibles filtros
        const filtros = {
            nombre: document.getElementById('search-name').value.trim(),
            tipo: document.getElementById('filter-tipo').value,
            categoria: document.getElementById('filter-categoria').value,
            pais: document.getElementById('filter-pais').value,
            modalidad: document.getElementById('filter-modalidad').value,
            universidad: document.getElementById('filter-universidad').value
        };

        // Filtrar solo los parámetros que tienen valor
        const params = new URLSearchParams();
        for (const [key, value] of Object.entries(filtros)) {
            if (value) {
                params.append(key, value);
            }
        }

        // Mostrar loader
        Swal.fire({
            title: 'Buscando programas...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Realizar la petición AJAX
        fetch(`control/buscar_programas.php?${params.toString()}`)
        .then(response => response.json())
        .then(data => {
            Swal.close();
            
            if (data.error) {
                Swal.fire('Error', data.error, 'error');
                return;
            }

            const programas = data.programas || [];
            const totalResultados = data.total || 0;

            // Limpiar el grid actual
            const programsGrid = document.getElementById('programsGrid3');
            programsGrid.innerHTML = '';
            
            // Mostrar los resultados
            if (programas.length === 0) {
                programsGrid.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-search fa-3x mb-3" style="color: #ccc;"></i>
                        <h3>No se encontraron programas</h3>
                        <p>Intenta con otros criterios de búsqueda</p>
                    </div>
                `;
            } else {
                mostrarProgramas3(programas);
            }

            // Mostrar SweetAlert con el número de resultados
            let mensaje = '';
            let icono = '';

            if (totalResultados > 0) {
                const mostrando = Math.min(programas.length, 8);
                mensaje = `Se encontraron <b>${totalResultados}</b> programa${totalResultados === 1 ? '' : 's'} en total<br>`;
                mensaje += `Mostrando ${mostrando} de ${totalResultados}`;
                icono = 'success';
            } else {
                mensaje = 'No se encontraron programas que coincidan con los criterios de búsqueda';
                icono = 'info';
            }

            Swal.fire({
                title: 'Resultados de búsqueda',
                html: mensaje,
                icon: icono,
                timer: 4000, // Un poco más de tiempo para leer
                timerProgressBar: true,
                showConfirmButton: false,
                position: 'top-end',
                toast: true,
                customClass: {
                    popup: 'swal2-show-custom',
                    title: 'swal2-title-custom',
                    content: 'swal2-content-custom'
                }
            });
            
            // Resetear la página actual
            currentPage = 1;
            
            // Mostrar u ocultar botón "Ver más" según resultados
            document.getElementById('loadMoreBtn3').style.visibility = totalResultados > 8 ? 'visible' : 'hidden';
        })
        .catch(error => {
            Swal.close();
            Swal.fire('Error', 'Ocurrió un error al buscar los programas', 'error');
            console.error('Error:', error);
        });
    }

    // Función para cargar más programas via AJAX
    function cargarMasProgramas3() {
        currentPage++;
        
        // Obtener valores de los filtros (si hay alguno aplicado)
        const nombre = document.getElementById('search-name').value.trim();
        const tipo = document.getElementById('filter-tipo').value;
        const categoria = document.getElementById('filter-categoria').value;
        const pais = document.getElementById('filter-pais').value;
        const modalidad = document.getElementById('filter-modalidad').value;
        const universidad = document.getElementById('filter-universidad').value;

        // Mostrar loader en el botón
        const loadMoreBtn = document.getElementById('loadMoreBtn3');
        loadMoreBtn.innerHTML = '<span>Cargando...</span> <i class="fas fa-spinner fa-spin"></i>';
        loadMoreBtn.disabled = true;

        // Realizar la petición AJAX
        fetch('control/cargar_masprogramas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `page=${currentPage}&nombre=${encodeURIComponent(nombre)}&tipo=${encodeURIComponent(tipo)}&categoria=${encodeURIComponent(categoria)}&pais=${encodeURIComponent(pais)}&modalidad=${encodeURIComponent(modalidad)}&universidad=${encodeURIComponent(universidad)}`
        })
        .then(response => response.json())
        .then(data => {
            // Restaurar el botón
            loadMoreBtn.innerHTML = '<span>Ver más programas</span> <i class="fas fa-chevron-down"></i>';
            loadMoreBtn.disabled = false;
            
            if (data.error) {
                Swal.fire('Error', data.error, 'error');
                return;
            }

            // Mostrar los resultados
            if (data.length === 0) {
                loadMoreBtn.style.display = 'none';
                Swal.fire({
                    title: 'No hay más programas',
                    text: 'Has llegado al final de los resultados',
                    icon: 'info',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                mostrarProgramas3(data);
            }
        })
        .catch(error => {
            // Restaurar el botón
            loadMoreBtn.innerHTML = '<span>Ver más programas</span> <i class="fas fa-chevron-down"></i>';
            loadMoreBtn.disabled = false;
            
            Swal.fire('Error', 'Ocurrió un error al cargar más programas', 'error');
            console.error('Error:', error);
        });
    }

    // Función para mostrar programas en el grid
    function mostrarProgramas3(programas) {
        const contenedor = document.getElementById('programsGrid3');
        
        programas.forEach(programa => {
            const card = `
                <div key="${programa.id}" class="col-xl-4 col-lg-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 hover-shadow transition d-flex flex-column">
                    <div class="card-img-top overflow-hidden" style="height: 200px;">
                        <img 
                        src="${programa.imagen_url || 'https://via.placeholder.com/400x250'}"
                        alt="${programa.titulo}"
                        class="img-fluid w-100 h-100 object-fit-cover">                          
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <div class="flex-grow-1"> <!-- Contenido que puede crecer -->
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
                        
                        <!-- Información fija encima de los botones -->
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
                            ${programa.duracion || '---'}
                        </div>

                        <div class="d-flex align-items-center text-muted mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-muted">
                            <path d="M3 21h18M6 18V9m4 9V9m4 9V9m4 9V9M3 9l9-6 9 6" />
                            </svg>
                            ${programa.universidad || 'Universidad'}
                        </div>

                        </div>
                        
                        <!-- Botones pegados al fondo -->
                        <div class="d-flex justify-content-between mt-auto">
                        <a href="landing-prueba.php?id=${programa.id}" class="btn btn-label-primary d-flex align-items-center">
                            <span class="me-2">Ver detalles</span>
                            <i class="bx bx-chevron-right"></i>
                        </a>
                        <a href="compare.php?add=${programa.id}" class="btn btn-outline-primary d-flex align-items-center">
                            <i class="bx bx-book me-1"></i>
                            Comparar
                        </a>
                        </div>
                    </div>
                    </div>
                </div>

            `;
            contenedor.insertAdjacentHTML('beforeend', card);
        });
    }


</script>