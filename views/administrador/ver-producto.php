<head>
    <title>Administrador/Producto</title>
</head>

<body>
    <?php require_once 'views/layouts/jumbotron.php'; ?>
    <?php require_once 'views/administrador/nav.php'; ?>
    <div class="content-body">
        <div class="container-fluid">
            <div class="mt-4 mb-2">
                <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] == 'update_complete') : ?>
                    <div class="alert alert-success">
                        <strong>¡Excelente!</strong> Actualización completada <div class="alert-link">Se ha completado la actualización.</div>
                    </div>
                <?php elseif (isset($_SESSION['alert']) && $_SESSION['alert'] == 'update_failed') : ?>
                    <div class="alert alert-danger">
                        <strong>¡Error!</strong> Error de Actualización <div href="#" class="alert-link">Verifique la información. </div>
                    </div>
                <?php endif; ?>

                <?php utils::deleteSesion('alert'); ?>
            </div>
            <div class="row my-4">
                <div class="col-12 col-sm-12 col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header bg-ihc py-4 text-white text-center">
                            <h2>Perfil Producto</h2>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title text-right">Revise sus credenciales</h6>
                            <form action="<?= base_url ?>administrador/actualizarProducto" method="POST">
                                <input type="hidden" name="id" value="<?= $producto->id ?>">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group mb-2">
                                            <label class="font-weight-bold">Titulo</label>
                                            <input type="text" name="titulo" class="form-control" aria-describedby="helpId" value="<?= $producto->titulo ?> " required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Descripción</label>
                                            <input type="text" name="descripcion" class="form-control" aria-describedby="helpId" value="<?= $producto->descripcion ?> " required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Categoria</label>
                                            <select class="form-control" name="categoria_id">

                                                <?php
                                                while ($categoria = $categorias->fetch_object()) { ?>
                                                    <?php if ($categoria->id == $producto->categoria_id) : ?>
                                                        <option value="<?= $categoria->id ?>" selected><?= $categoria->nombre ?> </option>
                                                    <?php elseif ($categoria->id != $producto->categoria_id) : ?>
                                                        <option value="<?= $categoria->id ?>"><?= $categoria->nombre ?> </option>
                                                    <?php endif; ?>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Calidad</label>
                                            <select class="form-control" name="calidad_id">
                                                <?php
                                                while ($calidad = $calidades->fetch_object()) { ?>
                                                    <?php if ($calidad->id == $producto->calidad_id) : ?>
                                                        <option value="<?= $calidad->id ?>" selected><?= $calidad->nombre ?> </option>
                                                    <?php elseif ($calidad->id != $producto->calidad_id) : ?>
                                                        <div class="alert alert-danger">
                                                            <option value="<?= $calidad->id ?>"><?= $calidad->nombre ?> </option>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Precio</label>
                                            <input type="number" name="precio" class="form-control" aria-describedby="helpId" value="<?= $producto->precio ?>" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-info btn-block bg-ihc">Actualizar</button>
                                        </div>
                                    </div>
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