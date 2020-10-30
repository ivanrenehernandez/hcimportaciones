<head>
    <title>Administrador/Bodega</title>
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
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-header bg-ihc py-4 text-white text-center">
                            <h2>Perfil Bodega</h2>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title text-right">Revise sus credenciales</h6>
                            <form action="<?= base_url ?>administrador/actualizarBodega" method="POST">
                                <input type="hidden" name="id" value="<?= $bodega->id ?>">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group mb-2">
                                            <label class="font-weight-bold">Nombres</label>
                                            <input type="text" name="nombre" class="form-control" aria-describedby="helpId" value="<?= $bodega->nombre ?>" required>
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
                <div class="col-12 col-sm-12 col-md-8">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="bg-ihc text-center">
                                    <th>No.</th>
                                    <th>Titulo</th>
                                    <th>Categoria</th>
                                    <th>Calidad</th>
                                    <th>Cantidad</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                ?>
                                <?php
                                while ($existencia = $existencias->fetch_object()) { ?>
                                    <tr class="text-center">
                                        <?php $i++; ?>
                                        <td><?= $i ?></td>
                                        <td><a href="<?= base_url ?>administrador/perfilProducto&id=<?= $existencia->producto_id ?>" class="btn btn-primary"><?= $existencia->producto ?></a></td>
                                        <td><a href="<?= base_url ?>administrador/perfilCategoria&id=<?= $existencia->categoria_id ?>" class="btn btn-info"><?= $existencia->categoria ?></a></td>
                                        <td><a href="<?= base_url ?>administrador/perfilCategoria&id=<?= $existencia->calidad_id ?>" class="btn btn-warning"><?= $existencia->calidad ?></a> </td>
                                        <td><?= $existencia->cantidad ?> </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url ?>administrador/perfilExistencia&id=<?= $existencia->id ?>" class="btn btn-info btn-block">Ver</a>
                                                <form action="<?= base_url ?>administrador/eliminarExistencia" class="was-validated" method="POST">
                                                    <input type="hidden" name="id" value="<?= $existencia->id ?>">
                                                    <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'views/layouts/footer.php'; ?>
</body>