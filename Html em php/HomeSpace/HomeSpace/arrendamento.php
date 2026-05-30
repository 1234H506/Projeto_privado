<?php
session_start();

$acao = $_POST['id_servico_arrendamento'] ?? $_GET['id_servico_arrendamento'] ?? '';
$pagina = $_POST['page'] ?? $_GET['page'] ?? 1;
$pagina = (int) $pagina;

if (empty($acao)) {
  // Opcional: redireciona se não vier nada
  header("Location: index.php");
  exit;
}


include("conexao.php");
include("Funcoes_util.php");

// Contagem de todos os imóveis 
$sql_global_imoveis = "SELECT COUNT(i.ID_Imoveis) as Contagem_de_imoveis FROM imoveis i , agentes a WHERE i.Agentes_ID_Agentes = a.ID_Agentes AND a.Servicos = '$acao' AND i.Disponibilidade = 1  ;";
$result_total_imoveis = mysqli_query($conn, $sql_global_imoveis);
if (mysqli_num_rows($result_total_imoveis) > 0) {
  while ($row = mysqli_fetch_assoc($result_total_imoveis)) {
    $Contagem_imoveis = $row["Contagem_de_imoveis"];
  }
}


// Paginação da página - número de foto por página
$imoveis_por_pagina = 6;
// Verifica se existe o número da página na URL (?page=)
// Se existir usa esse valor, senão define a página inicial como 1
$pagina = isset($_POST['page']) ? (int) $_POST['page'] : (isset($_GET['page']) ? (int) $_GET['page'] : 1);
// Verifica em qual página começar
$inicio = ($pagina - 1) * $imoveis_por_pagina;
// Quantas página seráo necessários , faz um divisão para descobrir
$total_paginas = ceil($Contagem_imoveis / $imoveis_por_pagina);



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Propriedades - HomeSpace </title>
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

