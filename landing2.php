<?php
include 'includes/header.php';
include 'includes/db.php'; // Ajusta según tu estructura

// 2. Obtener el ID de la URL y validarlo
$id_maestria = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3. Consultar la maestría específica
$stmt = $conn->prepare("SELECT * FROM data_maestrias WHERE id = ? AND estado_programa = 'Publicado'");
$stmt->execute([$id_maestria]);
$maestria = $stmt->fetch(PDO::FETCH_ASSOC);

// 4. Si no existe la maestría, redirigir
if(!$maestria) {
    header("Location: programas.php"); // O página de error 404
    exit;
}
?>

<section class="hero-section position-relative" style="background: linear-gradient(135deg, #001f3f 0%, #003366 50%, #00509e 100%); overflow: hidden;">
    <!-- Imagen de fondo con overlay dinámica -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 0; background-image: url('<?php echo htmlspecialchars($maestria['imagen_url'] ?? 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); ?>'); background-size: cover; background-position: center; opacity: 0.15;">
    </div>
    
    <div id="landingHero" class="section-py landing-hero position-relative">
      <div class="container">
        <div class="d-flex justify-content-between flex-column-reverse flex-lg-row align-items-center pt-12 pb-10">
          <div class="text-lg-start text-white">
          <h1 class="mb-3" style="color: #ffffff; text-shadow: 0 2px 4px rgba(0,0,0,0.3);"> <?php echo htmlspecialchars($maestria['titulo']); ?></h1>
            <p class="lead mb-6 mb-md-11" style="color: #e6f0ff;">Adquiere conocimientos avanzados y desarrolla habilidades de liderazgo con nuestro prestigioso programa de posgrado.</p>
            
            <div class="d-flex gap-3 justify-content-lg-start">
              <a href="#inscripcion" class="btn btn-primary btn-lg" style="background-color: #4dabf7; border-color: #4dabf7; box-shadow: 0 4px 12px rgba(77, 171, 247, 0.4);">Postular ahora</a>
              <a href="#programa" class="btn btn-outline-light btn-lg">Conocer más</a>
            </div>
            
            <div class="mt-4">
              <span class="badge bg-light-primary me-2" style="background-color: rgba(255,255,255,0.15); color: #ffffff;">⭐ Acreditada internacionalmente</span>
              <span class="badge bg-light-primary" style="background-color: rgba(255,255,255,0.15); color: #ffffff;">🏆 Top 5 en rankings académicos</span>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8"><div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-lg"><div class="h-48 overflow-hidden"><img src="https://images.pexels.com/photos/267885/pexels-photo-267885.jpeg" alt="Master of Business Administration" class="w-full h-full object-cover"></div><div class="p-6"><div class="flex items-center mb-2"><span class="text-xs font-semibold px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full">Masters</span><span class="ml-2 text-xs font-semibold px-2 py-1 bg-amber-100 text-amber-800 rounded-full flex items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award h-3 w-3 mr-1"><circle cx="12" cy="8" r="6"></circle><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path></svg>Rank #1</span></div><h3 class="text-xl font-bold mb-2 text-gray-800">Master of Business Administration</h3><p class="text-gray-600 mb-4">Harvard Business School</p><div class="space-y-2 mb-4"><div class="flex items-center text-sm text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-4 w-4 mr-2 text-gray-400"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>Boston, United States</div><div class="flex items-center text-sm text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-4 w-4 mr-2 text-gray-400"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>2 years</div><div class="flex items-center text-sm text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign h-4 w-4 mr-2 text-gray-400"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>73.440 USD</div></div><div class="flex justify-between"><a class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center" href="/program/1">View Details</a><a class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center" href="/compare?add=1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open-check h-4 w-4 mr-1"><path d="M8 3H2v15h7c1.7 0 3 1.3 3 3V7c0-2.2-1.8-4-4-4Z"></path><path d="m16 12 2 2 4-4"></path><path d="M22 6V3h-6c-2.2 0-4 1.8-4 4v14c0-1.7 1.3-3 3-3h7v-2.3"></path></svg>Compare</a></div></div></div><div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-lg"><div class="h-48 overflow-hidden"><img src="https://images.pexels.com/photos/256381/pexels-photo-256381.jpeg" alt="PhD in Computer Science" class="w-full h-full object-cover"></div><div class="p-6"><div class="flex items-center mb-2"><span class="text-xs font-semibold px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full">PhD</span><span class="ml-2 text-xs font-semibold px-2 py-1 bg-amber-100 text-amber-800 rounded-full flex items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award h-3 w-3 mr-1"><circle cx="12" cy="8" r="6"></circle><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path></svg>Rank #1</span></div><h3 class="text-xl font-bold mb-2 text-gray-800">PhD in Computer Science</h3><p class="text-gray-600 mb-4">Massachusetts Institute of Technology</p><div class="space-y-2 mb-4"><div class="flex items-center text-sm text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-4 w-4 mr-2 text-gray-400"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>Cambridge, United States</div><div class="flex items-center text-sm text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-4 w-4 mr-2 text-gray-400"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>4-6 years</div><div class="flex items-center text-sm text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign h-4 w-4 mr-2 text-gray-400"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>55.450 USD</div></div><div class="flex justify-between"><a class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center" href="/program/2">View Details</a><a class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center" href="/compare?add=2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open-check h-4 w-4 mr-1"><path d="M8 3H2v15h7c1.7 0 3 1.3 3 3V7c0-2.2-1.8-4-4-4Z"></path><path d="m16 12 2 2 4-4"></path><path d="M22 6V3h-6c-2.2 0-4 1.8-4 4v14c0-1.7 1.3-3 3-3h7v-2.3"></path></svg>Compare</a></div></div></div><div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-lg"><div class="h-48 overflow-hidden"><img src="https://images.pexels.com/photos/2892618/pexels-photo-2892618.jpeg" alt="Master of Arts in International Relations" class="w-full h-full object-cover"></div><div class="p-6"><div class="flex items-center mb-2"><span class="text-xs font-semibold px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full">Masters</span><span class="ml-2 text-xs font-semibold px-2 py-1 bg-amber-100 text-amber-800 rounded-full flex items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award h-3 w-3 mr-1"><circle cx="12" cy="8" r="6"></circle><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path></svg>Rank #3</span></div><h3 class="text-xl font-bold mb-2 text-gray-800">Master of Arts in International Relations</h3><p class="text-gray-600 mb-4">London School of Economics</p><div class="space-y-2 mb-4"><div class="flex items-center text-sm text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-4 w-4 mr-2 text-gray-400"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>London, United Kingdom</div><div class="flex items-center text-sm text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-4 w-4 mr-2 text-gray-400"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>1 year</div><div class="flex items-center text-sm text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign h-4 w-4 mr-2 text-gray-400"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>23.520 GBP</div></div><div class="flex justify-between"><a class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center" href="/program/3">View Details</a><a class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center" href="/compare?add=3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open-check h-4 w-4 mr-1"><path d="M8 3H2v15h7c1.7 0 3 1.3 3 3V7c0-2.2-1.8-4-4-4Z"></path><path d="m16 12 2 2 4-4"></path><path d="M22 6V3h-6c-2.2 0-4 1.8-4 4v14c0-1.7 1.3-3 3-3h7v-2.3"></path></svg>Compare</a></div></div></div></div>

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

