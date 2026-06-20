<?php
include("../reutilizaveis/conexao.php");
include("../reutilizaveis/Funcoes_util.php");
include("../config.php/base.php");

// ==================== RECEBE POST ====================
$local      = $_POST['localizacao'] ?? '';
$tipo       = $_POST['tipo'] ?? 'Todos os tipos';
$acao       = $_POST['acao'] ?? 'Todas as ações';
$tipologia  = $_POST['tipologia'] ?? 'any';
$pagina     = isset($_POST['page']) ? (int)$_POST['page'] : 1;

// ==================== MONTA WHERE DINÂMICO ====================
$where_clauses = ["i.Disponibilidade = 1"];

if (!empty(trim($local))) {
    $esc_local = mysqli_real_escape_string($conn, trim($local));
    $where_clauses[] = "i.Morada LIKE '%$esc_local%'";
}
if ($tipo !== "Todos os tipos") {
    $esc_tipo = mysqli_real_escape_string($conn, $tipo);
    $where_clauses[] = "i.Tipodeimovel = '$esc_tipo'";
}
if ($acao !== "Todas as ações") {
    $esc_acao = mysqli_real_escape_string($conn, $acao);
    $where_clauses[] = "a.Servicos = '$esc_acao'";
}
if ($tipologia !== "any") {
    $esc_tip = mysqli_real_escape_string($conn, $tipologia);
    $where_clauses[] = "i.Tipologia = '$esc_tip'";
}

$where = implode(" AND ", $where_clauses);

// ==================== CONTAGEM TOTAL ====================
$sql_count = "SELECT COUNT(i.ID_Imoveis) as Contagem_de_imoveis 
              FROM imoveis i 
              JOIN agentes a ON i.Agentes_ID_Agentes = a.ID_Agentes 
              WHERE $where";
$result_total = mysqli_query($conn, $sql_count);
$Contagem_imoveis = mysqli_fetch_assoc($result_total)['Contagem_de_imoveis'] ?? 0;

// ==================== PAGINAÇÃO ====================
$imoveis_por_pagina = 6;
$inicio = ($pagina - 1) * $imoveis_por_pagina;
$total_paginas = ceil($Contagem_imoveis / $imoveis_por_pagina);
?>