<body class="properties-page">

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

      <?php include("navbar.php"); ?>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center"> 
        <h1 class="mb-2 mb-lg-0">Propriedades - <?= mb_convert_case($acao, MB_CASE_TITLE, "UTF-8") ?></h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Menu principal</a></li>
            <li class="current">Propriedades</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->



    <!-- Properties Section -->
    <section id="properties" class="properties section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="results-header mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="results-info">
                <!-- <h5>(números) propriedades encontradas</h5> -->
                <h5>Exibindo : <?= $Contagem_imoveis; ?> imóveis</h5>
              </div>
            </div>
          </div>
        </div>


        <div class="properties-container">

          <div class="properties-masonry view-masonry active" data-aos="fade-up" data-aos-delay="250">
            <div class="row g-4">

              <?php
              $sql = " SELECT COUNT(g.Fotos) as Fotos , a.Servicos , a.nome , a.NdeTelemovel ,  i.Freguesia , i.Morada, i.concelho , i.Distrito , i.Codigopostal , i.Areautil , i.Tipologia , i.ID_Imoveis , i.Tipodeimovel , i.Areautil , i.Preco , i.Imagens , i.Estado , a.Imagem FROM agentes a, galeria g, imoveis i WHERE i.Agentes_ID_Agentes = a.ID_Agentes AND i.ID_Imoveis = g.Imoveis_ID_Imoveis AND i.Disponibilidade = 1 AND a.Servicos = '$acao' GROUP BY i.ID_Imoveis LIMIT $inicio, $imoveis_por_pagina;";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {


                  $nomeAgente = $row["nome"];
                  $ContagemDeImagens = $row["Fotos"];
                  $Servico = $row["Servicos"];
                  $id_imoveis = $row["ID_Imoveis"];
                  $freguesia = $row["Freguesia"];
                  $morada = $row["Morada"];
                  $concelho = $row["concelho"];
                  $distrito = $row["Distrito"];
                  $codigopostal = $row["Codigopostal"];
                  $areautil = $row["Areautil"];
                  $tipologia = $row["Tipologia"];
                  $tipodeimovel = $row["Tipodeimovel"];
                  $preco = $row["Preco"];
                  $imagens = $row["Imagens"];
                  $Estado_do_imovel = $row["Estado"];
                  $numero = $row["NdeTelemovel"];
                  $Agente_servicos = $row["Servicos"];
                  $Imagem_agente = $row["Imagem"];


                  $Nr_formatado = num_Formatado($numero);


                  $preco_atual = preco_formatado($preco, $Agente_servicos);


                  ?>


                  <div class="col-lg-4 col-md-6">
                    <div class="property-item" style="cursor:pointer;"
                      onclick="window.location.href='A_agente_property-details.php?id=<?= $id_imoveis; ?>'">
                      <a class="property-link">
                        <div class="property-image-wrapper">
                          <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/principal/<?= $imagens ?>"
                            alt="Luxury Villa" class="img-fluid">
                          <div class="property-status">
                            <span class="status-badge sale">Para <?= $Servico; ?> </span>
                          </div>
                          <div class="property-actions">
                            <button class="action-btn favorite-btn" data-toggle="tooltip" title="Add to Favorites"
                              onclick="event.stopPropagation(); return false;">
                              <i class="bi bi-heart"></i>
                            </button>
                            <button class="action-btn share-btn" data-toggle="tooltip" title="Share Property"
                              onclick="event.stopPropagation(); return false;">
                              <i class="bi bi-share"></i>
                            </button>
                            <button class="action-btn gallery-btn" data-toggle="tooltip" title="View Gallery">
                              <i class="bi bi-images"></i>
                              <span class="gallery-count"><?= $ContagemDeImagens; ?></span>
                            </button>
                          </div>
                        </div>
                      </a>
                      <div class="property-details"><a class="property-link">
                          <div class="property-header">
                            <div class="property-price"><?= '€', $preco_atual; ?></div>
                            <div class="property-type"><?= $tipodeimovel; ?></div>
                          </div>
                          <h4 class="property-title"></h4>
                          <p class="property-address">
                            <i class="bi bi-geo-alt"></i>
                            <?= $morada; ?>
                          </p>
                          <div class="property-specs">
                            <div class="spec-item">
                              <i class="bi bi-house-door"></i>
                              <span><?= $tipologia; ?></span>
                            </div>
                            <div class="spec-item">
                              <i class="bi bi-bar-chart-line"></i>
                              <span><?= $Estado_do_imovel; ?></span>
                            </div>
                            <div class="spec-item">
                              <i class="bi bi-arrows-angle-expand"></i>
                              <span><?= $areautil; ?>m²</span>
                            </div>
                          </div>
                        </a>
                        <div class="property-agent-info d-flex align-items-center justify-content-between">
                          <a class="d-flex align-items-center ">
                            <div class="agent-avatar me-3">
                              <img
                                src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/agents/<?= $Imagem_agente; ?>"
                                alt="Agent" class="rounded-circle" width="48" height="48">
                            </div>
                            <div class="agent-details">
                              <strong><?= $nomeAgente; ?></strong>
                            </div>
                          </a>
                          <div class="agent-contact ms-3"><a class="property-link">
                            </a><a class="contact-btn" data-bs-toggle="tooltip" data-bs-placement="left"
                              data-bs-title="<?= $Nr_formatado ?>">
                              <i class="bi bi-telephone fs-5"></i>
                            </a>
                          </div>
                          <input type="hidden" value="<?= $id_imoveis; ?>" name="id_Imovel_Post">
                        </div>

                      </div>

                    </div>
                  </div><!-- End Property Item -->



                <?php } ?>
              </div>
            </div>
          </div>
          <?php
              }
              ?>


        <div>

          <nav class="pagination-wrapper mt-5" data-aos="fade-up" data-aos-delay="350">
            <nav class="pagination-wrapper mt-5" data-aos="fade-up" data-aos-delay="350">
              <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                  <div class="pagination-info">
                    <?php
                    $inicio_exibicao = $inicio + 1;
                    $fim_exibicao = min($inicio + $imoveis_por_pagina, $Contagem_imoveis);
                    ?>
                    <p>Exibindo <strong><?= $inicio_exibicao ?>-<?= $fim_exibicao ?></strong> de
                      <strong><?= $Contagem_imoveis ?></strong> propriedades
                    </p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <ul class="pagination justify-content-lg-end">
                    <?php if ($pagina > 1): ?>
                      <li class="page-item">
                        <a class="page-link" href="?id_servico_arrendamento=<?= urlencode($acao) ?>&page=<?= $pagina - 1 ?>">
                          <i class="bi bi-chevron-left"></i>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                      <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="?id_servico_arrendamento=<?= urlencode($acao) ?>&page=<?= $i ?>">
                          <?= $i ?>
                        </a>
                      </li>
                    <?php endfor; ?>

                    <?php if ($pagina < $total_paginas): ?>
                      <li class="page-item">
                        <a class="page-link" href="?id_servico_arrendamento=<?= urlencode($acao) ?>&page=<?= $pagina + 1 ?>">
                          <i class="bi bi-chevron-right"></i>
                        </a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </nav>
          </nav>
        </div>
      </div>

    </section><!-- /Properties Section -->


  </main>

  <footer id="footer" class="footer accent-background">
    <?php include("footer.php"); ?>
  </footer>

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