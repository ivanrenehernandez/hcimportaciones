<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="<?= base_url ?>vendedor/index">IHCImportaciones</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url ?>administrador/vendedores">Mi carrito</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url ?>administrador/categorias">Mis compras</a>
            </li> -->
        </ul>
        <a class="btn btn-warning py-2 font-weight-bold rounded float-right mr-4"><?= $_SESSION['usuario']->nombres ?> <?= $_SESSION['usuario']->apellidos ?></a>
        <a href="<?= base_url ?>vendedor/logout" class="btn btn-info py-2 rounded float-right">Cerrar Sesión</a>
    </div>
</nav>