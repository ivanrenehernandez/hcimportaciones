<head>
    <title>Administrador/Comprar-Producto</title>
</head>

<body>
    <?php require_once 'views/layouts/jumbotron.php'; ?>
    <?php require_once 'views/cliente/nav.php'; ?>
    <div class="content-body">
        <div class="container-fluid">
            <div class="mt-4 mb-2">
                <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] == 'pay_complete') : ?>
                    <div class="alert alert-success"> <strong>¡Excelente!</strong> Se ha añadido a tu carrito de compra. </div>
                <?php elseif (isset($_SESSION['alert']) && $_SESSION['alert'] == 'pay_failed') : ?>
                    <div class="alert alert-danger"> <strong>¡Error!</strong> No se ha añadido a tu carrito de compra. </div>
                <?php endif; ?>

                <?php utils::deleteSesion('alert'); ?>
            </div>
            <div class="row my-4">
                <div class="col-12 col-sm-12 col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header bg-ihc py-4 text-white text-center">
                            <h2>Producto</h2>
                        </div>
                        <div class="card-body">
                            <div class="card-title font-weight-bold"><?= $producto->titulo ?></div>
                            <form action="<?= base_url ?>cliente/comprarProducto" method="POST">
                                <input type="hidden" name="id" value="<?= $producto->id ?>">
                                <img src="<?= $producto->image_url ?>" class="img-fluid mx-auto d-block my-4" width="400vh">
                                <p class="text-justify"><?= $producto->descripcion ?></p>
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="text" name="cantidad" id="" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-block">Añadir al carrito</button>
                                </div>
                            </form>
                            <hr>
                        </div>
                        <div class="card-footer py-4 bg-ihc">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'views/layouts/footer.php'; ?>
</body>