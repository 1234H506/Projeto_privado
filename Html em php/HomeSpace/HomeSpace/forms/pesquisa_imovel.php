<?php
session_start();
include("../conexao.php");
include("../Funcoes_util.php");

$local = $_POST["location"];
$tipo_propriedades = $_POST["property_type"];
$price = $_POST["price_range"];
$tipologia = $_POST["tipologia"];


// Contagem de todos os imóveis 
$sql_global_imoveis = "SELECT COUNT(ID_Imoveis) as Contagem_de_imoveis FROM imoveis WHERE Disponibilidade = 1 AND Morada = '$local' OR Tipodeimovel = '$tipo_propriedades' OR Preco = '$price' OR Tipologia = '$tipologia' ";
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
$pagina = isset($_POST['page']) ? (int) $_POST['page'] : 1;
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

<body class="properties-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="../index.php" class="logo d-flex align-items-center">
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
                        <path d="M20 9.5V13.5M20 22V17.5" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path
                            d="M15 22V17C15 15.5858 15 14.8787 14.5607 14.4393C14.1213 14 13.4142 14 12 14C10.5858 14 9.87868 14 9.43934 14.4393M9 22V17"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path
                            d="M14 9.5C14 10.6046 13.1046 11.5 12 11.5C10.8954 11.5 10 10.6046 10 9.5C10 8.39543 10.8954 7.5 12 7.5C13.1046 7.5 14 8.39543 14 9.5Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                    </g>
                </svg>
                <h1 class="sitename">HomeSpace</h1>
            </a>

            <style>
  .hide-caret::after {
    display: none !important;
  }

  /* Hover bonito nos links (igual o sentimento do login) */
  a[style*="border-radius: 10px"]:hover {
    background-color: #f8f9fa !important;
    padding-left: 20px !important;
    color: #2d405f !important;
  }
</style>


