<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="<?= base_url ?>administrador/index">IHCImportaciones</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url ?>administrador/clientes">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url ?>administrador/vendedores">Vendedores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url ?>administrador/categorias">Categorias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url ?>administrador/calidad">Calidad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url ?>administrador/bodegas">Bodegas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url ?>administrador/existencias">Existencias</a>
            </li>
        </ul>
        <a href="<?= base_url ?>administrador/logout" class="btn btn-info py-2 rounded float-right">Cerrar Sesión</a>
    </div>
</nav>