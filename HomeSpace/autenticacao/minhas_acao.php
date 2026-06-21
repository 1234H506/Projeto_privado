<?php
session_start();
include("../config.php/base.php");
include("../reutilizaveis/conexao.php");
include("../reutilizaveis/Funcoes_util.php");

$id_em_sessao = $_SESSION["id"];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Minha ações - HomeSpace </title>
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
</head>

<body class="property-details-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="../pagina/index.php" class="logo d-flex align-items-center">
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

            <?php include("../reutilizaveis/navbar.php"); ?>

        </div>
    </header>

    <main class="main">

        <!-- Property Details Section -->
        <section id="property-details" class="property-details section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="similar-properties" data-aos="fade-up" data-aos-delay="650">
    <h4 class="mb-4 border-bottom pb-2">Ações realizadas</h4>

    <div class="row g-4">
        <?php
        $acoes = "SELECT *
                    FROM utilizador_has_imoveis uhi
                    LEFT JOIN utilizador u ON uhi.Utilizador_ID_Utilizador = u.ID_Utilizador
                    LEFT JOIN imoveis i ON uhi.Imoveis_ID_Imoveis = i.ID_Imoveis
                    LEFT JOIN agentes a ON uhi.Agentes_ID_Agentes = a.ID_Agentes
                    WHERE u.ID_Utilizador = $id_em_sessao";
        $result_acoes = mysqli_query($conn, $acoes);

        if (mysqli_num_rows($result_acoes) > 0) {
            while ($row = mysqli_fetch_assoc($result_acoes)) {
                $ps_tipologia = $row["Tipologia"];
                $ps_area      = $row["Areautil"];
                $ps_estado    = $row["Estado"];
                $ps_preco     = $row["Preco"];
                $ps_servico   = $row["Servicos"];
                $ps_morada    = $row["Morada"];
                $ps_imagem    = $row["Imagens"];
                $ps_idimovel  = $row["ID_Imoveis"];
        ?>

        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0 property-card-custom" 
                 style="cursor: pointer; transition: transform 0.3s ease, shadow 0.3s ease; border-radius: 12px; overflow: hidden;"
                 onclick="window.location.href='../agentes/A_agente_property-details.php?id=<?= $ps_idimovel; ?>'">
                
                <div class="position-relative">
                    <img src="<?=ADMIN_URL?>img/principal/<?= $ps_imagem ?>" 
                         class="card-img-top" alt="Imóvel" 
                         style="height: 220px; object-fit: cover;">
                    <span class="badge bg-success position-absolute top-0 end-0 m-3 shadow-sm" style="font-weight: 500;">
                        <?= $ps_servico ?>
                    </span>
                </div>

                <div class="card-body d-flex flex-column">
                    <h6 class="card-title text-truncate mb-1" title="<?= $ps_morada; ?>">
                        <i class="bi bi-geo-alt text-danger me-1"></i><?= $ps_morada; ?>
                    </h6>
                    
                    <h5 class="fw-bold text-success mb-3">
                        <?= "€ " . preco_formatado($ps_preco, $ps_servico) ?>
                    </h5>

                    <div class="mt-auto pt-3 border-top">
                        <div class="d-flex justify-content-between text-muted small">
                            <span><i class="bi bi-house-door me-1"></i><?= $ps_tipologia ?></span>
                            <span><i class="bi bi-arrows-fullscreen me-1"></i><?= $ps_area; ?> m²</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            }
        } else {
            echo "<div class='col-12'><p class='alert alert-info'>Nenhuma ação encontrada no momento.</p></div>";
        }
        ?>
    </div></div>

                    </div>
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