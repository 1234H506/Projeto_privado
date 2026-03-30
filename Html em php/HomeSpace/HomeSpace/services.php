<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>HomeSpace </title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: HomeSpace
  * Template URL: https://bootstrapmade.com/homespace-bootstrap-real-estate-template/
  * Updated: Jul 05 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="services-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <svg class="my-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="bgCarrier" stroke-width="0"></g>
          <g id="tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="iconCarrier">
            <path d="M22 22L2 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M2 11L6.06296 7.74968M22 11L13.8741 4.49931C12.7784 3.62279 11.2216 3.62279 10.1259 4.49931L9.34398 5.12486" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M15.5 5.5V3.5C15.5 3.22386 15.7239 3 16 3H18.5C18.7761 3 19 3.22386 19 3.5V8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M4 22V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M20 9.5V13.5M20 22V17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M15 22V17C15 15.5858 15 14.8787 14.5607 14.4393C14.1213 14 13.4142 14 12 14C10.5858 14 9.87868 14 9.43934 14.4393M9 22V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M14 9.5C14 10.6046 13.1046 11.5 12 11.5C10.8954 11.5 10 10.6046 10 9.5C10 8.39543 10.8954 7.5 12 7.5C13.1046 7.5 14 8.39543 14 9.5Z" stroke="currentColor" stroke-width="1.5"></path>
          </g>
        </svg>
        <h1 class="sitename">HomeSpace</h1>
      </a>

       <?php include ('navbar.php'); ?>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Serviços</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Menu principal</a></li>
            <li class="current">Serviços</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">
          <div class="col-xl-12" data-aos="fade-left" data-aos-delay="300">
            <div class="service-block">
              <div class="service-content">
                <div class="service-number">01</div>
                <div class="service-info">
                  <h4>Venda pelo valor máximo</h4>
                  <p>Procure uma análise de uma profissional para obter um preço real de seu imóvel</p>
                  <ul class="service-features">
                    <li><i class="bi bi-check-circle"></i> Avaliações de um profissional</li>
                    <li><i class="bi bi-check-circle"></i>Preço real</li>
                  </ul>
                  <form action="vendas.php" method="POST">
                <input type="hidden" name="id_servico_vendas" value="Vendas">
                <button type="submit" class="service-btn border-0">
                   Navegar por aluguéis <i class="bi bi-arrow-right"></i>
                </button>
                </form>
                </div>
              </div>
              <div class="service-image">
                <img src="assets/img/real-estate/property-exterior-7.webp" alt="Sell Property" class="img-fluid">
                <div class="image-overlay">
                  <i class="bi bi-currency-dollar"></i>
                </div>
              </div>
            </div>
          </div><!-- End Service Block -->

          <div class="col-xl-12" data-aos="fade-right" data-aos-delay="400">
            <div class="service-block">
              <div class="service-content">
                <div class="service-number">02</div>
                <div class="service-info">
                  <h4>Aluguel Premium</h4>
                  <p>Aluga a casa perfeita sem complicações, com o apoio de quem percebe do mercado</p>
                  <ul class="service-features">
                    <li><i class="bi bi-check-circle"></i> Variedades de imóveis </li>
                    <li><i class="bi bi-check-circle"></i> Termos de locação flexíveis</li>
                  </ul>
                  <form action="arrendamento.php" method="POST">
                <input type="hidden" name="id_servico_arrendamento" value="arrendamento">
                <button type="submit" class="service-btn border-0">
                   Navegar por aluguéis <i class="bi bi-arrow-right"></i>
                </button>
                </form>
                </div>
              </div>
              <div class="service-image">
                <img src="assets/img/real-estate/property-interior-5.webp" alt="Premium Rentals" class="img-fluid">
                <div class="image-overlay">
                  <i class="bi bi-key"></i>
                </div>
              </div>
            </div>
          </div><!-- End Service Block -->

          

        </div>

        

      </div>

    </section><!-- /Services Section -->

  </main>

  <?php include("footer.php"); ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>