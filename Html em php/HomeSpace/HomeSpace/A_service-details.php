<?php
session_start();

// se NÃO estiver autenticado, redireciona com parâmetro especial
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
  header("Location: 404.php?erro=login_required");
  exit();
}


include("Funcoes_util.php");
include("conexao.php");
require_once("assets/class/comentario.php");

$Id_imovel = $_POST["idimovel"];

$sql_imoveis = "SELECT * FROM imoveis WHERE ID_Imoveis=$Id_imovel;";
$result_imovel = mysqli_query($conn, $sql_imoveis);
if (mysqli_num_rows($result_imovel) > 0) {
  while ($row = mysqli_fetch_assoc($result_imovel)) {
    $Morada = $row["Morada"];
    $Imagens = $row["Imagens"];
    $comentario = $row["Comentariosderaridade"];
    $id_agente = $row["Agentes_ID_Agentes"];
  }
} else {
  echo "Nenhum dado foi encontrado.";
}

$comentarios = new Comentarios(null, null, null);
$resultado = $comentarios->listarComentarioVisita($conn,$Id_imovel);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Agendamento</title>
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

<body class="service-details-page">

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
        <h1 class="mb-2 mb-lg-0">Agendamento</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Menu principal</a></li>
            <li class="current">Agendamento</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-8">
            <div class="service-content">
              <div class="service-hero" data-aos="fade-up" data-aos-delay="150">
                <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/principal/<?= $Imagens ?>"
                  alt="Property Sales Service" class="img-fluid rounded">
                <div class="service-badge">
                  <i class="bi bi-house-door"></i>
                  <?= $Morada; ?>
                </div>
              </div>

              <div class="service-overview" data-aos="fade-up" data-aos-delay="200">
                <h2>Comentário sobre a propriedade</h2>
                <p class="lead"><?= $comentario; ?></p>


              </div>

              <div class="service-features" data-aos="fade-up" data-aos-delay="250">
                <h3>O que está incluído</h3>
                <div class="row g-4">
                  <div class="col-md-6">
                    <div class="feature-item">
                      <div class="feature-icon">
                        <i class="bi bi-search"></i>
                      </div>
                      <div class="feature-content">
                        <h5>Market Analysis</h5>
                        <p>Comprehensive market research and competitive pricing analysis for optimal property
                          positioning.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="feature-item">
                      <div class="feature-icon">
                        <i class="bi bi-camera"></i>
                      </div>
                      <div class="feature-content">
                        <h5>Professional Photography</h5>
                        <p>High-quality photos and virtual tours to showcase your property in the best light.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="feature-item">
                      <div class="feature-icon">
                        <i class="bi bi-megaphone"></i>
                      </div>
                      <div class="feature-content">
                        <h5>Marketing Campaign</h5>
                        <p>Multi-channel marketing strategy including online listings, social media, and print
                          advertising.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="feature-item">
                      <div class="feature-icon">
                        <i class="bi bi-handshake"></i>
                      </div>
                      <div class="feature-content">
                        <h5>Negotiation Support</h5>
                        <p>Expert negotiation to secure the best possible price and terms for your property sale.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="service-process" data-aos="fade-up" data-aos-delay="300">
                <h3>Our Process</h3>
                <div class="process-steps">
                  <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                      <h5>Initial Consultation</h5>
                      <p>We meet to discuss your goals, timeline, and property details to create a customized selling
                        strategy.</p>
                    </div>
                  </div>
                  <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                      <h5>Property Preparation</h5>
                      <p>Professional staging advice, photography, and marketing materials preparation for maximum
                        appeal.</p>
                    </div>
                  </div>
                  <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                      <h5>Market Launch</h5>
                      <p>Strategic listing across multiple platforms with targeted marketing to reach qualified buyers.
                      </p>
                    </div>
                  </div>
                  <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                      <h5>Closing Support</h5>
                      <p>Full support through negotiations, inspections, and closing to ensure a smooth transaction.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="service-stats" data-aos="fade-up" data-aos-delay="350">
                <h3>Our Track Record</h3>
                <div class="row g-4">
                  <div class="col-md-3 col-6">
                    <div class="stat-item">
                      <div class="stat-number">
                        <span data-purecounter-start="0" data-purecounter-end="847" data-purecounter-duration="2"
                          class="purecounter"></span>
                      </div>
                      <div class="stat-label">Properties Sold</div>
                    </div>
                  </div>
                  <div class="col-md-3 col-6">
                    <div class="stat-item">
                      <div class="stat-number">
                        <span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="2"
                          class="purecounter"></span>%
                      </div>
                      <div class="stat-label">Success Rate</div>
                    </div>
                  </div>
                  <div class="col-md-3 col-6">
                    <div class="stat-item">
                      <div class="stat-number">
                        <span data-purecounter-start="0" data-purecounter-end="23" data-purecounter-duration="2"
                          class="purecounter"></span>
                      </div>
                      <div class="stat-label">Days Average</div>
                    </div>
                  </div>
                  <div class="col-md-3 col-6">
                    <div class="stat-item">
                      <div class="stat-number">
                        <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="2"
                          class="purecounter"></span>
                      </div>
                      <div class="stat-label">Years Experience</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="sidebar">
              <div class="contact-form-widget" data-aos="fade-up" data-aos-delay="200">
                <h4>Agendamento de horário</h4>

                <form action="forms/contact.php" method="post" class="php-email-form">

                  <!-- Id do agente -->
                   <input type="hidden" name="id_agente" value="Agentes_ID_Agentes">

                  <!-- Id do imovel -->
                   <input type="hidden" name="" value="">

                  <!-- data de registro -->
                  <div class="col-12 mt-3">
                    <label for="inputData" class="form-label">Data de visita</label>
                    <input type="date" class="form-control" id="inputData" name="dataDeRegistro" required>
                  </div>

                  <!-- Hora atual -->
                  <div class="col-12 mt-3">
                    <label for="inputHora" class="form-label">Hora inícial</label>
                    <select name="horaDeRegistro" id="inputHora" class="form-control">
                      <?php
                      $inicio_dia = strtotime('08:00');
                      $fim_dia = strtotime('18:30');

                      $inicio_almoco = strtotime('13:00');
                      $fim_almoco = strtotime('14:30');

                      for ($i = $inicio_dia; $i <= $fim_dia; $i += 600) {
                        $tempo = date('H:i', $i);

                        // Lógica da Dica de Ouro:
                        // Se estiver entre 13:01 e 14:29, adiciona o atributo 'disabled'
                        $esta_no_almoco = ($i >= $inicio_almoco && $i < $fim_almoco);
                        $status = $esta_no_almoco ? "disabled style='color: #ccc;'" : "";
                        $label = $esta_no_almoco ? "$tempo (Almoço)" : $tempo;
                        ?>

                        <option value="<?= $tempo; ?>" <?= $status; ?>> <?= $label; ?> </option>
                        <?php
                      }
                      ?>

                    </select>
                  </div>


                  <input type="hidden" name="subject" value="Consultation Request">
                  <div class="row gy-3">
                    <div class="col-12 mt-3">
                      <div class="loading">Loading</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Your message has been sent. Thank you!</div>
                      <button type="submit" class="btn btn-primary w-100">Realizar o registro</button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="quick-info-widget" data-aos="fade-up" data-aos-delay="250">
                <h4>Quick Facts</h4>
                <ul class="info-list">
                  <li>
                    <i class="bi bi-clock"></i>
                    <span>Free Initial Consultation</span>
                  </li>
                  <li>
                    <i class="bi bi-shield-check"></i>
                    <span>Licensed &amp; Insured</span>
                  </li>
                  <li>
                    <i class="bi bi-award"></i>
                    <span>Award-Winning Team</span>
                  </li>
                  <li>
                    <i class="bi bi-graph-up"></i>
                    <span>Above Market Results</span>
                  </li>
                  <li>
                    <i class="bi bi-headset"></i>
                    <span>24/7 Support</span>
                  </li>
                </ul>
              </div>

              <div class="testimonial-widget" data-aos="fade-up" data-aos-delay="300">
                <h4>Comentários</h4>
                <div class="testimonial-item">
                  <?php while($row = $resultado->fetch_assoc()){ ?>
                  <div class="testimonial-content">
                    <p>"<?= $row["comentarios"]?>"</p>
                  </div>
                  <div class="testimonial-author">
                    <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/utilizador/<?= $row["Imagem"] ?>" alt="Foto Perfil" class="rounded-circle">
                    <div class="author-info mb-4">
                      <h6><?= $row["Nome"] ?></h6>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>

              <div class="related-services-widget" data-aos="fade-up" data-aos-delay="350">
                <h4>Related Services</h4>
                <div class="service-links">
                  <a href="#" class="service-link">
                    <i class="bi bi-house-add"></i>
                    <span>Property Buying</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                  <a href="#" class="service-link">
                    <i class="bi bi-calculator"></i>
                    <span>Property Valuation</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                  <a href="#" class="service-link">
                    <i class="bi bi-key"></i>
                    <span>Property Management</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                  <a href="#" class="service-link">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Investment Consulting</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Service Details Section -->

  </main>

  <footer id="footer" class="footer accent-background">

    <?php include("footer.php"); ?>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Para o AJAX , seleciona o imóvel de acordo com a escolha do agente  -->
  <script>
    $(document).ready(function () {
      // 1. QUANDO MUDAR O AGENTE
      $('#inputAgentes').change(function () {
        var id_agente = $(this).val();
        $('#inputImovel').html('<option value="">Carregando imóveis...</option>');
        $('#inputData').val('');
        resetarHorarios();

        if (id_agente != "") {
          $.ajax({
            url: "D_ajax_getImoveis.php",
            type: "POST",
            data: { id_agente: id_agente },
            success: function (data) {
              $('#inputImovel').html(data);
            }
          });
        } else {
          $('#inputImovel').html('<option value="">Selecione o agente...</option>');
        }
      });

      // 2. QUANDO MUDAR IMÓVEL OU DATA
      $('#inputImovel, #inputData').change(function () {
        verificarDisponibilidade();
      });

      function verificarDisponibilidade() {
        var id_agente = $('#inputAgentes').val();
        var id_imovel = $('#inputImovel').val();
        var data_visita = $('#inputData').val();

        if (id_agente && id_imovel && data_visita) {
          $('#inputHora').prop('disabled', true);

          $.ajax({
            url: "D_ajax_verificarDisponibilidade.php",
            type: "POST",
            dataType: "json",
            data: {
              id_agente: id_agente,
              id_imovel: id_imovel,
              data_visita: data_visita
            },
            success: function (response) {
              $('#inputHora').prop('disabled', false);
              resetarHorarios();

              var duracaoNova = parseInt(response.nova_duracao);
              var ocupados = response.ocupados;
              var valorSelecionadoNoMomento = $('#inputHora').val();

              // Definição dos limites em minutos
              var minAlmoco = 13 * 60;        // 13:00 = 780 minutos
              var minFimDia = 18 * 60 + 30;   // 18:30 = 1110 minutos

              $('#inputHora option').each(function () {
                var option = $(this);
                var horaTexto = option.val();
                if (!horaTexto) return;

                var minNovoInicio = timeToMinutes(horaTexto);
                var minNovoFim = minNovoInicio + duracaoNova;

                var colidiu = false;

                // 1. REFINAMENTO: Bloqueio por limites de horário (Almoço e Fim do Dia)
                // Se começa antes das 13h mas termina depois das 13h...
                if (minNovoInicio < minAlmoco && minNovoFim > minAlmoco) {
                  colidiu = true;
                }
                // Se o fim da visita passa das 18:30...
                if (minNovoFim > minFimDia) {
                  colidiu = true;
                }

                // 2. Verificação de colisões com outras visitas (se ainda não colidiu nos limites)
                if (!colidiu) {
                  for (var i = 0; i < ocupados.length; i++) {
                    var horaBanco = ocupados[i].inicio.split(' ')[1].substring(0, 5);
                    var minOcupInicio = timeToMinutes(horaBanco);
                    var minOcupFim = minOcupInicio + parseInt(ocupados[i].duracao);

                    if (minNovoInicio < minOcupFim && minNovoFim > minOcupInicio) {
                      colidiu = true;
                      break;
                    }
                  }
                }

                // Aplica o bloqueio visual e funcional
                if (colidiu) {
                  option.hide().prop('disabled', true);
                  if (valorSelecionadoNoMomento === horaTexto) {
                    $('#inputHora').val('');
                  }
                }
              });
            }
          });
        }
      }

      function resetarHorarios() {
        $('#inputHora option').each(function () {
          var txt = $(this).text();
          if (txt.indexOf("Almoço") === -1) {
            $(this).show().prop('disabled', false).text($(this).val());
          }
        });
      }

      function timeToMinutes(t) {
        var p = t.split(':');
        return (parseInt(p[0]) * 60) + parseInt(p[1]);
      }
    });
  </script>

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