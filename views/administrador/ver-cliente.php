<head>
    <title>Administrador/Cliente</title>
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
                            <h2>Perfil Cliente</h2>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title text-right">Revise sus credenciales</h6>
                            <form action="<?= base_url ?>administrador/actualizarCliente" method="POST">
                                <input type="hidden" name="id" value="<?= $cliente->id ?>">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group mb-2">
                                            <label class="font-weight-bold">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" aria-describedby="helpId" value="<?= $cliente->nombres ?>" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Apellidos</label>
                                            <input type="text" name="apellidos" class="form-control" aria-describedby="helpId" value="<?= $cliente->apellidos ?>" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Documento</label>
                                            <input type="text" name="documento" class="form-control" aria-describedby="helpId" value="<?= $cliente->documento ?>" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Celular</label>
                                            <input type="text" name="celular" class="form-control" aria-describedby="helpId" value="<?= $cliente->celular ?>" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Email</label>
                                            <input type="email" name="email" class="form-control" aria-describedby="helpId" value="<?= $cliente->email ?>" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Fecha de Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" class="form-control" aria-describedby="helpId" value="<?= $cliente->fecha_nacimiento ?>" min="1900-01-31" max="2005-01-31" required>
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