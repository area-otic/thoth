<!doctype html>
<html
  lang="es"
  class=" layout-navbar-fixed layout-wide "
  dir="ltr" data-skin="default" data-bs-theme="light"
  data-assets-path="assets/"
  data-template="front-pages">
  
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Encuentra maestrías, doctorados y programas educativos de las mejores universidades. ¡Estudia en línea o presencial con becas disponibles!" />
    <title>Thoth</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/pages-front/iconify-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/pages-front/pickr-themes.css" />
    <link rel="stylesheet" href="assets/pages-front/core.css" />
    <link rel="stylesheet" href="assets/pages-front/demo.css" />

    <link rel="stylesheet" href="assets/pages-front/front-page.css" />

    <!-- Helpers -->
    <script src="assets/pages-front/helpers.js"></script>
    <script src="assets/pages-front/template-customizer.js"></script>
    <script src="assets/pages-front/front-config.js"></script>
    
  </head>

<body>

<script src="assets/pages-front/dropdown-hover.js"></script>
<script src="assets/pages-front/mega-dropdown.js"></script>

<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0">
  <div class="container-fluid">
    <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8">

      <div class="navbar-brand app-brand demo d-flex py-0 me-4 me-xl-8">

        <button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="icon-base bx bx-menu icon-lg align-middle text-heading fw-medium"></i>
        </button>

        <a class="navbar-brand" href="inicio.php">
        <i class="icon-base-xl bx bx-graduation"></i>
        Thoth<span style="color: #E74C3C">Education</span></a>
      </div>

      <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
        <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl p-2" 
        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="icon-base bx bx-x icon-lg"></i>
        </button>
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link fw-medium" aria-current="page" href="inicio.php">Inicio</a>
          </li>
          <!--<li class="nav-item mega-dropdown">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium" aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
              <span data-i18n="Pages">Programas</span>
            </a>
            <div class="dropdown-menu p-4 p-xl-8">
              <div class="row gy-4">
                <div class="col-12 col-lg">
                  <div class="h6 d-flex align-items-center mb-3 mb-lg-4">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-primary"><i class="icon-base bx bx-grid-alt"></i></span>
                    </div>
                    <span class="ps-1">Categorías</span>
                  </div>
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="pricing-page.html">
                        <i class="icon-base bx bx-radio-circle me-1"></i>
                        <span data-i18n="Pricing">Humanidades</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="payment-page.html">
                        <i class="icon-base bx bx-radio-circle me-1"></i>
                        <span data-i18n="Payment">Educacion</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-12 col-lg">
                  <div class="h6 d-flex align-items-center mb-3 mb-lg-4">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-primary"><i class="icon-base bx bx-lock-open icon-lg"></i></span>
                    </div>
                    <span class="ps-1">Pais</span>
                  </div>
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="../vertical-menu-template/auth-login-basic.html" target="_blank">
                        <i class="icon-base bx bx-radio-circle me-1"></i>
                        Perú
                      </a>
                    </li>                    
                  </ul>
                </div>                
              </div>
            </div>
          </li>-->
          <li class="nav-item">
            <a class="nav-link fw-medium" href="nuestros-programas.php">Programas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="universidades.php">Universidades Convenio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="landing-page.html#landingContact">Contáctanos</a>
          </li>          
          <li class="nav-item">
              <a class="nav-link fw-medium d-flex align-items-center" href="instituto-id.php" id="compareNavLink">
                  <i class="bx bx-book me-2"></i>
                  <span>Comparar</span>
                  <span id="compareCounter" class="badge rounded-pill text-white ms-2" style="width: 20px; height: 20px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.7rem; background-color: #7367f0;">
                      0
                  </span>
              </a>
          </li>        
        </ul>
      </div>
    </div>
  </div>
</nav>
<!-- Navbar: End -->