<?php 
include 'includes/header.php';
include 'includes/db.php'; ?>

<!-- Vendors CSS -->
<link rel="stylesheet" href="assets/pages-front/nouislider.css" />
<link rel="stylesheet" href="assets/pages-front/swiper.css" />

 <!-- SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- AOS -->
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<!-- Fancybox -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>

<!-- Sections:Start -->
  <div data-bs-spy="scroll" class="scrollspy-example">

    <section id="busqueda">
    <div id="landingHero" class="section-py landing-hero position-relative">        
      <div class="container">
        <div class="hero-text-box text-center position-relative">
          <h1 class="text-primary hero-title display-6 fw-extrabold">
            Tu Futuro Académico Comienza Aquí</h1>    
          <h2 class="hero-sub-title text-white h6 mb-6 ">
            Descubre las mejores maestrías y programas de especialización
          </h2>            
        </div>

        <div class="help-center-header">
          <h4 class="text-center text-white">Hola, qué programa buscas?</h4>
          <!-- Formulario que envía los datos a nuestros-programas.php -->
          <form action="nuestros-programas.php" method="GET" id="search-form">
            <div class="input-wrapper mb-4 input-group input-group-merge 
                  position-relative mx-auto">
              <span class="input-group-text" id="basic-addon1">
                <i class="icon-base bx bx-search"></i></span>
              <input type="text" class="form-control" id="search-name" name="search" placeholder="Buscar"
              aria-label="Buscar" aria-describedby="basic-addon1" />
            </div>

            <!-- Filtros añadidos aquí -->
            <div class="filters-container bg-white rounded-3 p-4 shadow-sm mt-4 position-relative mx-auto">
              <div class="row g-3">
                <!-- Filtro 1 -->
                <div class="col-md-4 col-12">
                  <label for="filter-tipo" class="form-label small text-muted mb-1">Tipo de Programa</label>
                  <select id="filter-tipo" name="tipo" class="form-select">
                    <option value="">Todos los tipos</option>
                    <?php
                    $tipos = $conn->query("SELECT DISTINCT tipo FROM data_programas WHERE tipo IS NOT NULL");
                    while($tipo = $tipos->fetch(PDO::FETCH_ASSOC)) {
                      echo '<option value="'.htmlspecialchars($tipo['tipo']).'">'.htmlspecialchars($tipo['tipo']).'</option>';
                    }
                    ?>
                  </select>
                </div>
                
                <!-- Filtro 2 -->
                <div class="col-md-4 col-12">
                  <label for="filter-categoria" class="form-label small text-muted mb-1">Categorías</label>
                  <select id="filter-categoria" name="categoria" class="form-select">
                    <option value="">Todas las categorías</option>
                    <?php
                    $categorias = $conn->query("SELECT DISTINCT categoria FROM data_programas WHERE categoria IS NOT NULL");
                    while($categoria = $categorias->fetch(PDO::FETCH_ASSOC)) {
                      echo '<option value="'.htmlspecialchars($categoria['categoria']).'">'.htmlspecialchars($categoria['categoria']).'</option>';
                    }
                    ?>
                  </select>
                </div>
                
                <!-- Filtro 3 -->
                <div class="col-md-4 col-12">
                  <label for="filter-pais" class="form-label small text-muted mb-1">País</label>
                  <select id="filter-pais" name="pais" class="form-select">
                    <option value="">Todos los países</option>
                    <?php
                    $paises = $conn->query("SELECT DISTINCT pais FROM data_programas WHERE pais IS NOT NULL");
                    while($pais = $paises->fetch(PDO::FETCH_ASSOC)) {
                      echo '<option value="'.htmlspecialchars($pais['pais']).'">'.htmlspecialchars($pais['pais']).'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

              <!-- Botón Más Filtros -->
              <div class="text-center my-3">
                <button type="button" onclick="toggleMoreFilters()" class="btn btn-link p-0 text-decoration-none">
                  <span id="more-filters-text">Más filtros</span>
                  <i id="more-filters-icon" class="bx bx-chevron-down ms-1"></i>
                </button>
              </div>
              
              <!-- Filtros adicionales (ocultos inicialmente) -->
              <div id="additional-filters" class="row g-3 d-none">           
                <div class="col-md-4 col-12">
                  <label for="filter-modalidad" class="form-label small text-muted mb-1">Modalidades</label>
                  <select id="filter-modalidad" name="modalidad" class="form-select">
                    <option value="">Modalidades</option>
                    <?php
                    $modalidades = $conn->query("SELECT DISTINCT modalidad FROM data_programas WHERE modalidad IS NOT NULL");
                    while($modalidad = $modalidades->fetch(PDO::FETCH_ASSOC)) {
                      echo '<option value="'.htmlspecialchars($modalidad['modalidad']).'">'.htmlspecialchars($modalidad['modalidad']).'</option>';
                    }
                    ?>
                  </select>
                </div>
                
                <div class="col-md-4 col-12">
                  <label for="filter-universidad" class="form-label small text-muted mb-1">Universidades</label>
                  <select id="filter-universidad" name="universidad" class="form-select">
                    <option value="">Todas las universidades</option>
                    <?php
                    $universidades = $conn->query("SELECT DISTINCT universidad FROM data_programas WHERE universidad IS NOT NULL");
                    while($universidad = $universidades->fetch(PDO::FETCH_ASSOC)) {
                      echo '<option value="'.htmlspecialchars($universidad['universidad']).'">'.htmlspecialchars($universidad['universidad']).'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              
              <!-- Botón de búsqueda -->
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                  <i class="bx bx-search me-2"></i>
                  Buscar Programas
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

    <!-- Programs Section -->
    <section class="section-py landing-features" id="landingFeatures">
      <div class="container">
        <div class="text-center mb-2">
          <span class="badge bg-label-primary">Programas Educativos</span>
        </div>
        <h3 class="text-center mb-1">
          Encuentra el programa perfecto para tu desarrollo profesional
        </h3>
        <br>
        <br>
                  
        <div id="programsGrid3" class="row g-6">
          <?php
            // Obtener programas de la base de datos
            $stmt = $conn->query("SELECT * FROM data_programas WHERE estado_programa = 'Publicado' LIMIT 9");
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
                          <!--<span class="badge bg-label-warning rounded-pill text-warning ms-2 d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                              <circle cx="12" cy="8" r="6"></circle>
                              <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                            </svg>
                            Rank #1
                          </span>-->
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
                      
                      <div class="card-footer bg-transparent px-3 pb-3 pt-0 border-0">
                        <a href="programa.php?id='.$programa['id'].'" class="btn btn-label-primary d-block w-100 py-2">
                          <span class="me-2">Ver detalles</span>
                          <i class="bx bx-chevron-right"></i>
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
          <a href="nuestros-programas.php" class="btn btn-primary">
              <span>Ver más programas</span>
              <i class="fas fa-chevron-down"></i>
          </a>
        </div> 
      </div>
    </section>

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
                  <a href="nuestros-programas.php" class="btn btn-light btn-lg px-5 flex-grow-1 flex-lg-grow-0">
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

    <!-- Gallery Section -->
    <section class="section-py landing-team" id="galeria">
        <div class="container">
            <div class="text-center mb-4">
                <span class="badge bg-label-primary">Nuestros convenios</span>
            </div>
            <h4 class="text-center mb-1">
                <span class="position-relative fw-extrabold z-1">Universidades con las cuales tenemos convenios.</span>
            </h4>
            <p class="text-center mb-md-11 pb-0 pb-xl-12">Son parte de nuestra familia.</p>
            
            <div id="galleryGrid" class="gallery-grid">
                <!-- Los elementos se cargarán dinámicamente aquí -->
            </div>
        </div>
    </section>

    <!-- Testimonios: Start -->
    <section id="landingReviews" class="section-py bg-body landing-reviews pb-0">
      <!-- What people say slider: Start -->
      <div class="container">
        <div class="row align-items-center gx-0 gy-4 g-lg-5 mb-5 pb-md-5">
          <div class="col-md-6 col-lg-5 col-xl-3">
            <div class="mb-4">
              <span class="badge bg-label-primary">Testimonios</span>
            </div>
            <h4 class="mb-1">
              <span class="position-relative fw-extrabold z-1"
                >Experiencias de Estudiantes</span> 
            </h4>
            <p class="mb-5 mb-md-12">
            Lo que dicen nuestros estudiantes sobre su experiencia
            </p>
            <div class="landing-reviews-btns">
              <button id="reviews-previous-btn" class="btn btn-icon btn-label-primary reviews-btn me-3" type="button">
                <i class="icon-base bx bx-chevron-left icon-md scaleX-n1-rtl"></i>
              </button>
              <button id="reviews-next-btn" class="btn btn-icon btn-label-primary reviews-btn" type="button">
                <i class="icon-base bx bx-chevron-right icon-md scaleX-n1-rtl"></i>
              </button>
            </div>
          </div>
          <div class="col-md-6 col-lg-7 col-xl-9">
            <div class="swiper-reviews-carousel overflow-hidden">
              <div class="swiper" id="swiper-reviews">
                <div class="swiper-wrapper">
                  
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- What people say slider: End -->
      <hr class="m-0 mt-6 mt-md-12" />
    </section>

    <!-- Contactanos: Start -->
    <section id="contacto" class="section-py landing-contact">
      <div class="container">
        <div class="text-center mb-4">
          <span class="badge bg-label-primary">Contactanos</span>
        </div>
        <h4 class="text-center mb-1">
          <span class="position-relative fw-extrabold z-1"
            >¿Necesitas ayuda con tu camino académico? </span></h4>
        <p class="lead text-muted text-center mx-auto" style="max-width: 600px;">Nuestro equipo está listo para responder tus preguntas y guiarte hacia el éxito educativo.</p>
        
       <div class="row g-6">
          <div class="col-lg-6">
            <div class="h-100 p-4 p-lg-5 rounded-3">
              <h3 class="h4 mb-4">Información de contacto</h3>
              
              <div class="d-flex mb-4">
                <div class="bg-primary bg-opacity-10 rounded-3 p-1_5 me-3">
                  <i class="bx bx-envelope text-primary fs-2"></i>
                </div>
                <div>
                  <h4 class="h6 text-muted mb-1">Correo electrónico</h4>
                  <a href="mailto:support@thoth.education" class="h5 mb-0 text-decoration-none">support@thoth.education</a>
                </div>
              </div>
              
              <div class="d-flex mb-4">
                <div class="bg-success bg-opacity-10 rounded-3 p-1_5 me-3">
                  <i class="bx bx-time-five text-success fs-2"></i>
                </div>
                <div>
                  <h4 class="h6 text-muted mb-1">Horario de atención</h4>
                  <p class="h5 mb-0">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                </div>
              </div>
              
              <!--<div class="d-flex mb-4">
                <div class="bg-info bg-opacity-10 rounded-3 p-1_5 me-3">
                  <i class="bx bx-map text-info fs-2"></i>
                </div>
                <div>
                  <h4 class="h6 text-muted mb-1">Ubicación</h4>
                  <p class="h5 mb-0">Ciudad de México, CDMX</p>
                </div>
              </div>
              
              <div class="mt-5 pt-3">
                <h4 class="h6 text-muted mb-3">Síguenos en redes</h4>
                <div class="d-flex gap-3">
                  <a href="#" class="btn btn-icon btn-outline-primary rounded-circle">
                    <i class="bx bxl-facebook"></i>
                  </a>
                  <a href="#" class="btn btn-icon btn-outline-primary rounded-circle">
                    <i class="bx bxl-instagram"></i>
                  </a>
                  <a href="#" class="btn btn-icon btn-outline-primary rounded-circle">
                    <i class="bx bxl-linkedin"></i>
                  </a>
                  <a href="#" class="btn btn-icon btn-outline-primary rounded-circle">
                    <i class="bx bxl-youtube"></i>
                  </a>
                </div>
              </div>-->

            </div>
          </div>

          <div class="col-lg-6">
            <div class="h-100 rounded-3" style="height: 780px;">
              <style>
                .iframe-full-height {
                  position: relative;
                  width: 100%;
                  height: 100%;
                  min-height: 860px; /* Ajusta este valor según necesites */
                  overflow: hidden;
                }
                
                .iframe-full-height iframe {
                  position: absolute;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  border: none;
                }
              </style>
              
              <div class="iframe-full-height p-0"> <!-- Quité el padding para maximizar espacio -->
                <iframe
                  src="https://b24-atnnfq.bitrix24.site/crm_form_iq60u/"
                  title="Formulario Bitrix24"
                  loading="lazy">
                </iframe>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- Contactanos: End -->

  </div>
<!-- / Sections:End -->

<?php include 'includes/footer.php'; ?>

<script src="assets/pages-front/nouislider.js"></script>
<script src="assets/pages-front/swiper.js"></script>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Page JS --> 
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

  <script>
  // Variables globales
  let currentPage = 1;
  const programsPerPage = 8;


  // Inicializar AOS
  AOS.init({
      duration: 800,
      offset: 100,
      once: true
  });

  // Función para mostrar/ocultar filtros adicionales
  function toggleMoreFilters() {
    const additionalFilters = document.getElementById('additional-filters');
    const moreFiltersIcon = document.getElementById('more-filters-icon');
    const moreFiltersText = document.getElementById('more-filters-text');
    
    additionalFilters.classList.toggle('d-none');
    
    if (additionalFilters.classList.contains('d-none')) {
      moreFiltersText.textContent = 'Más filtros';
      moreFiltersIcon.classList.replace('bx-chevron-up', 'bx-chevron-down');
    } else {
      moreFiltersText.textContent = 'Menos filtros';
      moreFiltersIcon.classList.replace('bx-chevron-down', 'bx-chevron-up');
    }
  }


  // Función para cargar la galería de universidades
  function cargarGaleria() {
      // Mostrar loader mientras carga
      const galleryGrid = document.getElementById('galleryGrid');
      galleryGrid.innerHTML = '<div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Cargando universidades...</div>';

      fetch('control/galeria_universidad_handler.php')
          .then(response => response.json())
          .then(data => {
              if (!data.success) {
                  throw new Error(data.message || 'Error al cargar datos');
              }

              galleryGrid.innerHTML = '';

              if (data.universidades && data.universidades.length > 0) {
                  data.universidades.forEach(universidad => {
                      const imageUrl = universidad.imagen_url || 'img/default-university.jpg';
                      const galleryItem = document.createElement('div');
                      galleryItem.className = 'gallery-item';
                      galleryItem.setAttribute('data-aos', 'fade-up');
                      
                      galleryItem.innerHTML = `
                          <a href="${imageUrl}"
                          data-fancybox="gallery"
                          data-caption="${universidad.nombre}"
                          data-thumb="${imageUrl}">
                              <img src="${imageUrl}" 
                                  alt="${universidad.nombre}" 
                                  class="gallery-image">
                              <div class="gallery-overlay">
                                  <h3 class="gallery-title">${universidad.nombre}</h3>
                                  <p class="gallery-description">${universidad.descripcion || universidad.pais || 'Convenio activo'}</p>
                              </div>
                          </a>
                      `;
                      galleryGrid.appendChild(galleryItem);
                  });

                  // Inicializar Fancybox si está disponible
                  if (typeof Fancybox !== 'undefined') {
                      Fancybox.bind("[data-fancybox]", {
                          // Opciones de Fancybox
                      });
                  }
              } else {
                  galleryGrid.innerHTML = '<p class="no-results">No se encontraron universidades con convenio activo.</p>';
              }
          })
          .catch(error => {
              console.error('Error:', error);
              galleryGrid.innerHTML = '<p class="error-message">Error al cargar la galería de universidades.</p>';
          });
  }

  // Función para cargar testimonios (estilo similar a cargarGaleria)
  function cargarTestimonios() {
      const swiperWrapper = document.querySelector('#swiper-reviews .swiper-wrapper');
      const swiperContainer = document.querySelector('.swiper-reviews-carousel');
      
      if (!swiperWrapper || !swiperContainer) return;

      // Mostrar loader
      swiperContainer.innerHTML = '<div class="text-center py-5"><i class="fas fa-spinner fa-spin"></i> Cargando testimonios...</div>';

      fetch('control/testimonios_handler.php')
          .then(response => response.json())
          .then(data => {
              if (!data.success) {
                  throw new Error(data.message || 'Error al cargar testimonios');
              }

              // Restaurar estructura del swiper
              swiperContainer.innerHTML = `
                  <div class="swiper" id="swiper-reviews">
                      <div class="swiper-wrapper"></div>
                  </div>
              `;
              
              const newSwiperWrapper = document.querySelector('#swiper-reviews .swiper-wrapper');

              if (data.testimonios && data.testimonios.length > 0) {
                  data.testimonios.forEach(testimonio => {
                      const slide = document.createElement('div');
                      slide.className = 'swiper-slide';
                      
                      // Usamos valores por defecto seguros
                      const logoEmpresa = testimonio.logo_empresa || '';
                      const imagenUrl = testimonio.imagen_url || 'https://via.placeholder.com/60x60';
                      const nombrePersona = testimonio.nombre_persona || 'Estudiante';
                      const programa = testimonio.programa_cursado || 'Estudiante';
                      const calificacion = testimonio.calificacion || 5;
                      const textoTestimonio = testimonio.testimonio || '';

                      slide.innerHTML = `
                          <div class="card h-100">
                              <div class="card-body text-body d-flex flex-column justify-content-between h-100">
                                  <div class="mb-4">
                                      ${logoEmpresa ? 
                                          `<img src="${logoEmpresa}" alt="Logo institución" class="client-logo img-fluid" />` : 
                                          '<div class="mb-4"></div>'}
                                  </div>
                                  <p>“${textoTestimonio}”</p>
                                  <div class="text-warning mb-4">
                                      ${'<i class="icon-base bx bxs-star"></i>'.repeat(Math.min(5, calificacion))}
                                      ${'<i class="icon-base bx bx-star"></i>'.repeat(Math.max(0, 5 - calificacion))}
                                  </div>
                                  <div class="d-flex align-items-center">
                                      <div class="avatar me-3 avatar-sm">
                                          <img src="${imagenUrl}" 
                                              alt="${nombrePersona}" 
                                              class="rounded-circle" />
                                      </div>
                                      <div>
                                          <h6 class="mb-0">${nombrePersona}</h6>
                                          <p class="small text-body-secondary mb-0">${programa}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      `;
                      newSwiperWrapper.appendChild(slide);
                  });

                  // Inicializar swiper
                  if (typeof Swiper !== 'undefined') {
                      initTestimonialsSwiper();
                  } else {
                      console.error('Swiper no está disponible');
                  }
              } else {
                  newSwiperWrapper.innerHTML = `
                      <div class="swiper-slide">
                          <div class="card h-100">
                              <div class="card-body text-center py-5">
                                  No hay testimonios disponibles actualmente
                              </div>
                          </div>
                      </div>
                  `;
                  initTestimonialsSwiper();
              }
          })
          .catch(error => {
              console.error('Error:', error);
              swiperContainer.innerHTML = `
                  <div class="text-center py-5">
                      Error al cargar testimonios. 
                      <button class="btn btn-label-primary" onclick="cargarTestimonios()">Reintentar</button>
                  </div>
              `;
          });
  }

  // Función para inicializar el swiper (igual que antes)
  function initTestimonialsSwiper() {
      if (typeof Swiper === 'undefined') {
          console.warn('Swiper no está cargado, reintentando en 1 segundo...');
          setTimeout(initTestimonialsSwiper, 1000);
          return;
      }

      if (window.testimonialsSwiper) {
          window.testimonialsSwiper.destroy();
      }

      window.testimonialsSwiper = new Swiper('#swiper-reviews', {
          slidesPerView: 1,
          spaceBetween: 20,
          navigation: {
              nextEl: '#reviews-next-btn',
              prevEl: '#reviews-previous-btn'
          },
          breakpoints: {
              768: {
                  slidesPerView: 2,
                  spaceBetween: 20
              },
              992: {
                  slidesPerView: 3,
                  spaceBetween: 20
              }
          }
      });
  }

  // Event Listeners para el modal
  document.addEventListener('DOMContentLoaded', function() {

      // Cargar la galería al inicio
      cargarGaleria();

      // Cargar testimonios al inicio
      cargarTestimonios();
      
  });

  </script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>