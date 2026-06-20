<?php 
include("../config.php/base.php");
include("../reutilizaveis/conexao.php");
include("../assets/class/exibir_agentes.php");
include("../reutilizaveis/Funcoes_util.php");
$Id_Agente = $_GET["id"];
$exibir_agente_unico = new Exibir_agentes("", "", "", "", "", "");
$resultado_agente_unico = $exibir_agente_unico->AgenteUnico($conn, $Id_Agente);
$Contagem_imoveis = $exibir_agente_unico->contagemDeImoveis($conn, $Id_Agente);
$Contagem_de_visitas = $exibir_agente_unico->contagemDeVisitasFeitas($conn,$Id_Agente);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Perfil do agente - HomeSpace  </title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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

<body class="agent-profile-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="<?=BASE_URL?>pagina/index.php" class="logo d-flex align-items-center">
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

      <?php include("../reutilizaveis/navbar.php"); ?>
    </div>
  </header>
  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Perfil do agente</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="../pagina/index.php">Menu Principal</a></li>
            <li class="current">Perfil do agente</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <?php if ($resultado_agente_unico && $resultado_agente_unico->num_rows > 0){
      $row = $resultado_agente_unico->fetch_assoc(); ?>
    <!-- Agent Profile Section -->
    <section id="agent-profile" class="agent-profile section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Hero Profile Header -->
        <div class="row align-items-center mb-5">
          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="150">
            <div class="agent-photo-wrapper">
              <img src="../../administracao/img/agents/<?=$row['Imagem']?>" alt="Perfil do agente " class="img-fluid agent-photo">
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-left" data-aos-delay="200">
            <div class="agent-info">
              <h1 class="agent-name"><?= $row["nome"] ?></h1>

              <div class="contact-info-hero">
                <!-- <div class="contact-item">
                  <i class="bi bi-telephone-fill"></i>
                  <span><?= num_Formatado($row["NdeTelemovel"])?></span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-envelope-fill"></i>
                  <span><?= $row["Email"]?></span>
                </div> -->
                <div class="contact-item">
                  <i class="bi bi-geo-alt-fill"></i>
                  <span><?= $row["concelho"] ?></span>
                </div> 
              </div>

              <!-- <div class="hero-actions">
                <a href="#contact" class="btn btn-primary">Contact Me Now</a>
                <a href="#listings" class="btn btn-outline">View My Listings</a>
              </div> -->
            </div>
          </div>
        </div>

        <!-- Agent Stats -->
        <div class="stats-section" data-aos="fade-up" data-aos-delay="100">
          <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="stat-item">
                <div class="stat-icon">
                  <i class="bi bi-house-door-fill"></i>
                </div>
                <div class="stat-number"><?= $Contagem_imoveis; ?></div>
                <div class="stat-label">Imóveis Disponível</div>
              </div>
            </div>
             <div class="col-lg-3 col-md-6 mb-4">
              <div class="stat-item">
                <div class="stat-icon">
                  <i class="bi bi-calendar-check-fill"></i>
                </div>
                <div class="stat-number"><?= $Contagem_de_visitas; ?></div>
                <div class="stat-label">Visitas Realizadas</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="stat-item">
                <div class="stat-icon">
                  <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-number">200+</div>
                <div class="stat-label">Happy Clients</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="stat-item">
                <div class="stat-icon">
                  <i class="bi bi-trophy-fill"></i>
                </div>
                <div class="stat-number">Top 5%</div>
                <div class="stat-label">Nationwide</div>
              </div>
            </div> 
          </div>
        </div>

        <!-- Agent Bio & Specialties -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="150">
          <div class="col-lg-4 mb-4">
            <div class="sidebar-info">
              <div class="contact-card">
                <h4>Entre em Contato</h4>

                <div class="contact-details">
                  <div class="contact-detail">
                    <i class="bi bi-telephone"></i>
                    <div>
                      <strong>Telemóvel</strong>
                      <p><?= num_Formatado($row["NdeTelemovel"])?></p>
                    </div>
                  </div>
                  <div class="contact-detail">
                    <i class="bi bi-envelope"></i>
                    <div>
                      <strong>Email</strong>
                      <p><?= $row["Email"] ?></p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="specialties-card">
                <h4>Especialista em </h4>
                <div class="specialty-tags">
                  <span class="specialty-tag"><?= $row["Servicos"]?></span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
  <div class="bio-content">
    <h3 class="mb-4">Imóveis Disponíveis</h3>

    <div class="row" data-aos="fade-up" data-aos-delay="200">
      <?php
      // Usando a variável $Id_Agente que você definiu no topo do ficheiro
      // Removi o filtro de id_imovel pois aqui queremos mostrar todos os imóveis do agente
      $propriedades_agente = "SELECT i.Tipologia, i.Areautil, i.Estado, i.Preco, a.Servicos, i.Morada, i.Imagens, i.ID_Imoveis 
                             FROM imoveis i, agentes a 
                             WHERE i.Agentes_ID_Agentes = a.ID_Agentes 
                             AND a.ID_Agentes = $Id_Agente 
                            --  AND (a.Servicos = 'Vendas' OR a.Servicos = 'Arrendamento') 
                             ORDER BY i.ID_Imoveis DESC ";

      $result_agente = mysqli_query($conn, $propriedades_agente);

      if ($result_agente && mysqli_num_rows($result_agente) > 0) {
        while ($row_p = mysqli_fetch_assoc($result_agente)) {
          $p_tipologia = $row_p["Tipologia"];
          $p_area = $row_p["Areautil"];
          $p_estado = $row_p["Estado"];
          $p_preco = $row_p["Preco"];
          $p_servico = $row_p["Servicos"];
          $p_morada = $row_p["Morada"];
          $p_imagem = $row_p["Imagens"];
          $p_idimovel = $row_p["ID_Imoveis"];
      ?>
          <div class="col-md-4 mb-4">
            <div class="similar-property-item shadow-sm h-100" onclick="window.location.href='A_agente_property-details.php?id=<?= $p_idimovel; ?>'" style="cursor: pointer; border-radius: 10px; overflow: hidden; background: #fff;">
              <div style="height: 180px; overflow: hidden;">
                <img src="../../administracao/img/principal/<?= $p_imagem ?>" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Imóvel">
              </div>
              <div class="similar-info p-3">
                <h6 style="font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $p_morada; ?></h6>
                <p class="similar-price" style="color: #2eca6a; font-weight: bold; margin-bottom: 5px;">
                  €<?= preco_formatado($p_preco, $p_servico) ?>
                </p>
                <p class="similar-specs" style="font-size: 0.8rem; color: #777; margin-bottom: 0;">
                  <?= $p_tipologia ?> • <?= $p_area; ?> m²
                </p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<div class='col-12'><p class='text-muted'>Este agente ainda não possui imóveis listados.</p></div>";
      }
      ?>
    </div> </div>
</div>
        </div>
      </div>

    </section><!-- /Agent Profile Section -->

    <?php } ?>

  </main>


    <?php include("../reutilizaveis/footer.php")?> 


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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