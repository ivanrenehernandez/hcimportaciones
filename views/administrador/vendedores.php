<head>
    <title>Administrador/Vendedores</title>
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
                    <div class="card">
                        <div class="card-header bg-ihc py-4 text-white text-center">
                            <h2>Registrar Vendedor</h2>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title text-right">Digite sus credenciales</h6>
                            <form action="<?= base_url ?>administrador/registrarVendedor" method="POST">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group mb-2">
                                            <label class="font-weight-bold">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" aria-describedby="helpId" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Apellidos</label>
                                            <input type="text" name="apellidos" class="form-control" aria-describedby="helpId" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Documento</label>
                                            <input type="text" name="documento" class="form-control" aria-describedby="helpId" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Celular</label>
                                            <input type="text" name="celular" class="form-control" aria-describedby="helpId" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Email</label>
                                            <input type="email" name="email" class="form-control" aria-describedby="helpId" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-info btn-block bg-ihc">Registrarse</button>
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
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Celular</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                ?>
                                <?php
                                while ($vendedor = $vendedores->fetch_object()) { ?>
                                    <tr class="text-center">
                                        <?php $i++; ?>
                                        <td><?= $i ?></td>
                                        <td><?= $vendedor->nombres ?></td>
                                        <td><?= $vendedor->apellidos ?></td>
                                        <td><?= $vendedor->email ?> </td>
                                        <td><?= $vendedor->celular ?> </td>
                                        <td>
                                            <div class="btn-group">
                                                <form action="<?= base_url ?>administrador/eliminarVendedor" class="was-validated" method="POST">
                                                    <input type="hidden" name="id" value="<?= $vendedor->id ?>">
                                                    <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
                                                </form>
                                                <!-- <form action="<?= base_url ?>administrador/verProducto" class="was-validated" method="POST">
                                                    <input type="hidden" name="id" value="<?= $producto->id ?>">
                                                    <button type="submit" class="btn btn-warning btn-block">Ver perfil</button>
                                                </form> -->
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