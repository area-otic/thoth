<?php
$pageTitle = "Universidades - Thoth Education";
include 'includes/header.php';
include 'includes/db.php';

try {
    $stmt = $conn->prepare("SELECT * FROM data_instituciones WHERE convenio = 'Si'");
    $stmt->execute();
    $instituciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
 <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<div class="min-vh-100 bg-light " >
    <!-- Header Manteniendo la Estructura Solicitada -->
    <div class="bg-primary2 text-white pt-13 py-13">
        <div class="container px-4">
            <div class="d-flex flex-column flex-md-row align-items-md-end">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-2 text-info">
                        <a href="inicio.php" class="text-decoration-none text-white">
                            <i class="bi bi-house-door me-1"></i>Inicio
                        </a>
                        <span class="mx-2 text-white">›</span>
                        <a href="universidades.php" class="text-decoration-none text-white">
                            Instituciones con Convenio
                        </a>
                    </div>
                    
                    <h1 class="display-5 font-serif fw-extrabold mb-2">Nuestras Instituciones Aliadas</h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-handshake fs-5 me-2"></i>
                        <span class="h5 mb-0">Convenios activos con universidades internacionales</span>
                    </div> 
                    
                    <div class="d-flex flex-wrap gap-2">
                        <div class="me-4 d-flex align-items-center">
                            <i class="bx bx-building text-primary me-1"></i>
                            <span><?= count($instituciones) ?> Instituciones</span>
                        </div>
                        
                        <div class="me-4 d-flex align-items-center">
                            <i class="bi bi-globe text-primary me-1"></i>
                            <span><?= count(array_unique(array_column($instituciones, 'pais'))) ?> Países</span>
                        </div>
                        
                        <div class="me-4 d-flex align-items-center">
                            <i class="bi bi-award text-warning me-1"></i>
                            <span>Certificaciones internacionales</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal Mejorado -->
    <div class="container pt-8 py-11">
        <div class="row mb-5">
            <div class="col-md-8">
                <h2 class="fw-bold mb-3">Explora nuestras instituciones aliadas</h2>
                <p class="text-muted">
                    Nuestros estudiantes disfrutan de ventajas exclusivas en estas instituciones, incluyendo descuentos en matrícula, procesos de admisión simplificados y acceso a programas especiales.
                </p>
            </div>
            <div class="col-md-4">
                <div class="search-box input-group mb-3">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="icon-base bx bx-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Buscar institución..." id="searchInput">
                    <button class="btn btn-primary" type="button">Buscar</button>
                </div>
            </div>
        </div>

        <?php if(count($instituciones) > 0): ?>
            <!-- Filtros por País -->
            <div class="mb-6">
                <h5 class="fw-semibold mb-3">Filtrar por país:</h5>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-primary filter-btn active" data-filter="all">Todos</button>
                    <?php 
                    $paises = array_unique(array_column($instituciones, 'pais'));
                    foreach($paises as $pais): ?>
                        <button class="btn btn-sm btn-outline-primary filter-btn" data-filter="<?= htmlspecialchars(strtolower($pais)) ?>">
                            <i class="bi bi-globe me-1"></i><?= htmlspecialchars($pais) ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Grid de Universidades -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-8" id="institutionsContainer">
                <?php foreach($instituciones as $institucion): ?>
                    <div class="col institution-card" data-country="<?= htmlspecialchars(strtolower($institucion['pais'])) ?>">
                        <div class="card h-100 shadow-sm border-0 overflow-hidden hover-effect">
                            <div class="card-img-top position-relative">
                                <img src="<?= htmlspecialchars($institucion['imagen_url']) ?>"
                                    onerror="this.src='assets/img/imagen-programa.webp';" 
                                    class="img-fluid w-100" 
                                    alt="<?= htmlspecialchars($institucion['nombre']) ?>"
                                    style="height: 180px; object-fit: cover;">
                                
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-success bg-opacity-90 rounded-pill py-2 px-3">
                                        <i class="bi bi-handshake fs-6 me-1"></i> Convenio Activo
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($institucion['nombre']) ?></h5>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-geo-alt-fill text-muted me-2"></i>
                                    <span class="text-muted">
                                        <?= htmlspecialchars($institucion['ciudad']) ?>, <?= htmlspecialchars($institucion['pais']) ?>
                                    </span>
                                </div>
                                
                                <p class="card-text text-muted mb-4">
                                    <?= htmlspecialchars(substr($institucion['descripcion'], 0, 120)) ?>...
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary py-2">
                                        <?= htmlspecialchars($institucion['tipo']) ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                                <div class="d-grid gap-2">
                                    <a href="instituto.php?id=<?= $institucion['id'] ?>" class="btn btn-primary">
                                        <i class="bi bi-eye-fill me-2"></i>Ver detalles del convenio
                                    </a>
                                    <a href="<?= htmlspecialchars($institucion['url']) ?>" target="_blank" class="btn btn-outline-primary">
                                        <i class="bi bi-box-arrow-up-right me-2"></i>Visitar sitio web
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state text-center py-5">
                <img src="assets/img/no-results.svg" alt="No hay resultados" class="img-fluid mb-4" style="max-width: 300px;">
                <h3 class="fw-bold mb-3">No hay instituciones con convenio registradas</h3>
                <p class="text-muted mb-4">Actualmente no tenemos instituciones con convenio activo en nuestro sistema.</p>
                <a href="inicio.php" class="btn btn-primary px-4">
                    <i class="bi bi-arrow-left me-2"></i>Volver al inicio
                </a>
            </div>
        <?php endif; ?>
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
    
    .filter-btn.active {
        background-color: #1a3a8f;
        color: white;
        border-color: #1a3a8f;
    }
    
    .empty-state {
        background-color: #f8f9fa;
        border-radius: 12px;
    }
    
    .search-box .form-control:focus {
        box-shadow: none;
        border-color: #dee2e6;
    }
</style>

<script>
    // Filtrado por país
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            const cards = document.querySelectorAll('.institution-card');
            
            cards.forEach(card => {
                if(filter === 'all' || card.dataset.country === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Búsqueda dinámica
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const cards = document.querySelectorAll('.institution-card');
        
        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const country = card.querySelector('.text-muted').textContent.toLowerCase();
            
            if(title.includes(searchTerm) || country.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>

<?php
} catch(PDOException $e) {
    echo "<div class='alert alert-danger container my-5'>Error al cargar las instituciones: " . $e->getMessage() . "</div>";
}

include 'includes/footer.php';
?>