<?php
session_start();
include("../config.php/base.php");
include("../reutilizaveis/conexao.php");
include("../reutilizaveis/Funcoes_util.php");

$id_imovel = $_GET['id'];

$sql_imovel = "SELECT * FROM imoveis i , galeria a WHERE i.ID_Imoveis = a.Imoveis_ID_Imoveis AND i.ID_Imoveis = $id_imovel";
$result = mysqli_query($conn, $sql_imovel);

$dados_gerais = null;
$lista_fotos = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    // Na primeira linha, guardamos os dados fixos (morada, preço, etc)
    if ($dados_gerais === null) {
      $dados_gerais = $row;
    }
    // Em todas as linhas, guardamos o nome da imagem no array
    $lista_fotos[] = $row["Fotos"];
  }

  // Agora criamos O OBJETO ÚNICO passando a lista de fotos completa
  $imovel = new Dados_Imoveis(
    $dados_gerais["Morada"],
    $dados_gerais["Preco"],
    $dados_gerais["Tipologia"],
    $dados_gerais["Capacidadedegaragem"],
    $dados_gerais["Areautil"],
    $dados_gerais["concelho"],
    $dados_gerais["Distrito"],
    $dados_gerais["Comentariosderaridade"],
    $dados_gerais["Dataderegistro"],
    $lista_fotos // Aqui entra o array com todas as fotos!
  );
}

