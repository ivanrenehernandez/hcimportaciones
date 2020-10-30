<head>
    <title>Cliente/Inicio</title>
</head>

<body>
    <?php require_once 'views/layouts/jumbotron.php'; ?>
    <?php require_once 'views/administrador/nav.php'; ?>
    <div class="content-body">
        <div class="container-fluid">
            <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] == 'register_complete') : ?>
                <div class="alert alert-success">
                    <strong>¡Excelente!</strong> Registro completado <div class="alert-link">Se ha completado el registro</div>
                </div>
            <?php elseif (isset($_SESSION['alert']) && $_SESSION['alert'] == 'register_failed') : ?>
                <div class="alert alert-danger">
                    <strong>¡Error!</strong> Error de Registro <div href="#" class="alert-link">Verifique sus credenciales </div>
                </div>
            <?php elseif (isset($_SESSION['alert']) && $_SESSION['alert'] == 'delete_complete') : ?>
                <div class="alert alert-success">
                    <strong>¡Excelente!</strong> Eliminación completada </div>
            <?php elseif (isset($_SESSION['alert']) && $_SESSION['alert'] == 'delete_failed') : ?>
                <div class="alert alert-danger">
                    <strong>¡Error!</strong> Error de Eliminación </div>
            <?php endif; ?>

            <?php utils::deleteSesion('alert'); ?>
            <div class="row my-4">
                <div class="col-12 col-sm-12 col-md-4">
                    <?php
                    while ($producto = $productos->fetch_object()) { ?>
                        <div class="card">
                            <div class="card-header bg-ihc py-4 text-white text-center">
                                <h2>Producto</h2>
                            </div>
                            <div class="card-body">
                                <div class="card-title"><?= $producto->titulo ?></div>
                            </div>
                            <div class="card-footer py-4 bg-ihc">
                            </div>
                        </div>
                    <?php }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <?php require_once 'views/layouts/footer.php'; ?>
</body>