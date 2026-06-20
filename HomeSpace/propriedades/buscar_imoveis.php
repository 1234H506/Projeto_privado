<?php
//Para ajax
include('../reutilizaveis/conexao.php');

// Verifição se recebe o dados via POST
$local = $_POST['localizacao'];
$tipo = $_POST['tipo'];
// $preco = $_POST['preco'];
$id = $_POST['Id_Do_Agente'];



$sql = " SELECT COUNT(g.Fotos) as 'Fotos' , a.Servicos , a.nome , i.Freguesia , i.concelho , i.Distrito , i.Codigopostal , i.Areautil , i.Tipologia , i.ID_Imoveis ,  i.Areautil , i.Preco , i.Imagens , i.Estado FROM agentes a, galeria g, imoveis i WHERE i.Agentes_ID_Agentes = a.ID_Agentes AND i.ID_Imoveis = g.Imoveis_ID_Imoveis AND a.ID_Agentes = $id AND i.Disponibilidade = 1 AND (i.Morada = '$local' OR i.Tipodeimovel = '$tipo') GROUP BY i.ID_Imoveis ;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {


        $nomeAgente = $row["nome"];
        $ContagemDeImagens = $row["Fotos"];
        $Servico = $row["Servicos"];
        $id_imoveis = $row["ID_Imoveis"];
        $freguesia = $row["Freguesia"];
        $concelho = $row["concelho"];
        $distrito = $row["Distrito"];
        $codigopostal = $row["Codigopostal"];
        $areautil = $row["Areautil"];
        $tipologia = $row["Tipologia"];
        $preco = $row["Preco"];
        $imagens = $row["Imagens"];
        $Estado_do_imovel = $row["Estado"];

        $preco_formatado = number_format($preco, 2, ',', '.');

        ?>


        <div class="col-lg-4 col-md-6">
            <div class="property-item">
                <a href="property-details.html" class="property-link">
                    <div class="property-image-wrapper">
                        <img src="/administracao1/startbootstrap-sb-admin-2-gh-pages/img/principal/<?= $imagens ?>"
                            alt="Luxury Villa" class="img-fluid">
                        <div class="property-status">
                            <span class="status-badge featured">Destaque</span>
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
                <div class="property-details"><a href="property-details.php" class="property-link">
                        <div class="property-header">
                            <div class="property-price"><?= '€', $preco_formatado; ?></div>
                            <div class="property-type"><?= $tipo; ?></div>
                        </div>
                        <h4 class="property-title"></h4>
                        <p class="property-address">
                            <i class="bi bi-geo-alt"></i>
                            <?= $local; ?>
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
                        <a href="property-details.html" class="d-flex align-items-center ">
                            <div class="agent-avatar me-3">
                                <img src="assets/img/real-estate/agent-2.webp" alt="Agent" class="rounded-circle" width="48"
                                    height="48">
                            </div>
                            <div class="agent-details">
                                <strong><?= $nomeAgente; ?></strong>
                            </div>
                        </a>
                        <div class="agent-contact ms-3"><a href="property-details.html" class="property-link">
                            </a><a href="tel:+15552345678" class="contact-btn">
                                <i class="bi bi-telephone fs-5"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div><!-- End Property Item -->
    <?php } ?>
    </div>
    </div>
    </div>
    <?php
} else {
    echo "<p>Nenhum imóvel encontrado com esses filtros.</p>";
}
?>