<?php
session_start();
include("conexao.php");
include("Funcoes_util.php");
include("assets/class/visitas.php");

// se NÃO estiver autenticado, redireciona com parâmetro especial
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
  header("Location: 404.php?erro=login_required");
  exit();
}

$visitas = new Visitas($conn);
$id_utilizador = $_SESSION['id'];
$lista_visitas = $visitas->pending_visits($id_utilizador);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Perfil - HomeSpace Bootstrap</title>
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

<body class="agent-profile-page">

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

      <?php include("navbar.php") ?>
    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Perfil</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Menu Principal</a></li>
            <li class="current">Perfil</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Agent Profile Section -->
    <section id="agent-profile" class="agent-profile section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Hero Profile Header -->
        <div class="row align-items-center mb-5">
          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="150">
            <div class="agent-photo-wrapper">
              <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/utilizador/<?= ($row['Imagem']) ?>"
                alt="User Profile" class="img-fluid agent-photo">
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-left" data-aos-delay="200">
            <div class="agent-info">
              <h1 class="agent-name"><?= ucfirst($row['Nome']) ?></h1>

              <div class="contact-info-hero">
                <div class="contact-item">
                  <i class="bi bi-telephone-fill"></i>
                  <span><?= num_Formatado($row['nr_telemovel']) ?></span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-envelope-fill"></i>
                  <span><?= $row['Email'] ?></span>
                </div>
                <div class="contact-item">
                  <i class="bi <?= ($row['Sexo'] == 0) ? 'bi-gender-male' : 'bi-gender-female'; ?>"></i>
                  <span><?= ($row['Sexo'] == 0) ? "Masculino" : "Feminino"; ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>



        <!-- Agent Bio & Specialties -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="150">
          <div class="col-lg-4 mb-4">
            <div class="sidebar-info">
              <div class="contact-card">
                <h4>Contato</h4>

                <div class="contact-details">
                  <div class="contact-detail">
                    <i class="bi bi-telephone"></i>
                    <div>
                      <strong>Telemóvel</strong>
                      <p><?= num_Formatado($row['nr_telemovel']) ?></p>
                    </div>
                  </div>
                  <div class="contact-detail">
                    <i class="bi bi-envelope"></i>
                    <div>
                      <strong>Email</strong>
                      <p><?= $row['Email'] ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="bio-content">
              <h3>Visitas Pendentes</h3>
              <div class="row" data-aos="fade-up" data-aos-delay="200">

                <?php
                if (!empty($lista_visitas)) {

                  foreach ($lista_visitas as $visita) {
                    $id_visita = $visita['id_registro'];
                    $servico = $visita["Servicos"];
                    $morada = $visita["Morada"];
                    $tipologia = $visita["Tipologia"];
                    $area = $visita["Areautil"];
                    $preco = $visita["Preco"];
                    $imagem = $visita["Imagens"];
                    $id_imovel = $visita["ID_Imoveis"];
                    $data_visita = $visita["data"];
                    ?>
                    <div class="col-md-4 mb-4">
                      <div class="card-visita shadow-sm h-100" style="
          border-radius: 16px;
          overflow: hidden;
          background: #fff;
          display: flex;
          flex-direction: column;
          border: 1px solid #e8e8e8;
          transition: all 0.3s ease;
        " onmouseover="this.style.boxShadow='0 12px 24px rgba(0,0,0,0.12)'; this.style.transform='translateY(-4px)';"
                        onmouseout="this.style.boxShadow=''; this.style.transform='translateY(0)';">

                        <!-- Badge de Visita Marcada -->
                        <div
                          style="position: absolute; top: 12px; right: 12px; background: #2eca6a; color: #fff; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; z-index: 10; text-transform: uppercase;">
                          Pendente
                        </div>

                        <!-- Imagem com Overlay -->
                        <div style="height: 200px; overflow: hidden; position: relative; background: #f0f0f0;">
                          <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/principal/<?= $imagem ?>"
                            class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;"
                            onmouseover="this.style.transform='scale(1.08)';" onmouseout="this.style.transform='scale(1)';">
                        </div>

                        <!-- Corpo -->
                        <div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column; padding: 24px;">

                          <!-- Título e Morada -->
                          <h6
                            style="font-size: 1.15rem; font-weight: 700; color: #333; margin-bottom: 16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            📍 <?= $morada ?>
                          </h6>

                          <!-- Preço -->
                          <p style="color: #2eca6a; font-weight: 700; font-size: 1.35rem; margin-bottom: 16px;">
                            €<?= preco_formatado($preco,$servico)?>
                          </p>

                          <!-- Specs -->
                          <p style="font-size: 0.95rem; color: #666; margin-bottom: 20px; line-height: 1.6;">
                            <i class="fas fa-home" style="color: #2eca6a; margin-right: 6px;"></i><?= $tipologia ?> • <i
                              class="fas fa-ruler" style="color: #2eca6a; margin-right: 6px;"></i><?= $area ?> m²
                          </p>

                          <!-- Data da Visita -->
                          <div
                            style="background: #f8f9fa; padding: 16px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; border-left: 4px solid #2eca6a;">
                            <div style="font-weight: 800; color: #333; margin-bottom: 8px;">
                              <i class="fas fa-calendar-alt" style="color: #2eca6a; margin-right: 8px;"></i>Visita marcada
                            </div>
                            <span style="color: #555; font-size: 0.95rem;"><?= date("d/m/Y", strtotime($data_visita)) ?> às
                              <?= date("H:i", strtotime($data_visita)) ?></span>
                          </div>

                          <!-- Botões -->
                            <button type="button" class="btn btn-sm btn-primary flex-fill" data-bs-toggle='modal'
                            data-bs-target='#modalExcluir<?= $id_visita ?>' style="
                border-radius: 10px;
                transition: all 0.2s ease;
                position: relative;
                overflow: hidden;
                padding: 10px 16px;
              " onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 16px rgba(46, 202, 106, 0.25)';"
                              onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                              <i class="fas fa-heart" style="margin-right: 6px;"></i> Cancelar 
                            </button>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class='modal fade' id='modalExcluir<?= $id_visita  ?>' tabindex='-1' role='dialog'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title text-danger'>Cancelamento de registro de visita previamente agendada</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <strong>Atenção:</strong> esta ação é definitiva. <br>
                                Deseja realmente cancelar está visita? <?=  $id_visita ?> 
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                                <form action='A_confirm_delete_visit.php' method='post' class='d-inline'>
                                    <input type='hidden' name='id' value='<?php echo $id_visita  ?>'>
                                    <button type='submit' class='btn btn-danger'>Sim, remover</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
                  }

                } else {
                  echo "<div class='col-12'>
      <div style='text-align: center; padding: 60px 20px;'>
        <i class='fas fa-calendar-check' style='font-size: 3rem; color: #ddd; margin-bottom: 20px;'></i>
        <p style='color: #999; font-size: 1.1rem;'>Você ainda não possui visitas futuras marcadas.</p>
      </div>
    </div>";
                }
                ?>

              </div>

              <style>
                .btn-primary {
                  background-color: #2eca6a;
                  border-color: #2eca6a;
                  color: #fff;
                  font-weight: 600;
                }

                .btn-primary:hover {
                  background-color: #28a85f;
                  border-color: #28a85f;
                  color: #fff;
                }

                .btn-outline-secondary {
                  color: #666;
                  border: 1px solid #ddd;
                  font-weight: 600;
                }

                .btn-outline-secondary:hover {
                  background-color: #f8f9fa;
                  color: #333;
                  border-color: #999;
                }
              </style>

              <!-- Script para confirmar exclusão -->
              <script>
                function confirmarExcluir(id) {
                  if (confirm('Tem a certeza que deseja eliminar este imóvel? Esta ação não pode ser desfeita.')) {
                    // Redireciona para a página de exclusão com o ID do imóvel
                    window.location.href = 'A_confirm_delete_visit.php?id=' + id;
                  }
                }
              </script>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Agent Profile Section -->

  </main>

  <footer id="footer" class="footer accent-background">

    <?php include("footer.php") ?>

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

</body>

</html>