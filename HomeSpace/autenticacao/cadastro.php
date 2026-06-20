<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - HomeSpace</title>

  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">

  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  
  <style>
    /* Estilos customizados para alinhar com o design do Login */
    body { font-family: 'Roboto', sans-serif; }
    .bg-image { min-height: 100vh; background-size: cover; background-position: center; }
    .card { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    .form-label { color: #2d405f; font-size: 0.85rem; }
    .input-group-text { background-color: #f8f9fa; color: #2eca6a; border-right: none; }
    .form-control { background-color: #f8f9fa; font-size: 0.9rem; border-left: none; }
    .form-control:focus { box-shadow: none; border-color: #dee2e6; background-color: #fff; }
    .btn-register { background-color: #2eca6a; border-color: #2eca6a; color: white; transition: 0.3s; }
    .btn-register:hover { background-color: #25b35e; color: white; transform: translateY(-1px); }
  </style>
</head>

<body>
  <header id="header" class="header d-flex align-items-center sticky-top bg-white shadow-sm py-2">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="../pagina/index.php" class="logo d-flex align-items-center text-decoration-none" style="color: #2d405f;">
        <i class="bi bi-house-door-fill me-2 fs-3 text-success"></i>
        <h1 class="sitename m-0 fs-4 fw-bold">HomeSpace</h1>
      </a>
    </div>
  </header>

  <section class="bg-image py-5" style="background-image: url('../assets/img/real-estate/showcase-3.webp');">
    <div class="container">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-9 col-lg-7 col-xl-5">
          <div class="card">
            <div class="card-body p-4 p-md-5">
              
              <div class="text-center mb-4">
                <h4 style="font-family: 'Montserrat', sans-serif; font-weight: 700; color: #2d405f;">Crie sua conta</h4>
                <p class="text-muted small">Junte-se a nós para gerenciar seus imóveis</p>
              </div>

              <form action="../autenticacao/registro.php" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                  <label class="form-label fw-bold">Nome Completo</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" name="Nome_Usuario" placeholder="Ex: João Silva" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Email</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" name="Email_Usuario" placeholder="nome@exemplo.com" required>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Telemóvel</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-phone"></i></span>
                      <input type="text" class="form-control" name="Telemovel_Usuario" maxlength="9" placeholder="9xx..." required>
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Sexo</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                      <select class="form-select border-start-0 bg-light" name="Sexo_Usuario" style="font-size: 0.9rem;" required>
                        <option value="" selected disabled>Selecione</option>
                        <option value="0">Masculino</option>
                        <option value="1">Feminino</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Senha</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" id="form3Example4cg" class="form-control border-end-0" name="Senha_Usuario" placeholder="Sua senha" required>
                    <span class="input-group-text bg-light border-start-0" style="cursor: pointer;" onclick="mostrarSenha('form3Example4cg', 'eye1')">
                      <i class="bi bi-eye" id="eye1"></i>
                    </span>
                  </div>
                </div>

                <div class="mb-4">
                  <label class="form-label fw-bold">Confirmar Senha</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                    <input type="password" id="form3Example4cdg" class="form-control border-end-0" name="Repita_Senha_Usuario" placeholder="Repita a senha" required>
                    <span class="input-group-text bg-light border-start-0" style="cursor: pointer;" onclick="mostrarSenha('form3Example4cdg', 'eye2')">
                      <i class="bi bi-eye" id="eye2"></i>
                    </span>
                  </div>
                </div>

                <button type="submit" class="btn btn-register w-100 py-2 fw-bold rounded-3">
                  <i class="bi bi-check-circle me-2"></i>Finalizar Cadastro
                </button>

                <div class="dropdown-divider my-4"></div>

                <p class="text-center small text-muted">
                  Já tem uma conta? <a href="index.php" class="fw-bold text-success text-decoration-none">Faça login aqui</a>
                </p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="../assets/js/olhinho.js"></script>
</body>
</html>