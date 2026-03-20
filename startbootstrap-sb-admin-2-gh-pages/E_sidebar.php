
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-3">HomeSpace Admin </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Painel</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        Dados
    </div>



    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="D_tablesVisitas.php">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            <span>Registros de visitas</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu imoveis -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-building fa-2x text-gray-300"></i>
            <span>Imóveis</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="A_tablesCasas.php">Imóveis - Disponível</a>
                <a class="collapse-item" href="A_tablesCasasArquivadas.php">Imóveis - Arquivados</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fas fa-address-card fa-2x text-gray-300"></i>
            <span>Agentes</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="B_tablesAgentes.php">Agentes - Disponível</a>
                <a class="collapse-item" href="B_tablesAgentesArquivados.php">Agentes - Arquivados</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="C_tablesUtilizador.php">
            <i class="fas fa-user fa-2x text-gray-300"></i>
            <span>Utilizador</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->

