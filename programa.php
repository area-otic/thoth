<?php
include 'includes/db.php'; // Adjust according to your structure

// Get ID from URL and validate it
$id_program = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query the specific program
$stmt = $conn->prepare("SELECT * FROM data_programas WHERE id = ? AND estado_programa = 'Publicado'");
$stmt->execute([$id_program]);
$program = $stmt->fetch(PDO::FETCH_ASSOC);

// If program doesn't exist, redirect
if (!$program) {
    header("Location: ../noencontrada.php");
    exit;
}
// Define the page title with the program name
$pageTitle = htmlspecialchars($program['titulo']) . " - Thoth Education";

include 'includes/header.php';
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
<?php
// Determinar qué iframe mostrar según la universidad
$iframeSrc = (strpos(strtolower($program['universidad'] ?? ''), 'cesuma') !== false)
    ? 'https://b24-atnnfq.bitrix24.site/crm_form_a6tvs/'
    : 'https://b24-atnnfq.bitrix24.site/crm_form_iq60u/';
?>


<!-- Program Content -->
<div class=" min-vh-100 bg-light">
    <!-- Header -->
    <div class="bg-primary2 text-white pt-13 py-13">
        <div class="container px-4">
            <div class="d-flex flex-column flex-md-row align-items-md-end">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-2 text-info">
                        <a href="nuestros-programas.php" class="text-decoration-none text-white">Programa</a>
                        <span class="mx-2">›</span>
                        <a class="text-decoration-none text-white">
                            <?php echo htmlspecialchars($program['tipo']); ?>
                        </a>
                    </div>
                    
                    <h1 class="display-5 font-serif fw-extrabold mb-2"><?php echo htmlspecialchars($program['titulo'?? 'Nombre de Programa.']); ?></h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <i class="bx bx-building fs-5 me-2"></i> <!-- Añade fs-5 para igualar el tamaño del texto -->
                        <span class="h5 mb-0"><?php echo htmlspecialchars($program['universidad'] ?? 'Universidad'); ?></span>
                    </div> 
                    <div class="d-flex flex-wrap gap-2">
                        <?php if(!empty($program['ranking'])): ?>
                            <div class="me-4 d-flex align-items-center">
                                <i class="bi bi-award text-warning me-1"></i>
                                <span>Ranked #<?php echo htmlspecialchars($program['ranking']); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="me-4 d- align-items-center">
                            <i class="bi bi-geo-alt text-primary me-1"></i>
                            <span><?php echo htmlspecialchars($program['pais']?? 'Global'); ?>, <?php echo htmlspecialchars($program['pais'?? 'Global']); ?></span>
                        </div>
                        
                        <div class="me-4 d-flex align-items-center">
                            <i class="bi bi-clock text-primary me-1"></i>
                            <span><?php echo htmlspecialchars($program['duracion']?? 'meses'); ?></span>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <i class="bi bi-globe text-primary me-1"></i>
                            <span><?php echo htmlspecialchars($program['modalidad'] ?? 'Formato'); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mt-3 mt-md-0 text-md-end">
                    <!--<button onclick="addToCompare(<?php echo $program['id']; ?>)" class="btn btn-light text-primary px-4 py-2 fw-medium me-2">
                        <i class="bi bi-journal-check me-2"></i>
                        Añadir para comparar
                    </button>-->
                    
                    <button type="button" class="btn btn-dark px-4 py-2 fw-medium" data-bs-toggle="modal" data-bs-target="#bitrixModal">
                    <i class="bi bi-globe me-2"></i>
                    Postular Ahora
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rediseñado -->
    <div class="modal fade" id="bitrixModal" tabindex="-1" aria-labelledby="bitrixModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3"> <!-- Bordes redondeados -->
        <!-- Header con gradiente -->
        <div class="modal-header bg-gradient-primary text-white position-relative rounded-top-3" style="padding-bottom:15px;"> <!-- Solo redondear arriba -->
            <div class="w-100 text-center">
            <h2 class="modal-title h5 mb-0 fw-semibold" id="bitrixModalLabel">
                <i class="bi bi-pencil-square me-2"></i>
                Completa tu solicitud
            </h2>
            </div>
            <!-- Botón de cierre centrado verticalmente -->
        </div>
        
        <!-- Body simplificado -->
        <div class="modal-body p-0">
            <div class="ratio ratio-16x9" style="min-height: 70vh;">
            <iframe 
                id="bitrixIframe"
                src="<?php echo $iframeSrc; ?>" 
                style="border: none;"
                title="Formulario de Postulación"
                loading="eager"
                allowfullscreen>
            </iframe>
            </div>
        </div>
        
        <!-- Footer mejorado -->
        <div class="modal-footer bg-light justify-content-center rounded-bottom-3" style="padding-top:15px;"> <!-- Solo redondear abajo -->
            <button type="button" class="btn btn-outline-primary px-4 rounded-pill fw-medium" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-2"></i>
            Cerrar formulario
            </button>
            <small class="text-muted text-center mt-2 d-block">
            <i class="bi bi-lock-fill me-1"></i>
            Tus datos están protegidos
            </small>
        </div>
        </div>
    </div>
    </div>

    <style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    }
    /* Asegura que el botón de cerrar esté perfectamente centrado */
    .modal-header .btn-close {
        padding: 0.75rem; /* Mayor área táctil */
    }
    </style>

    <!-- Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="row g-4">
            <!-- Main Content - 2/3 -->
            <div class="col-lg-8">
                <!-- Program Image -->
                <img src="<?php echo htmlspecialchars($program['imagen_url'] ?? 'assets/img/imagen-programa.webp'); ?>" 
                    onerror="this.src='assets/img/imagen-programa.webp';" 
                    alt="<?php echo htmlspecialchars($program['titulo'] ?? 'Nombre del programa'); ?>" 
                    class="w-full img-fluid rounded shadow-md mb-4 program-image">                
                
                <!-- Description -->
                <section class="bg-white p-6 rounded shadow-md mb-6">
                    <h2 class="h2 fw-bold mb-3 font-serif text-primary">Resumen del programa</h2>
                    <p class="text-muted mb-4">
                        <?php echo nl2br(htmlspecialchars($program['descripcion'] ?? 'Descripcion del Programa')); ?>
                    </p>
                    
                    <div class="row g-3 mt-3">
                        <div class="col-md-6 d-flex">
                            <div class="feature-icon text-primary fs-5">
                                <i class="bx bxs-message-square-edit "></i>
                            </div>
                            <div>
                                <h3 class="h6 fw-semibold">Categoría</h3>
                                <p class="text-muted">
                                <?php 
                                echo htmlspecialchars(
                                    !empty($program['categoria']) ? $program['categoria'] : 'No especificado'
                                ); 
                                ?>
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-6 d-flex">
                            <div class="feature-icon text-primary fs-5">
                                <i class="bx bx-bxs-graduation"></i>
                            </div>
                            <div>
                                <h3 class="h6 fw-semibold">Título</h3>
                                <p class="text-muted">
                                     <?php 
                                        echo htmlspecialchars(
                                            !empty($program['titulo_grado']) ? $program['titulo_grado'] : 'Sin especificar'
                                        ); 
                                    ?>
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-6 d-flex">
                            <div class="feature-icon text-primary fs-5">
                                <i class="bx bx-bxs-calendar"></i>
                            </div>
                            <div>
                                <h3 class="h6 fw-semibold">Fecha de Admisión</h3>
                                <p class="text-muted">
                                    <?php 
                                        echo htmlspecialchars(
                                            !empty($program['fecha_admision']) ? $program['fecha_admision'] : 'No especificado'
                                        ); 
                                    ?>
                                </p>
                            </div>
                        </div>

                        
                        <div class="col-md-6 d-flex">
                            <div class="feature-icon text-primary fs-5">
                                <i class="bi bi-translate"></i>
                            </div>
                            <div>
                                <h3 class="h6 fw-semibold">Idioma</h3>
                                <p class="text-muted"><?php 
                                    echo htmlspecialchars(
                                        !empty($program['idioma']) ? $program['idioma'] : 'No especificado'
                                    ); 
                                ?></p>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Specializations 
                <section class="bg-white p-6 rounded shadow mb-4">
                    <h2 class="h2 fw-bold mb-3 text-primary">Especializaciones</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <?php foreach(json_decode($program['']) as $spec): ?>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                <?php echo htmlspecialchars($spec); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </section>-->
                
                <!-- Objetivos -->
                <section class="bg-white p-6 rounded shadow-xl mb-6">
                    <h2 class="h2 fw-bold mb-3 font-serif text-primary">Objetivos del Programa</h2>
                    <ul class="list-unstyled">
                        <?php 
                        // Dividir el texto por saltos de línea
                        $objetivos = explode("\n", $program['objetivos']);                        
                        // Filtrar elementos vacíos
                        $objetivos = array_filter($objetivos, function($line) {
                            return trim($line) !== '';
                        });
                        
                        foreach($objetivos as $objetivo): 
                            // Eliminar viñetas (-) si existen
                            $objetivo_limpio = preg_replace('/^-\s*/', '', trim($objetivo));
                        ?>
                            <li class="mb-2 d-flex">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span class="text-muted"><?php echo htmlspecialchars($objetivo_limpio); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <div class="mt-4 p-3 bg-warning bg-opacity-10 rounded border border-warning border-opacity-25">
                        <div class="d-flex align-items-center text-warning-emphasis mb-2">
                            <i class="bx bx-calendar fs-5 me-2"></i>  <!-- Icono de Boxicons -->
                            <h3 class="h6 fw-medium mb-0">Fecha de Admisión</h3>
                        </div>
                        <p class="text-muted" style="margin-bottom: 0.1rem;">
                            <?php 
                                echo htmlspecialchars(
                                    !empty($program['fecha_admision']) ? $program['fecha_admision'] : 'No especificado'
                                ); 
                            ?>
                        </p>
                    </div>
                </section>

                <!-- Admission Requirements -->
                <section class="bg-white p-6 rounded shadow-xl mb-6">
                    <h2 class="h2 fw-bold mb-3 font-serif text-primary">Plan de estudios</h2>
                    <ul class="list-unstyled">
                        <?php 
                        // Dividir el texto por saltos de línea
                        $objetivos = explode("\n", $program['plan_estudios']);
                        
                        // Filtrar elementos vacíos y excluir "Plan de Estudios"
                        $objetivos = array_filter($objetivos, function($line) {
                            $line = trim($line);
                            return $line !== '' && stripos($line, 'Plan de Estudios') === false;
                        });
                        
                        foreach($objetivos as $objetivo): 
                            // Eliminar viñetas (-) si existen y espacios adicionales
                            $objetivo_limpio = preg_replace('/^-\s*/', '', trim($objetivo));
                        ?>
                            <li class="mb-2 d-flex">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span class="text-muted"><?php echo htmlspecialchars($objetivo_limpio); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo htmlspecialchars($program['url_brochure']); ?>" 
                    target="_blank" rel="noopener noreferrer"
                    class="btn btn-outline-primary d-flex align-items-center justify-content-center w-100 mb-2 mb-md-0">
                    <i class="bi bi-download me-2"></i>
                    Descargar Brochure
                    </a>
                    
                </section>

                <?php if (!empty(trim($program['requisitos']))): ?>
                <!-- Admission Requirements -->
                <section class="bg-white p-6 rounded shadow-xl mb-6">
                    <h2 class="h2 fw-bold mb-3 font-serif text-primary">Requisitos</h2>
                    <ul class="list-unstyled">
                        <?php 
                        // Dividir el texto por saltos de línea
                        $requisitos = explode("\n", $program['requisitos']);
                        
                        // Filtrar elementos vacíos
                        $requisitos = array_filter($requisitos, function($line) {
                            return trim($line) !== '';
                        });
                        
                        foreach($requisitos as $requisito): 
                            // Eliminar viñetas (-) o (+) si existen y espacios adicionales
                            $requisito_limpio = preg_replace('/^-\s*|\+\s*/', '', trim($requisito));
                        ?>
                            <li class="mb-2">
                                - <span class="text-muted"><?php echo htmlspecialchars($requisito_limpio); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
                <?php endif; ?>

                <!-- Admission Requirements
                <section class="bg-white p-6 rounded shadow mb-4">
                    <h2 class="h2 fw-bold mb-3 text-primary">Admission Requirements</h2>
                    <ul class="list-unstyled">
                        <?php foreach(json_decode($program['objetivos']) as $requirement): ?>
                            <li class="mb-2 d-flex">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                <span class="text-muted"><?php echo htmlspecialchars($requirement); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <div class="mt-4 p-3 bg-warning bg-opacity-10 rounded border border-warning border-opacity-25">
                        <div class="d-flex align-items-center text-warning-emphasis mb-2">
                            <i class="bi bi-calendar me-2"></i>
                            <h3 class="h6 fw-medium">Application Deadline</h3>
                        </div>
                        <p class="text-muted"><?php echo htmlspecialchars($program['application_deadline']); ?></p>
                    </div>
                </section> -->
            </div>
            
            <!-- Sidebar - 1/3 -->
            <div class="col-lg-4">
                <!-- Key Information -->
                <section class="bg-white p-6 rounded shadow-xl mb-6">
                    <h2 class="h2 fw-bold mb-4 font-serif text-primary">Detalles</h2>
                    
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center py-4">
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-currency-dollar me-2"></i>
                                <span>Precio</span>
                            </div>
                            <div class="fw-semibold">
                                <?php echo htmlspecialchars($program['precio_monto']); ?> 
                                <?php echo htmlspecialchars($program['precio_moneda']); ?>
                            </div>
                        </div>
                        
                        <div class="list-group-item d-flex justify-content-between align-items-center py-4">
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-clock me-2"></i>
                                <span>Duracion</span>
                            </div>
                            <div class="fw-semibold"><?php echo htmlspecialchars($program['duracion']); ?></div>
                        </div>
                        
                        <div class="list-group-item d-flex justify-content-between align-items-center py-4">
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-globe me-2"></i>
                                <span>Modalidad</span>
                            </div>
                            <div class="fw-semibold"><?php echo htmlspecialchars($program['modalidad']); ?></div>
                        </div>
                                                
                        
                        <div class="list-group-item d-flex justify-content-between align-items-center py-4">
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-translate me-2"></i>
                                <span>Idioma</span>
                            </div>
                            <div class="fw-semibold">
                                <?php 
                                    echo htmlspecialchars(
                                        !empty($program['idioma']) ? $program['idioma'] : 'No especificado'
                                    ); 
                                ?>
                            </div>
                        </div>
                        
                    </div>
                </section>
                
                <!-- Additional Features -->
                <section class="bg-white p-6 rounded shadow mb-6">
                    <h2 class="h2 fw-bold mb-4 font-serif text-primary">Características Adicionales</h2>
                    
                    <div class="list-unstyled">
                        <div class="mb-2 d-flex">
                            <?php if($program['modalidad']): ?>
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <?php else: ?>
                                <i class="bi bi-x-circle-fill text-danger me-2"></i>
                            <?php endif; ?>
                            <span class="text-muted">Becas disponibles</span>
                        </div>
                        
                        <div class="mb-2 d-flex">
                            <?php if($program['modalidad']): ?>
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <?php else: ?>
                                <i class="bi bi-x-circle-fill text-danger me-2"></i>
                            <?php endif; ?>
                            <span class="text-muted">Oportunidades de Internship</span>
                        </div>
                    </div>
                    
                    <?php if(!empty($program['accreditations'])): ?>
                        <div class="mt-4 pt-3 border-top">
                            <h3 class="h6 fw-semibold mb-2">Accreditations</h3>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach(json_decode($program['accreditations']) as $item): ?>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1">
                                        <?php echo htmlspecialchars($item); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>
                
                <!-- Institution Information -->
                <section class="bg-white p-6 rounded shadow mb-6">
                    <h2 class="h2 fw-bold mb-4 font-serif text-primary">Acerca de la institución</h2>
                    
                    <div class="d-flex align-items-center mb-4">
                        <i class="bx bx-building fs-4 text-primary me-3"></i>  <!-- Icono de Boxicons -->
                        <h3 class="h5 fw-semibold mb-0"><?php echo htmlspecialchars($program['universidad']); ?></h3>
                    </div>
                    
                    <a href="<?php echo htmlspecialchars($program['url']); ?>" target="_blank" class="text-decoration-none d-flex align-items-center mb-3">
                        <i class="bi bi-globe me-2"></i>
                        Visita la web del Instituto
                    </a>
                    
                    <div class="bg-light p-3 rounded">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tipo</span>
                            <span class="fw-semibold"><?php echo htmlspecialchars($program['tipo']); ?></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">País</span>
                            <span class="fw-semibold"><?php echo htmlspecialchars($program['pais']); ?></span>
                        </div>
                    </div>
                </section>
                
                <!-- Call to Action -->
                <section class="bg-primary p-6 rounded shadow text-white text-center">
                    <h2 class="h2 fw-bold mb-4">¿Interesado en este programa?</h2>
                    <p class="mb-4 text-white text-opacity-75">
                        Agregue a su lista de comparación o visite el sitio web de la institución para obtener detalles de la solicitud.
                    </p>
                    <div class="d-grid gap-3">
                        <button class="btn btn-light text-primary px-4 py-2 fw-medium" data-bs-toggle="modal" data-bs-target="#bitrixModal">
                        <i class="bi bi-journal-check me-2"></i>
                        Aplicar Ahora
                        </button>
                        
                        <!--<button onclick="addToCompare(<?php echo $program['id']; ?>)" class="btn btn-light text-primary px-4 py-2 fw-medium">
                            <i class="bi bi-journal-check me-2"></i>
                            Añadir para comparar
                        </button>
                        
                        <a href="<?php echo htmlspecialchars($program['url']); ?>" target="_blank" class="btn btn-dark px-4 py-2 fw-medium">
                            <i class="bi bi-file-earmark-text me-2"></i>
                            Aplicar Ahora
                        </a>-->
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
<?php include 'includes/footer.php'; ?>