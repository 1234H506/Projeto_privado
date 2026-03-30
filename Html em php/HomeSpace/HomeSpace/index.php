<?php
session_start();




include("assets/class/exibir_agentes.php");
require_once("conexao.php");
require_once("assets/class/comentario.php");

/** @var mysqli $conn */

// comentários
$comentarios = new Comentarios(null, null, null);
$resultado_comentarios = $comentarios->listar($conn);


// exibir agentes
$agentes = new Exibir_agentes("", "", "", "", "", "");
$resultado_agentes = $agentes->DadosAgentes($conn,4);


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title> HomeSpace </title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

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

<body class="index-page">

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
            <path
              d="M2 11L6.06296 7.74968M22 11L13.8741 4.49931C12.7784 3.62279 11.2216 3.62279 10.1259 4.49931L9.34398 5.12486"
              stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M15.5 5.5V3.5C15.5 3.22386 15.7239 3 16 3H18.5C18.7761 3 19 3.22386 19 3.5V8.5"
              stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M4 22V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path d="M20 9.5V13.5M20 22V17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
            <path
              d="M15 22V17C15 15.5858 15 14.8787 14.5607 14.4393C14.1213 14 13.4142 14 12 14C10.5858 14 9.87868 14 9.43934 14.4393M9 22V17"
              stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path
              d="M14 9.5C14 10.6046 13.1046 11.5 12 11.5C10.8954 11.5 10 10.6046 10 9.5C10 8.39543 10.8954 7.5 12 7.5C13.1046 7.5 14 8.39543 14 9.5Z"
              stroke="currentColor" stroke-width="1.5"></path>
          </g>
        </svg>
        <h1 class="sitename">HomeSpace</h1>
      </a>

      <?php include('navbar.php'); ?>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="hero-wrapper">
          <div class="row g-4">

            <div class="col-lg-7">
              <div class="hero-content" data-aos="zoom-in" data-aos-delay="200">
                <div class="content-header">
                  <span class="hero-label">
                    <i class="bi bi-house-heart"></i>
                    Casas do seu sonho está tem aguardando
                  </span>
                  <h1>Encontre o seu imóvel ideal com orientação especializada</h1>
                </div>

                <div class="search-container" data-aos="fade-up" data-aos-delay="300">
                  <div class="search-header">
                    <h3>Comece sua pesquisa de propriedades</h3>
                    <p>Descubra milhares de listagens verificadas</p>
                  </div>

                  <form action="" class="property-search-form">
                    <div class="search-grid">
                      <div class="search-field">
                        <label for="search-location" class="field-label">Localização</label>
                        <input type="text" id="search-location" name="location" placeholder="Local" required="">
                        <i class="bi bi-geo-alt field-icon"></i>
                      </div>

                      <div class="search-field">
                        <label for="search-type" class="field-label">Tipo de propriedade</label>
                        <select id="search-type" name="property_type" required="">
                          <option value="">Todos os tipos</option>
                          <option value="house">Casas</option>
                          <option value="apartment">Apartamentos</option>
                          <option value="condo">Condomínio</option>
                          <option value="villa">Vila</option>
                        </select>
                        <i class="bi bi-building field-icon"></i>
                      </div>

                      <div class="search-field">
                        <label for="search-budget" class="field-label">Faixa de orçamento</label>
                        <select id="search-budget" name="price_range" required="">
                          <option value="">Qualquer valor</option>
                          <option value="0-300000">Abaixo de €300K</option>
                          <option value="300000-600000">€300K - €600K</option>
                          <option value="600000-900000">€600K - €900K</option>
                          <option value="900000-1500000">€900K - €1.5M</option>
                          <option value="1500000+">Acima de €1.5M</option>
                        </select>
                        <i class="bi bi-currency-dollar field-icon"></i>
                      </div>

                      <div class="search-field">
                        <label for="search-rooms" class="field-label">Nº de Quartos</label>
                        <select id="search-rooms" name="bedrooms">
                          <option value="1">1 Quartos</option>
                          <option value="2">2 Quartos</option>
                          <option value="3">3 Quartos</option>
                          <option value="4">4 Quartos</option>
                          <option value="5+">5+ Quartos</option>
                        </select>
                        <i class="bi bi-door-open field-icon"></i>
                      </div>
                    </div>

                    <button type="submit" class="search-btn">
                      <i class="bi bi-search"></i>
                      <span>Procurar propriedades</span>
                    </button>
                  </form>
                </div>

                <div class="achievement-grid" data-aos="fade-up" data-aos-delay="400">
                  <div class="achievement-item">
                    <div class="achievement-number">
                      <span data-purecounter-start="0" data-purecounter-end="1250" data-purecounter-duration="1"
                        class="purecounter"></span>+
                    </div>
                    <span class="achievement-text">Listagem ativas </span>
                  </div>
                  <div class="achievement-item">
                    <div class="achievement-number">
                      <span data-purecounter-start="0" data-purecounter-end="89" data-purecounter-duration="1"
                        class="purecounter"></span>+
                    </div>
                    <span class="achievement-text">Agentes Especialistas</span>
                  </div>
                  <div class="achievement-item">
                    <div class="achievement-number">
                      <span data-purecounter-start="0" data-purecounter-end="96" data-purecounter-duration="1"
                        class="purecounter"></span>%
                    </div>
                    <span class="achievement-text">Ações concluídas</span>
                  </div>
                </div>
              </div>
            </div><!-- End Hero Content -->

            <div class="col-lg-5">
              <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                <div class="visual-container">
                  <div class="featured-property">
                    <img src="assets/img/real-estate/property-exterior-8.webp" alt="Featured Property"
                      class="img-fluid">
                    <div class="property-info">
                      <div class="property-price">€925,000</div>
                      <div class="property-details">
                        <span><i class="bi bi-geo-alt"></i> Downtown District</span>
                        <span><i class="bi bi-house"></i> 4 Casas de banhos , 3 Quartos</span>
                      </div>
                    </div>
                  </div>

                  <div class="overlay-images">
                    <div class="overlay-img overlay-1">
                      <img src="assets/img/real-estate/property-interior-4.webp" alt="Interior View" class="img-fluid">
                    </div>
                    <div class="overlay-img overlay-2">
                      <img src="assets/img/real-estate/property-exterior-2.webp" alt="Exterior View" class="img-fluid">
                    </div>
                  </div>

                  <div class="agent-card">
                    <div class="agent-profile">
                      <img src="assets/img/real-estate/agent-7.webp" alt="Agent Profile" class="agent-photo">
                      <div class="agent-info">
                        <h4>Michael Chen</h4>
                        <p>Consultor Imobiliário Sênior</p>
                        <div class="agent-rating">
                          <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                          </div>
                          <span class="rating-text">5.0 (94 comentários)</span>
                        </div>
                      </div>
                    </div>
                    <button class="contact-agent-btn">
                      <i class="bi bi-chat-dots"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div><!-- End Hero Visual -->

          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- Home About Section -->
    <section id="home-about" class="home-about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">

          <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
            <div class="image-gallery">
              <div class="primary-image">
                <img src="assets/img/real-estate/property-exterior-1.webp" alt="Modern Property" class="img-fluid">
                <div class="experience-badge">
                  <div class="badge-content">
                    <div class="number"><span data-purecounter-start="0" data-purecounter-end="15"
                        data-purecounter-duration="1" class="purecounter"></span>+</div>
                    <div class="text">Anos<br>de Experiência</div>
                  </div>
                </div>
              </div>
              <div class="secondary-image">
                <img src="assets/img/real-estate/property-interior-4.webp" alt="Luxury Interior" class="img-fluid">
              </div>
            </div>
          </div>

          <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
            <div class="content">
              <div class="section-header">
                <span class="section-label">Sobre nossa empresa</span>
                <h2>Construindo sonhos, criando lares desde 2008</h2>
              </div>

              <p>Nossa missão vai além da simples construção de imóveis; buscamos transformar sonhos em realidade.</p>

              <div class="achievements-list">
                <div class="achievement-item">
                  <div class="achievement-icon">
                    <i class="bi bi-house-door"></i>
                  </div>
                  <div class="achievement-content">
                    <h4><span data-purecounter-start="0" data-purecounter-end="3200" data-purecounter-duration="2"
                        class="purecounter"></span>+ Imóveis Vendidos</h4>

                  </div>
                </div>
                <div class="achievement-item">
                  <div class="achievement-icon">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="achievement-content">
                    <h4><span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="1"
                        class="purecounter"></span>% Clientes Satisfeitos</h4>

                  </div>
                </div>
              </div>

              <div class="action-section"><!--
                <a href="about.html" class="btn-cta">
                  <span>Discover Our Story</span>
                  <i class="bi bi-arrow-right"></i>
                </a>-->
                <div class="contact-info">
                  <div class="contact-icon">
                    <i class="bi bi-telephone"></i>
                  </div>
                  <div class="contact-details">
                    <span>Ligue-nos hoje</span>
                    <strong>+1 (555) 123-4567</strong>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Home About Section -->

    <!-- Featured Properties Section -->
    <section id="featured-properties" class="featured-properties section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Propriedades em Destaques</h2>
        <p>Um pouco do que podemos oferecer</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">

          <div class="col-lg-8">

            <div class="featured-property-main" data-aos="zoom-in" data-aos-delay="200">
              <div class="property-hero">
                <img src="assets/img/real-estate/property-exterior-4.webp" alt="Luxury Estate" class="img-fluid">
                <div class="property-overlay">
                  <div class="property-badge-main premium">Premium</div>
                  <div class="property-stats">
                    <div class="stat-item">
                      <i class="bi bi-house-door"></i>
                      <span>6 Quartos</span>
                    </div>
                    <div class="stat-item">
                      <i class="bi bi-droplet-fill"></i>
                      <span>5 Casas de Banhos</span>
                    </div>
                    <div class="stat-item">
                      <i class="bi bi-arrows-move"></i>
                      <span>5,500 m²</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="property-hero-content">
                <div class="property-header">
                  <div class="property-info">
                    <h2><a href="property-details.html">Magnífica propriedade com vista para o jardim.</a></h2>
                    <div class="property-address">
                      <i class="bi bi-geo-alt-fill"></i>
                      <span>Malibu, CA 90265</span>
                    </div>
                  </div>
                  <div class="property-price-main">€4,850,000</div>
                </div>
                <p class="property-description">Luxuosa propriedade situada nas exclusivas colinas de Malibu, com vistas
                  panorâmicas para o oceano, piscina infinita, adega e quadra de tênis privativa. Uma obra-prima
                  arquitetônica com acabamentos de primeira linha em todos os ambientes.</p>
                <div class="property-actions-main">
                  <a href="property-details.html" class="btn-primary-custom">Visualizar</a>
                  <!--<a href="property-details.html" class="btn-outline-custom">View Gallery</a>-->
                  <div class="property-listing-info">
                    <span class="listing-status for-sale">À venda</span>
                    <span class="listing-date">Listando hoje</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-4">

            <div class="properties-sidebar">

              <div class="sidebar-property-card" data-aos="fade-left" data-aos-delay="300">
                <div class="sidebar-property-image">
                  <img src="assets/img/real-estate/property-exterior-1.webp" alt="Modern Condo" class="img-fluid">
                  <div class="sidebar-property-badge hot">Oportunidade imperdível</div>
                </div>
                <div class="sidebar-property-content">
                  <h4><a href="property-details.html">Condomínio contemporâneo no centro da cidade</a></h4>
                  <div class="sidebar-location">
                    <i class="bi bi-pin-map"></i>
                    <span>Seattle, WA 98101</span>
                  </div>
                  <div class="sidebar-specs">
                    <span><i class="bi bi-house"></i> 3 Quartos</span>
                    <span><i class="bi bi-droplet"></i> 2 Casas de banhos</span>
                    <span><i class="bi bi-rulers"></i> 195 m²</span>
                  </div>
                  <div class="sidebar-price-row">
                    <div class="sidebar-price">€1,595,000</div>
                    <a href="property-details.html" class="sidebar-btn">Visualizar</a>
                  </div>
                </div>
              </div>

              <div class="sidebar-property-card" data-aos="fade-left" data-aos-delay="400">
                <div class="sidebar-property-image">
                  <img src="assets/img/real-estate/property-exterior-9.webp" alt="Family Home" class="img-fluid">
                  <div class="sidebar-property-badge new">Nova listagem</div>
                </div>
                <div class="sidebar-property-content">
                  <h4><a href="property-details.html">Residência familiar elegante</a></h4>
                  <div class="sidebar-location">
                    <i class="bi bi-pin-map"></i>
                    <span>Portland, OR 97201</span>
                  </div>
                  <div class="sidebar-specs">
                    <span><i class="bi bi-house"></i> 4 Quartos</span>
                    <span><i class="bi bi-droplet"></i> 3 Casas de banhos</span>
                    <span><i class="bi bi-rulers"></i> 3,100 m²</span>
                  </div>
                  <div class="sidebar-price-row">
                    <div class="sidebar-price">€925,000</div>
                    <a href="property-details.html" class="sidebar-btn">Visualizar</a>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>

        <div class="row gy-4 mt-4">

          <div class="col-xl-6" data-aos="fade-up" data-aos-delay="600">
            <div class="property-card-horizontal">
              <div class="property-image-horizontal">
                <img src="assets/img/real-estate/property-interior-5.webp" alt="Penthouse" class="img-fluid">
                <div class="property-badge-horizontal exclusive">Exclusiva</div>
              </div>
              <div class="property-content-horizontal">
                <h3><a href="property-details.html"> Cobertura de luxo</a></h3>
                <div class="property-location-horizontal">
                  <i class="bi bi-geo-alt"></i>
                  <span>Las Vegas, NV 89102</span>
                </div>
                <div class="property-features">
                  <span class="feature"><i class="bi bi-house"></i> 3 Quartos</span>
                  <span class="feature"><i class="bi bi-droplet"></i> 3 Casas de banho</span>
                  <span class="feature"><i class="bi bi-rulers"></i> 2,850 m²</span>
                </div>
                <p>Cobertura espetacular com janelas do chão ao teto e terraço privativo na cobertura com vista para o
                  horizonte da cidade.</p>
                <div class="property-footer-horizontal">
                  <div class="property-price-horizontal">€2,195,000</div>
                  <a href="property-details.html" class="btn-view-horizontal">Visualizar</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-6" data-aos="fade-up" data-aos-delay="700">
            <div class="property-card-horizontal">
              <div class="property-image-horizontal">
                <img src="assets/img/real-estate/property-interior-8.webp" alt="Modern Home" class="img-fluid">
                <div class="property-badge-horizontal new">Nova</div>
              </div>
              <div class="property-content-horizontal">
                <h3><a href="property-details.html">Jóia arquitetônica moderna</a></h3>
                <div class="property-location-horizontal">
                  <i class="bi bi-geo-alt"></i>
                  <span>Phoenix, AZ 85001</span>
                </div>
                <div class="property-features">
                  <span class="feature"><i class="bi bi-house"></i> 4 Quartos</span>
                  <span class="feature"><i class="bi bi-droplet"></i> 3 Casas de banho</span>
                  <span class="feature"><i class="bi bi-rulers"></i> 3,450 m²</span>
                </div>
                <p>Design contemporâneo premiado com características sustentáveis, tecnologia de casa inteligente e
                  quintal estilo resort.</p>
                <div class="property-footer-horizontal">
                  <div class="property-price-horizontal">€1,375,000</div>
                  <a href="property-details.html" class="btn-view-horizontal">Visualizar</a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Featured Properties Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Serviços em destaque</h2>
        <!--<p></p> Se quiser colocar um título mais adiante -->
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">

          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="300">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-key"></i>
              </div>
              <div class="service-info">
                <h3>Imóveis alugavéis</h3>
                <p>Os melhores imóveis da sua região podem estar aqui.</p>
                <ul class="service-highlights">
                  <li><i class="bi bi-check-circle-fill"></i> Correspondência de inquilino</li>
                  <li><i class="bi bi-check-circle-fill"></i> Gestão de local</li>
                  <li><i class="bi bi-check-circle-fill"></i> Regiões restritas</li>
                </ul>
                <form action="arrendamento.php" method="POST">
                <input type="hidden" name="id_servico_arrendamento" value="arrendamento">
                <button type="submit" class="service-link border-0">
                    <span>Explora</span>
                    <i class="bi bi-arrow-up-right"></i>
                </button>
                </form>
              </div>
              <div class="service-visual">
                <img src="assets/img/real-estate/property-interior-8.webp" class="img-fluid" alt="Property Rental"
                  loading="lazy">
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="400">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-calculator"></i>
              </div>
              <div class="service-info">
                <h3>Vendas de casas ou apartamentos</h3>
                <p>Encontre-nos para uma avaliação do local e discussões de preços.</p>
                <ul class="service-highlights">
                  <li><i class="bi bi-check-circle-fill"></i> Análise do local</li>
                  <li><i class="bi bi-check-circle-fill"></i> Debates pelo melhores preços</li>
                </ul>
                <form action="vendas.php" method="POST">
                <input type="hidden" name="id_servico_vendas" value="Vendas">
                <button type="submit" class="service-link border-0">
                    <span>Explora</span>
                    <i class="bi bi-arrow-up-right"></i>
                </button>
                </form>
              </div>
              <div class="service-visual">
                <img src="assets/img/real-estate/property-exterior-1.webp" class="img-fluid" alt="Property Valuation"
                  loading="lazy">
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

        <div class="row g-4 mt-4">



        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <!-- Featured Agents Section -->
    <section id="featured-agents" class="featured-agents section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Agentes em destaques</h2>
        <p>Consulte nossos agentes para encontrar as melhores casas disponíveis no momento.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">

          <?php while ($row = $resultado_agentes->fetch_assoc()) { ?>

            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
              <div class="featured-agent">
                <div class="agent-wrapper">
                  <div class="agent-photo">
                    <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/agents/<?= $row['Imagem'] ?>"
                      alt="Foto agentes" class="img-fluid">
                  </div>
                  <div class="agent-details">
                    <h4><?= $row["nome"] ?></h4>
                    <div class="location-info">
                      <i class="bi bi-geo-alt-fill"></i>
                      <span><?= $row["concelho"] ?></span>
                    </div>
                    <div class="expertise-tags">
                      <span class="tag"><?= $row["Servicos"] ?></span>
                      <!-- <span class="tag">Exclusivas</span> -->
                    </div>
                    <a href="agent-profile.php?id=<?=$row["ID_Agentes"]?>" class="view-profile">Ver listagens</a>
                  </div>
                </div>
              </div>
            </div><!-- End Featured Agent -->
          <?php } ?>
        </div>
      </div>

      <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
        <a href="A_agents.php" class="discover-all-agents">
          <span>Mais agentes</span>
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      </div>

    </section><!-- /Featured Agents Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Comentários</h2>
        <p></p>
      </div><!-- End Section Title -->

      <div class="container mb-5">
        <div class="testimonial-grid">

          <?php
          $delay = 100;
          while ($row = $resultado_comentarios->fetch_assoc()) {
            ?>
            <div class="testimonial-item" data-aos="zoom-in" data-aos-delay="<?= $delay ?>">
              <div class="testimonial-card">
                <div class="testimonial-header">
                  <div class="testimonial-image">
                    <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/utilizador/<?= $row["Imagem"] ?>"
                      class="img-fluid" alt="Foto usuário">
                  </div>
                  <div class="testimonial-meta">
                    <h3><?= $row["Nome"] ?></h3>
                    <h4><?= $row["assunto"] ?></h4>
                    <div class="company-logo">
                      <i class="bi bi-chat-quote-fill quote-icon"></i>
                    </div>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p><?= $row["Analise"] ?></p>
                </div>
              </div>
            </div>
            <?php
            $delay += 100;
          }
          ?>

        </div>
      </div>

    </section><!-- /Testimonials Section -->



  </main>

  <?php include("footer.php"); ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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
  <script src="assets/js/olhinho.js"></script>

</body>

</html>