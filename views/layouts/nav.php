<nav class="navbar navbar-expand-md bg-ihc navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="<?= base_url ?>home/index">IHCImportaciones</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Categorias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Productos</a>
            </li>

        </ul>
        <a href="<?= base_url ?>home/login" class="btn btn-info py-2 rounded float-right">Iniciar Sesión</a>
    </div>
</nav>