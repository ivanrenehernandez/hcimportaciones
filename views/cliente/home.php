<head>
    <title>Cliente/Inicio</title>
</head>

<body>
    <?php require_once 'views/layouts/jumbotron.php'; ?>
    <?php require_once 'views/cliente/nav.php'; ?>
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
            <div class="row my-2">
                <?php
                while ($producto = $productos->fetch_object()) { ?>
                    <div class="col-12 col-sm-12 col-md-3 my-2">
                        <div class="card">
                            <div class="card-header bg-ihc py-4 text-white text-center">
                                <h2 class="font-weight-bold">Producto</h2>
                            </div>
                            <div class="card-body">
                                <div class="card-title font-weight-bold"><?= $producto->titulo ?></div>
                                <img src="<?= $producto->image_url ?>" class="img-fluid mx-auto d-block" width="200vh">
                                <p class="text-justify"><?= $producto->descripcion ?></p>
                                <a href="<?= base_url ?>cliente/comprar&id=<?= $producto->id ?>" class="btn btn-primary btn-block">Comprar</a>
                            </div>
                            <div class="card-footer py-4 bg-ihc">
                            </div>
                        </div>
                    </div>
                <?php }
                ?>

            </div>
        </div>
    </div>

    <?php require_once 'views/layouts/footer.php'; ?>
</body>