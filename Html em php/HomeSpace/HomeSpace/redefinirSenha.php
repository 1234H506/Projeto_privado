<?php
session_start();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - HomeSpace</title>
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

<body>
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
    </div>
  </header>

  <div id="resultado">
  <section class=" bg-image full-screen-section " style="background-image: url('assets/img/blog/blog-hero-9.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-5">

                <div class="d-flex justify-content-center align-items-center mb-4">
                  <svg class="my-icon1 me-2" width="45" height="45" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="bgCarrier" stroke-width="0"></g>
                    <g id="tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="iconCarrier">
                      <path d="M22 22L2 22" stroke="#2eca6a" stroke-width="1.5" stroke-linecap="round"></path>
                      <path
                        d="M2 11L6.06296 7.74968M22 11L13.8741 4.49931C12.7784 3.62279 11.2216 3.62279 10.1259 4.49931L9.34398 5.12486"
                        stroke="#2eca6a" stroke-width="1.5" stroke-linecap="round"></path>
                      <path d="M15.5 5.5V3.5C15.5 3.22386 15.7239 3 16 3H18.5C18.7761 3 19 3.22386 19 3.5V8.5"
                        stroke="#2eca6a" stroke-width="1.5" stroke-linecap="round"></path>
                      <path d="M4 22V9.5" stroke="#2eca6a" stroke-width="1.5" stroke-linecap="round"></path>
                      <path d="M20 9.5V13.5M20 22V17.5" stroke="#2eca6a" stroke-width="1.5" stroke-linecap="round">
                      </path>
                      <path
                        d="M15 22V17C15 15.5858 15 14.8787 14.5607 14.4393C14.1213 14 13.4142 14 12 14C10.5858 14 9.87868 14 9.43934 14.4393M9 22V17"
                        stroke="#2eca6a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path
                        d="M14 9.5C14 10.6046 13.1046 11.5 12 11.5C10.8954 11.5 10 10.6046 10 9.5C10 8.39543 10.8954 7.5 12 7.5C13.1046 7.5 14 8.39543 14 9.5Z"
                        stroke="#2eca6a" stroke-width="1.5"></path>
                    </g>
                  </svg>
                  <h1 class="sitename m-0" style="color: #2eca6a; font-weight: 700;">HomeSpace</h1>
                </div>

                <div class="text-center px-3">
                  <h2 class="h4 fw-bold mb-2">Redefinir senha</h2>
                  <p class="text-muted small mb-4">
                    Não se preocupe, acontece com os melhores! <br>
                    Digite o e-mail cadastrado e enviaremos um link seguro para você redefinir sua senha.
                  </p>

                  <form action="forms/verificar_email.php" method="POST" class="text-start mx-auto" style="max-width: 350px;">
                    <div class="mb-3">
                      <label for="email" class="form-label small fw-bold">Seu E-mail</label>
                      <input type="email" name="email" class="form-control shadow-none border-secondary-subtle"
                        id="email" placeholder="exemplo@email.com" autocomplete="email" required>
                    </div>

                    <button id="btn_redefinir"  class="btn w-100 fw-bold text-white py-2 mb-3"
                      style="background-color: #2eca6a; border-color: #2eca6a;">
                      Confirmar e-mail
                    </button>

                    <div class="text-center">
                      <a href="index.php" class="text-decoration-none small text-muted">
                        <i class="bi bi-arrow-left"></i> Voltar para o <span class="fw-bold text-success">Login</span>
                      </a>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  </div>
  <script src="assets/js/olhinho.js"></script>
</body>

</html>