<nav id="navmenu" class="navmenu">
  <ul>
    <!--<li><a href="about.html">Sobre nós</a></li>-->
    <li><a href="../properties.php">Propriedades</a></li>
    <li><a href="../services.php">Serviços</a></li>
    <li><a href="../A_agents.php">Agentes</a></li>
    <li><a href="../contact.php">Contacto</a></li>

    <?php if (isset($_SESSION["id"])) {

      $id_utilizador = $_SESSION["id"];

      $stmt = $conn->prepare("SELECT * FROM utilizador WHERE ID_Utilizador = ?");
      $stmt->bind_param("i", $id_utilizador);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

    ?>


      <li class="dropdown">
        <!-- TRIGGER (foto + nome/email) - mesmo estilo do "Login" -->
        <a href="#"
          class="dropdown-toggle hide-caret d-flex align-items-center text-decoration-none"
          data-bs-toggle="dropdown"
          data-bs-auto-close="outside">

          <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/utilizador/<?= ($row['Imagem']) ?>"
            class="rounded-circle me-2"
            style="width: 38px; height: 38px; object-fit: cover; border: 2px solid #2eca6a;">

          <div class="d-flex flex-column" style="line-height: 1.1;">
            <span class="fw-bold" style="color: #2d405f; font-size: 0.95rem;">
              <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Usuário'); ?>
            </span>
            <span class="small text-muted"><?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></span>
          </div>

          <i class="bi bi-chevron-down ms-auto text-muted"></i>
        </a>

        <!-- DROPDOWN MENU - EXATAMENTE o mesmo do seu login -->
        <div class="dropdown-menu dropdown-menu-end shadow border-0 p-4"
          style="min-width: 360px; border-radius: 15px;">

          <div class="text-center mb-4">
            <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/utilizador/<?= ($row['Imagem']) ?>"
              class="rounded-circle mb-3"
              style="width: 90px; height: 90px; object-fit: cover; border: 4px solid #2eca6a;">

            <h4 style="font-family: 'Montserrat', sans-serif; font-weight: 700; color: #2d405f;">
              <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Usuário'); ?>
            </h4>
            <p class="text-muted small"><?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></p>
          </div>

          <div class="dropdown-divider my-3"></div>

          <!-- Links de ações (mesmo visual clean do login) -->
          <a href="../perfil.php" class="d-flex align-items-center py-3 px-3 text-decoration-none text-dark" style="border-radius: 10px;">
            <i class="bi bi-person me-3 text-success fs-5"></i>
            <span class="fw-medium">Meu Dados</span>
          </a>
          <a href="../meus_imoveis.php" class="d-flex align-items-center py-3 px-3 text-decoration-none text-dark" style="border-radius: 10px;">
            <i class="bi bi-house-door me-3 text-success fs-5"></i>
            <span class="fw-medium">Minhas Ações</span>
          </a>

          <div class="dropdown-divider my-3"></div>

          <!-- Botão Logout (estilo semelhante ao botão "Entrar") -->
          <form action="/administracao1/startbootstrap-sb-admin-2-gh-pages/E_logout.php" method="POST">
            <button type="submit"
              class="btn w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2"
              style="background-color: #dc3545; color: white; border-radius: 8px; border: none; transition: 0.3s;">
              <i class="bi bi-box-arrow-right"></i>
              Sair da Conta
            </button>
          </form>
        </div>
      </li>


    <?php } else {  ?>


      <li class="dropdown">
        <a href="#" class="dropdown-toggle hide-caret d-flex align-items-center text-decoration-none"
          data-bs-toggle="dropdown" data-bs-auto-close="outside">
          <span class="me-2">Login</span>
          <i class="bi bi-person-circle fs-4"></i>
        </a>

        <style>
          .hide-caret::after {
            display: none !important;
          }

          /* Ajuste opcional para a cor do link de login não ficar azul padrão */
          .dropdown-toggle {
            color: #2d405f;
          }
        </style>

        <div class="dropdown-menu dropdown-menu-end shadow border-0 p-4" style="min-width: 360px; border-radius: 15px;">

          <div class="text-center mb-4">
            <h4 style="font-family: 'Montserrat', sans-serif; font-weight: 700; color: #2d405f;">Bem-vindo de volta</h4>
            <p class="text-muted small">Acesse sua conta para gerenciar imóveis</p>
          </div>

          <form action="../consul_login.php" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label small fw-bold" style="color: #2d405f;">Email</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-success"></i></span>
                <input type="email" class="form-control bg-light border-start-0" id="email" name="Email_Usuario"
                  placeholder="nome@exemplo.com" required style="font-size: 0.9rem;">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold" style="color: #2d405f;">Senha</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                  <i class="bi bi-lock text-success"></i>
                </span>

                <input type="password" class="form-control bg-light border-start-0 border-end-0" id="form3Example3cg"
                  name="Senha_Usuario" placeholder="Sua senha" required>

                <span class="input-group-text bg-light border-start-0" style="cursor: pointer;" onclick="mostrarSenha('form3Example3cg', 'btn-senha')">
                  <i class="bi bi-eye" id="btn-senha"></i>
                </span>
              </div>
            </div>

            <button type="submit" class="btn btn-success w-100 py-2 fw-bold"
              style="background-color: #2eca6a; border-color: #2eca6a; border-radius: 8px; transition: 0.3s;">
              <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
            </button>
          </form>

          <div class="dropdown-divider my-4"></div>

          <div class="text-center">
            <p class="mb-1 small text-muted">Não tem uma conta?</p>
            <a class="fw-bold text-success text-decoration-none d-inline-block" href="../cadastro.php">Criar conta agora</a>
            <p class="mb-1 small text-muted">Esqueceu sua senha? Não se preocupe!</p>
            <a class="fw-bold text-success text-decoration-none d-inline-block" href="../redefinirSenha.php">Redefinir senha</a>
          </div>
        </div>
      </li>



    <?php } ?>

  </ul>
  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

