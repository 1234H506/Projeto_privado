<?php
// D_mensagens.php - Include este arquivo no topo da seção content de qualquer página

if (isset($_SESSION['sucesso'])) {
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> ' . htmlspecialchars($_SESSION['sucesso']) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    unset($_SESSION['sucesso']);
}

if (isset($_SESSION['erro'])) {
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> ' . htmlspecialchars($_SESSION['erro']) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    unset($_SESSION['erro']);
}

if (isset($_SESSION['aviso'])) {
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fas fa-info-circle"></i> ' . htmlspecialchars($_SESSION['aviso']) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    unset($_SESSION['aviso']);
}
?>