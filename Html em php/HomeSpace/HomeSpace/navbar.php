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
    <li><a href="properties.php">Propriedades</a></li>
    <li><a href="services.php">Serviços</a></li>
    <li><a href="A_agents.php">Agentes</a></li>
    <li><a href="contact.php">Contacto</a></li>

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
          <a href="perfil.php" class="d-flex align-items-center py-3 px-3 text-decoration-none text-dark" style="border-radius: 10px;">
            <i class="bi bi-person me-3 text-success fs-5"></i>
            <span class="fw-medium">Meu Dados</span>
          </a>
          <a href="meus_imoveis.php" class="d-flex align-items-center py-3 px-3 text-decoration-none text-dark" style="border-radius: 10px;">
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

          <form action="consul_login.php" method="POST">
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
            <a class="fw-bold text-success text-decoration-none d-inline-block" href="cadastro.php">Criar conta agora</a>
          </div>
        </div>
      </li>



    <?php } ?>

  </ul>
  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

</nav>