</nav>

        </div>
    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Propriedades</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="../index.php">Menu principal</a></li>
                        <li class="current">Propriedades</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->



        <!-- Properties Section -->
        <section id="properties" class="properties section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <!-- <div class="search-bar mb-5" data-aos="fade-up" data-aos-delay="150">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="search-wrapper">
                                <div class="row g-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="search-field">
                                            <label>Localização</label>
                                            <input type="text" class="form-control" placeholder="Digite a morada"
                                                id="localizacao">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="search-field">
                                            <label>Tipo de imóvel</label>
                                            <select id="tipo" class="form-select">
                                                <option>Todos os tipos</option>
                                                <option value="Casa">Casas</option>
                                                <option value="Apartamento">Apartamentos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="search-field">
                                            <label>Tipo de ações</label>
                                            <select id="acao" class="form-select">
                                                <option>Todas as ações</option>
                                                <option value="Vendas">Compras de imóveis</option>
                                                <option value="Arrendamento">Aluguel de imóveis</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="search-field">
                                            <label>Preços</label>
                                            <select id="preco" class="form-select">
                                                <option>Qualquer preços</option>
                                                <option>€0 - €500k</option>
                                                <option>€500k - €1M</option>
                                                <option>€1M+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6">
                                        <div class="search-field">
                                            <label>Tipologia</label>
                                            <div class="bedroom-quick">
                                                <button class="bed-btn" data-beds="any">T0</button>
                                                <button class="bed-btn" data-beds="T1">T1</button>
                                                <button class="bed-btn" data-beds="T2">T2</button>
                                                <button class="bed-btn" data-beds="T3">T3</button>
                                                <button class="bed-btn" data-beds="T4">T4</button>
                                                <button class="bed-btn" data-beds="T5">T5+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="search-field">
                                            <label>&nbsp;</label>
                                            <button id="Btn_de_filtragem" class="btn btn-primary w-100 search-btn">
                                                <i class="bi bi-search"></i> Procurar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="results-header mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="results-info">
                                <!-- <h5>(números) propriedades encontradas</h5> -->
                                <h5>Exibindo : <?= $Contagem_imoveis; ?> imóveis</h5>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
                            <div class="results-controls">
                                <div class="d-flex gap-3 align-items-center justify-content-lg-end">
                                    <div class="sort-dropdown">
                                        <select class="form-select form-select-sm">
                                            <option>Preço : Menor para maior</option>
                                            <option>Preço : Menor para maior</option>
                                            <option>Preço : Maior para menor</option>
                                            <option>Por ordem de listagem : Recentes para antigos</option>
                                            <option>Por ordem de listagem : Recentes para antigos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>


                <div class="properties-container">

                    <div class="properties-masonry view-masonry active" data-aos="fade-up" data-aos-delay="250">
                        <div class="row g-4">

                            <?php
                            $sql = " SELECT COUNT(g.Fotos) as Fotos , a.Servicos , a.nome , a.NdeTelemovel ,  i.Freguesia , i.Morada, i.concelho , i.Distrito , i.Codigopostal , i.Areautil , i.Tipologia , i.ID_Imoveis , i.Tipodeimovel , i.Areautil , i.Preco , i.Imagens , i.Estado , a.Imagem FROM agentes a, galeria g, imoveis i WHERE i.Agentes_ID_Agentes = a.ID_Agentes AND i.ID_Imoveis = g.Imoveis_ID_Imoveis AND i.Disponibilidade = 1 AND i.Morada = '$local' OR i.Tipodeimovel = '$tipo_propriedades' OR i.Preco = '$price' OR i.Tipologia = '$tipologia' GROUP BY i.ID_Imoveis LIMIT $inicio, $imoveis_por_pagina;";
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
                                            onclick="window.location.href='../A_agente_property-details.php?id=<?= $id_imoveis; ?>'">
                                            <a class="property-link">
                                                <div class="property-image-wrapper">
                                                    <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/principal/<?= $imagens ?>"
                                                        alt="Luxury Villa" class="img-fluid">
                                                    <div class="property-status">
                                                        <span class="status-badge sale">Para <?= $Servico; ?> </span>
                                                    </div>
                                                    <div class="property-actions">
                                                        <button class="action-btn favorite-btn" data-toggle="tooltip"
                                                            title="Add to Favorites"
                                                            onclick="event.stopPropagation(); return false;">
                                                            <i class="bi bi-heart"></i>
                                                        </button>
                                                        <button class="action-btn share-btn" data-toggle="tooltip"
                                                            title="Share Property"
                                                            onclick="event.stopPropagation(); return false;">
                                                            <i class="bi bi-share"></i>
                                                        </button>
                                                        <button class="action-btn gallery-btn" data-toggle="tooltip"
                                                            title="View Gallery">
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
                                                <div
                                                    class="property-agent-info d-flex align-items-center justify-content-between">
                                                    <a class="d-flex align-items-center ">
                                                        <div class="agent-avatar me-3">
                                                            <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/agents/<?= $Imagem_agente; ?>"
                                                                alt="Agent" class="rounded-circle" width="48" height="48">
                                                        </div>
                                                        <div class="agent-details">
                                                            <strong><?= $nomeAgente; ?></strong>
                                                        </div>
                                                    </a>
                                                    <div class="agent-contact ms-3"><a class="property-link">
                                                        </a><a class="contact-btn" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" data-bs-title="<?= $Nr_formatado ?>">
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
                                            <a class="page-link paginacao" data-page="<?= $pagina - 1 ?>">
                                                <i class="bi bi-chevron-left"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                        <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                                            <a class="page-link paginacao" data-page="<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($pagina < $total_paginas): ?>
                                        <li class="page-item">
                                            <a class="page-link paginacao" data-page="<?= $pagina + 1 ?>">
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

        </section><!-- /Properties Section -->
        </div>

    </main>


    <?php include("../footer.php"); ?>

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
    <script src="../assets/js/olhinho.js"></script>

</body>

</html>