<!-- Properties Section -->
<section id="properties" class="properties section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <!-- BARRA DE BUSCA (preserva valores) -->
    <div class="search-bar mb-5" data-aos="fade-up" data-aos-delay="150">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="search-wrapper">
            <div class="row g-3">
              <div class="col-lg-4 col-md-6">
                <div class="search-field">
                  <label>Localização</label>
                  <input type="text" class="form-control" placeholder="Digite a morada" id="localizacao" value="<?= htmlspecialchars($local) ?>">
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="search-field">
                  <label>Tipo de imóvel</label>
                  <select id="tipo" class="form-select">
                    <option>Todos os tipos</option>
                    <option value="Casa" <?= $tipo === 'Casa' ? 'selected' : '' ?>>Casas</option>
                    <option value="Apartamento" <?= $tipo === 'Apartamento' ? 'selected' : '' ?>>Apartamentos</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="search-field">
                  <label>Tipo de ações</label>
                  <select id="acao" class="form-select">
                    <option>Todas as ações</option>
                    <option value="Vendas" <?= $acao === 'Vendas' ? 'selected' : '' ?>>Compras de imóveis</option>
                    <option value="Arrendamento" <?= $acao === 'Arrendamento' ? 'selected' : '' ?>>Aluguel de imóveis</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-5 col-md-6">
                <div class="search-field">
                  <label>Tipologia</label>
                  <div class="bedroom-quick">
                    <button class="bed-btn <?= $tipologia === 'any' ? 'active' : '' ?>" data-beds="any">T0</button>
                    <button class="bed-btn <?= $tipologia === 'T1' ? 'active' : '' ?>" data-beds="T1">T1</button>
                    <button class="bed-btn <?= $tipologia === 'T2' ? 'active' : '' ?>" data-beds="T2">T2</button>
                    <button class="bed-btn <?= $tipologia === 'T3' ? 'active' : '' ?>" data-beds="T3">T3</button>
                    <button class="bed-btn <?= $tipologia === 'T4' ? 'active' : '' ?>" data-beds="T4">T4</button>
                    <button class="bed-btn <?= $tipologia === 'T5' ? 'active' : '' ?>" data-beds="T5">T5+</button>
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
    </div>

    <!-- RESULTS HEADER -->
    <div class="results-header mb-4" data-aos="fade-up" data-aos-delay="200">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="results-info">
            <h5>Exibindo : <?= $Contagem_imoveis ?> imóveis</h5>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="results-controls">
            <div class="d-flex gap-3 align-items-center justify-content-lg-end">
              <!-- Aqui você pode colocar o select de ordenação depois se quiser -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- LISTA DE IMÓVEIS -->
    <div class="properties-container">
      <div class="properties-masonry view-masonry active" data-aos="fade-up" data-aos-delay="250">
        <div class="row g-4">
          <?php
          $sql = "SELECT COUNT(g.Fotos) as Fotos, a.Servicos, a.nome, a.NdeTelemovel, 
                         i.Freguesia, i.Morada, i.concelho, i.Distrito, i.Codigopostal, 
                         i.Areautil, i.Tipologia, i.ID_Imoveis, i.Tipodeimovel, i.Preco, 
                         i.Imagens, i.Estado, a.Imagem 
                  FROM agentes a, galeria g, imoveis i 
                  WHERE i.Agentes_ID_Agentes = a.ID_Agentes 
                    AND i.ID_Imoveis = g.Imoveis_ID_Imoveis 
                    AND $where 
                  GROUP BY i.ID_Imoveis 
                  LIMIT $inicio, $imoveis_por_pagina";

          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $nomeAgente      = $row["nome"];
              $ContagemDeImagens = $row["Fotos"];
              $Servico         = $row["Servicos"];
              $id_imoveis      = $row["ID_Imoveis"];
              $morada          = $row["Morada"];
              $areautil        = $row["Areautil"];
              $tipologia       = $row["Tipologia"];
              $tipodeimovel    = $row["Tipodeimovel"];
              $preco           = $row["Preco"];
              $imagens         = $row["Imagens"];
              $Estado_do_imovel= $row["Estado"];
              $numero          = $row["NdeTelemovel"];
              $Agente_servicos = $row["Servicos"];
              $Imagem_agente   = $row["Imagem"];

              $Nr_formatado    = num_Formatado($numero);
              $preco_atual     = preco_formatado($preco, $Agente_servicos);
          ?>
              <!-- CARD (igual ao original) -->
              <div class="col-lg-4 col-md-6">
                <div class="property-item" style="cursor:pointer;" onclick="window.location.href='<?=BASE_URL?>agentes/A_agente_property-details.php?id=<?= $id_imoveis; ?>'">
                  <a class="property-link">
                    <div class="property-image-wrapper">
                      <img src="<?=ADMIN_URL?>img/principal/<?= $imagens ?>" alt="Luxury Villa" class="img-fluid">
                      <div class="property-status">
                        <span class="status-badge sale">Para <?= $Servico; ?> </span>
                      </div>
                      <div class="property-actions">
                        <button class="action-btn gallery-btn" data-toggle="tooltip" title="View Gallery">
                          <i class="bi bi-images"></i>
                          <span class="gallery-count"><?= $ContagemDeImagens; ?></span>
                        </button>
                      </div>
                    </div>
                  </a>
                  <div class="property-details">
                    <a class="property-link">
                      <div class="property-header">
                        <div class="property-price">€<?= $preco_atual; ?></div>
                        <div class="property-type"><?= $tipodeimovel; ?></div>
                      </div>
                      <h4 class="property-title"></h4>
                      <p class="property-address">
                        <i class="bi bi-geo-alt"></i> <?= $morada; ?>
                      </p>
                      <div class="property-specs">
                        <div class="spec-item"><i class="bi bi-house-door"></i> <span><?= $tipologia; ?></span></div>
                        <div class="spec-item"><i class="bi bi-bar-chart-line"></i> <span><?= $Estado_do_imovel; ?></span></div>
                        <div class="spec-item"><i class="bi bi-arrows-angle-expand"></i> <span><?= $areautil; ?>m²</span></div>
                      </div>
                    </a>
                    <div class="property-agent-info d-flex align-items-center justify-content-between">
                      <a class="d-flex align-items-center">
                        <div class="agent-avatar me-3">
                          <img src="<?=ADMIN_URL?>img/agents/<?= $Imagem_agente; ?>" alt="Agent" class="rounded-circle" width="48" height="48">
                        </div>
                        <div class="agent-details"><strong><?= $nomeAgente; ?></strong></div>
                      </a>
                      <div class="agent-contact ms-3">
                        <a class="contact-btn" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?= $Nr_formatado ?>">
                          <i class="bi bi-telephone fs-5"></i>
                        </a>
                      </div>
                      <input type="hidden" value="<?= $id_imoveis; ?>" name="id_Imovel_Post">
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Property Item -->
          <?php
            } // fim while
          } // fim if
          ?>
        </div>
      </div>
    </div>

    <!-- PAGINAÇÃO -->
    <nav class="pagination-wrapper mt-5" data-aos="fade-up" data-aos-delay="350">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-6">
          <div class="pagination-info">
            <?php
            $inicio_exibicao = $inicio + 1;
            $fim_exibicao = min($inicio + $imoveis_por_pagina, $Contagem_imoveis);
            ?>
            <p>Exibindo <strong><?= $inicio_exibicao ?>-<?= $fim_exibicao ?></strong> de <strong><?= $Contagem_imoveis ?></strong> propriedades</p>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="pagination justify-content-lg-end">
            <?php if ($pagina > 1): ?>
              <li class="page-item"><a class="page-link paginacao" data-page="<?= $pagina - 1 ?>"><i class="bi bi-chevron-left"></i></a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
              <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                <a class="page-link paginacao" data-page="<?= $i ?>"><?= $i ?></a>
              </li>
            <?php endfor; ?>

            <?php if ($pagina < $total_paginas): ?>
              <li class="page-item"><a class="page-link paginacao" data-page="<?= $pagina + 1 ?>"><i class="bi bi-chevron-right"></i></a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

  </div>
</section>