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

date_default_timezone_set('Europe/Lisbon');

$Id_imovel = $_POST["idimovel"];
$Id_utilizador = $_SESSION["id"]; // Pegar o ID do usuário logado

// ==================== BUSCAR DADOS DO IMÓVEL ====================
$sql_imoveis = "SELECT * FROM imoveis WHERE ID_Imoveis=$Id_imovel;";
$result_imovel = mysqli_query($conn, $sql_imoveis);

$Morada = "";
$Imagens = "";
$comentario = "";
$id_agente = "";

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

// ==================== BUSCAR COMENTÁRIOS ====================
$comentarios = new Comentarios(null, null, null);
$resultado = $comentarios->listarComentarioVisita($conn, $Id_imovel);

// ==================== CALCULAR DATA MÍNIMA (AMANHÃ) ====================
$hoje = new DateTime('now', new DateTimeZone('Europe/Lisbon'));
$amanha = $hoje->add(new DateInterval('P1D'));
$data_minima = $amanha->format('Y-m-d');

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
</head>

<body class="service-details-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
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

        <div class="row justify-content-center">

          <div class="col-lg-4">
            <div class="sidebar">
              <div class="contact-form-widget" data-aos="fade-up" data-aos-delay="200">
                <h4>Agendamento de horário</h4>

                <!-- Card de sucesso - Inicialmente oculto -->
                <div id="cardSucesso" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                  <i class="bi bi-check-circle"></i> 
                  <strong>Sucesso!</strong> Seu agendamento foi realizado para <span id="dataSucesso"></span> às <span id="horaSucesso"></span>. Você receberá uma confirmação em breve.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <!-- Card de erro -->
                <div id="cardErro" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                  <i class="bi bi-exclamation-triangle"></i>
                  <strong>Erro:</strong> <span id="textoErro"></span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <!-- Formulário -->
                <form id="formAgendamento" class="php-email-form">

                  <!-- ID do imovel (hidden) -->
                  <input type="hidden" name="idimovel" value="<?= htmlspecialchars($Id_imovel) ?>">

                  <!-- ID do agente (hidden) -->
                  <input type="hidden" name="id_agente" value="<?= htmlspecialchars($id_agente) ?>">

                  <!-- Data de visita - mínimo amanhã -->
                  <div class="col-12 mt-3">
                    <label for="inputData" class="form-label">Data de visita</label>
                    <input type="date" class="form-control" id="inputData" name="dataDeRegistro" 
                           min="<?= $data_minima ?>" required>
                    <small class="text-muted">Selecione a partir de amanhã</small>
                  </div>

                  <!-- Hora - será preenchida dinamicamente -->
                  <div class="col-12 mt-3">
                    <label for="inputHora" class="form-label">Hora</label>
                    <select name="horaDeRegistro" id="inputHora" class="form-control" required disabled>
                      <option value="">Selecione a data primeiro</option>
                    </select>
                    <small class="text-muted" id="aviso-horarios">Selecione uma data para ver horários disponíveis</small>
                  </div>

                  <!-- Botão submit -->
                  <div class="row gy-3">
                    <div class="col-12 mt-3">
                      <button type="submit" class="btn btn-primary w-100" id="btnSubmit">Realizar o agendamento</button>
                    </div>
                  </div>
                </form>
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

  <!-- Vendor JS Files - jQuery PRIMEIRO! -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Script para carregar horários disponíveis e submeter formulário -->
  <script>
    $(document).ready(function () {
      
      // ==================== CARREGAR HORÁRIOS ====================
      $('#inputData').change(function () {
        var data_visita = $(this).val();
        var id_agente = $('input[name="id_agente"]').val();

        if (data_visita && id_agente) {
          $('#inputHora').prop('disabled', true).html('<option value="">Carregando horários...</option>');

          $.ajax({
            url: "forms/A_ajax_horarios_disponiveis.php",
            type: "POST",
            dataType: "json",
            data: {
              data_visita: data_visita,
              id_agente: id_agente
            },
            success: function (response) {
              if (response.sucesso && response.horarios && response.horarios.length > 0) {
                var opcoes = '<option value="">Selecione um horário</option>';
                response.horarios.forEach(function (hora) {
                  opcoes += '<option value="' + hora + '">' + hora + '</option>';
                });
                $('#inputHora').html(opcoes).prop('disabled', false);
                $('#aviso-horarios').text('Selecione um horário disponível (' + response.horarios.length + ' opções)').removeClass('text-danger').addClass('text-success');
              } else {
                $('#inputHora').html('<option value="">Sem horários disponíveis</option>').prop('disabled', true);
                $('#aviso-horarios').text('Nenhum horário disponível para esta data').removeClass('text-success').addClass('text-danger');
              }
            },
            error: function () {
              $('#inputHora').html('<option value="">Erro ao carregar horários</option>').prop('disabled', true);
              $('#aviso-horarios').text('Erro ao verificar disponibilidade').removeClass('text-success').addClass('text-danger');
            }
          });
        } else {
          $('#inputHora').html('<option value="">Selecione a data primeiro</option>').prop('disabled', true);
        }
      });

      // ==================== SUBMETER FORMULÁRIO VIA AJAX ====================
      $('#formAgendamento').submit(function (e) {
        e.preventDefault();

        var idimovel = $('input[name="idimovel"]').val();
        var id_agente = $('input[name="id_agente"]').val();
        var dataDeRegistro = $('input[name="dataDeRegistro"]').val();
        var horaDeRegistro = $('select[name="horaDeRegistro"]').val();

        // Validar
        if (!dataDeRegistro || !horaDeRegistro) {
          $('#cardErro').show();
          $('#textoErro').text('Selecione a data e hora');
          return;
        }

        // Desabilitar botão
        $('#btnSubmit').prop('disabled', true).text('Processando...');

        // Enviar via AJAX
        $.ajax({
          url: 'forms/A_processar_agendamento.php',
          type: 'POST',
          dataType: 'json',
          data: {
            idimovel: idimovel,
            id_agente: id_agente,
            dataDeRegistro: dataDeRegistro,
            horaDeRegistro: horaDeRegistro
          },
          success: function (response) {
            if (response.sucesso) {
              // Sucesso!
              $('#formAgendamento').hide();
              $('#cardErro').hide();
              
              // Formatar data
              var data = new Date(response.data + 'T00:00:00');
              var dataFormatada = data.toLocaleDateString('pt-BR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
              
              $('#dataSucesso').text(dataFormatada);
              $('#horaSucesso').text(response.hora);
              $('#cardSucesso').show();
            } else {
              // Erro
              $('#cardErro').show();
              $('#textoErro').text(response.erro || 'Erro ao realizar agendamento');
              $('#btnSubmit').prop('disabled', false).text('Realizar o agendamento');
            }
          },
          error: function (xhr) {
            var erro = 'Erro ao processar agendamento';
            try {
              var response = JSON.parse(xhr.responseText);
              erro = response.erro || erro;
            } catch(e) {}
            
            $('#cardErro').show();
            $('#textoErro').text(erro);
            $('#btnSubmit').prop('disabled', false).text('Realizar o agendamento');
          }
        });
      });
    });
  </script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>