// dados do agentes
$dados_agente = "SELECT * FROM agentes a , imoveis i WHERE a.ID_Agentes = i.Agentes_ID_Agentes AND i.ID_Imoveis = $id_imovel;";
$result_agente = mysqli_query($conn, $dados_agente);
if (mysqli_num_rows($result_agente) > 0) {
  while ($row = mysqli_fetch_assoc($result_agente)) {
    $id_agente = $row['ID_Agentes'];
    $agente_nome = $row['nome'];
    $agente_telemovel = $row['NdeTelemovel'];
    $agente_servico = $row['Servicos'];
    $agente_email = $row['Email'];
    $agente_imagem = $row['Imagem'];
    $agente_sexo = $row['Sexo'];
  }
} else {
  echo "Nenhum dado foi encontrado.";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Detalhes da propriedade - HomeSpace </title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: HomeSpace
  * Template URL: https://bootstrapmade.com/homespace-bootstrap-real-estate-template/
  * Updated: Jul 05 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="property-details-page">

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

      <?php include("../reutilizaveis/navbar.php"); ?>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Detalhes da propriedade</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="<?=BASE_URL?>pagina/index.php">Menu Principal</a></li>
            <li class="current">Detalhes da propriedade</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Property Details Section -->
    <section id="property-details" class="property-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-7">


            <!-- Property Hero Section -->
            <div class="property-hero mb-5" data-aos="fade-up" data-aos-delay="200">
              <div class="hero-image-container">
                <div class="property-gallery-slider swiper init-swiper">
                  <script type="application/json" class="swiper-config">
                    {
                      "loop": true,
                      "speed": 600,
                      "autoplay": {
                        "delay": 5000
                      },
                      "navigation": {
                        "nextEl": ".swiper-button-next",
                        "prevEl": ".swiper-button-prev"
                      },
                      "thumbs": {
                        "swiper": ".property-thumbnails-slider"
                      }
                    }
                  </script>
                  <div class="swiper-wrapper">
                    <!-- <div class="swiper-slide">
                      <img src="assets/img/real-estate/property-exterior-7.webp" class="img-fluid hero-image" alt="Property Main Image">
                      <div class="hero-overlay">
                        <div class="property-badge">
                          <span class="status-badge for-rent">Para </span>
                          <span class="featured-badge">Featured</span>
                        </div>
                        <button class="virtual-tour-btn">
                          <i class="bi bi-play-circle"></i>
                          Virtual Tour
                        </button>
                      </div>
                    </div> -->
                    <?php foreach ($imovel->imagens as $foto): ?>
                      <div class="swiper-slide">
                        <img src="<?=ADMIN_URL?>img/galeria/<?= $foto ?>"
                          class="img-fluid hero-image" alt="Interior View">

                      </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
              </div>

              <div class="thumbnail-gallery mt-3">
                <div class="property-thumbnails-slider swiper init-swiper">
                  <script type="application/json" class="swiper-config">
                    {
                      "loop": true,
                      "spaceBetween": 10,
                      "slidesPerView": 4,
                      "freeMode": true,
                      "watchSlidesProgress": true,
                      "breakpoints": {
                        "576": {
                          "slidesPerView": 5
                        },
                        "768": {
                          "slidesPerView": 6
                        }
                      }
                    }
                  </script>
                  <div class="swiper-wrapper">
                    <?php foreach ($imovel->imagens as $foto): ?>
                      <div class="swiper-slide">
                        <img src="<?=ADMIN_URL?>img/galeria/<?= $foto ?>"
                          class="img-fluid thumbnail-img" alt="Foto">

                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div><!-- End Property Hero -->

            <!-- Property Information -->
            <div class="property-info mb-5" data-aos="fade-up" data-aos-delay="300">
              <div class="property-header">
                <h1 class="property-title"><i class="bi bi-geo-alt"></i> <?= $imovel->morada; ?></span></h1>
                <div class="property-meta">
                </div>
              </div>

              <div class="pricing-section">
                <div class="main-price">€<?= preco_formatado($imovel->preco, $agente_servico) ?></div>
                <div class="price-breakdown">
                  <span class="available">Registrada no dia <?= Data_formatada($imovel->registro); ?> </span>
                </div>
              </div>

              <div class="quick-stats">
                <div class="stat-grid">
                  <div class="stat-card">
                    <div class="stat-icon">
                      <i class="bi bi-house"></i>
                    </div>
                    <div class="stat-content">
                      <span class="stat-number"><?= $imovel->tipologia; ?></span>
                      <span class="stat-label">Tipologia</span>
                    </div>
                  </div>
                  <div class="stat-card">
                    <div class="stat-icon">
                      <i class="bi bi-arrows-angle-expand"></i>
                    </div>
                    <div class="stat-content">
                      <span class="stat-number"><?= $imovel->area; ?></span>
                      <span class="stat-label">Espaço util(m²)</span>
                    </div>
                  </div>
                  <div class="stat-card">
                    <div class="stat-icon">
                      <i class="bi bi-car-front"></i>
                    </div>
                    <div class="stat-content">
                      <span class="stat-number"><?= $imovel->garagem; ?></span>
                      <span class="stat-label">Garagem</span>
                    </div>
                  </div>
                  <div class="stat-card">
                    <div class="stat-icon">
                      <i class="bi bi-map"></i>
                    </div>
                    <div class="stat-content">
                      <span class="stat-number"><?= $imovel->concelho; ?></span>
                      <span class="stat-label">Concelho</span>
                    </div>
                  </div>
                  <div class="stat-card">
                    <div class="stat-icon">
                      <i class="bi-geo-alt"></i>
                    </div>
                    <div class="stat-content">
                      <span class="stat-number"><?= $imovel->distrito; ?></span>
                      <span class="stat-label">Distrito</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Property Information -->

            <!-- Description & Features -->
            <div class="property-details mb-2" data-aos="fade-up" data-aos-delay="400">
              <h3>Descrição do imóvel</h3>
              <p><?= $imovel->comentario ?></p>
            </div><!-- End Description & Features -->

          </div>

          <!-- Sidebar -->
          <div class="col-lg-5">
            <div class="sticky-sidebar">
              <!-- Agent Card -->
              <div class="agent-card mb-4" data-aos="fade-up" data-aos-delay="350">
                <div class="agent-header">
                  <div class="agent-avatar">
                    <img src="<?=ADMIN_URL?>/img/agents/<?= $agente_imagem; ?>"
                      class="img-fluid" alt="Agent Photo">
                    <div class="online-status"></div>
                  </div>
                  <div class="agent-info">
                    <h4><?= $agente_nome; ?></h4>
                    <span class="agent-service">Especialista em <?= $agente_servico; ?></span>
                  </div>
                </div>

                <div class="agent-contact">
                  <div class="contact-item">
                    <i class="bi bi-telephone"></i>
                    <span><?= num_Formatado($agente_telemovel); ?></span>
                  </div>
                  <div class="contact-item">
                    <i class="bi bi-envelope"></i>
                    <span><?= $agente_email; ?></span>
                  </div>
                </div>
                <div class="agent-actions mt-3">
                  <form action="<?=BASE_URL?>agendamentos/A_service-details.php" method="POST">
                  <button class="btn btn-success btn-lg w-100 mb-3">
                    <i class="bi bi-calendar-check"></i>
                    Marcação de horário
                  </button>
                  <input type="hidden" name="idimovel" value="<?= $id_imovel; ?>">
                  </form>
                </div>
              </div><!-- End Agent Card -->
              <!-- Similar Properties -->

              <div class="similar-properties" data-aos="fade-up" data-aos-delay="650">
                  <h4>Propriedades similhares</h4>

              <?php
              $propriedades_similar = "SELECT i.Tipologia,i.Areautil,i.Estado,i.Preco,a.Servicos,i.Morada,i.Imagens, i.ID_Imoveis FROM imoveis i , agentes a WHERE i.Agentes_ID_Agentes=a.ID_Agentes AND a.ID_Agentes = $id_agente AND (a.Servicos = 'Vendas' OR a.Servicos = 'Arrendamento') AND i.ID_Imoveis != $id_imovel LIMIT 3;";
              $result_similar = mysqli_query($conn, $propriedades_similar);
              if (mysqli_num_rows($result_similar) > 0) {
                while ($row = mysqli_fetch_assoc($result_similar)) {
                  $ps_tipologia = $row["Tipologia"];
                  $ps_area = $row["Areautil"];
                  $ps_estado = $row["Estado"];
                  $ps_preco = $row["Preco"];
                  $ps_servico = $row["Servicos"];
                  $ps_morada = $row["Morada"];
                  $ps_imagem = $row["Imagens"];
                  $ps_idimovel = $row["ID_Imoveis"];

                  
                  ?>
                  
                  <div class="similar-property-item" onclick="window.location.href='<?=BASE_URL?>agentes/A_agente_property-details.php?id=<?= $ps_idimovel; ?>'">
                  <img src="<?=ADMIN_URL?>img/principal/<?= $ps_imagem ?>" class="img-fluid" alt="Similar Property">
                  <div class="similar-info">
                    <h6><?= $ps_morada; ?></h6>
                    <p class="similar-price"><?= preco_formatado($ps_preco, $ps_servico) ?></p>
                    <p class="similar-specs"><?= $ps_tipologia ?> • <?= $ps_estado ?> • <?= $ps_area; ?> m²</p>
                  </div>
                </div>
                <!-- End Similar Properties -->
                      <?php
                }
              } else {
                echo "Nenhuma propriedades similar encontrada.";
              }
              ?>        
              </div>
            </div>
          </div><!-- End Sidebar -->
        </div>
      </div>
    </section><!-- /Property Details Section -->
  </main>
  <?php include("../reutilizaveis/footer.php"); ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>