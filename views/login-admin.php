<head>
    <title>Administrador</title>
</head>

<body>
    <?php require_once 'views/layouts/jumbotron.php'; ?>
    <?php require_once 'views/layouts/nav.php'; ?>
    <div class="container-fluid content-body">
        <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] == 'register_complete') : ?>
            <div class="alert alert-success">
                <strong>¡Excelente!</strong> Registro completado <div class="alert-link">Se ha completado el registro</div>
            </div>
        <?php elseif (isset($_SESSION['alert']) && $_SESSION['alert'] == 'register_failed') : ?>
            <div class="alert alert-danger">
                <strong>¡Error!</strong> Error de Registro <div href="#" class="alert-link">Verifique sus credenciales </div>
            </div>
        <?php elseif (isset($_SESSION['alert']) && $_SESSION['alert'] == 'login_failed') : ?>
            <div class="alert alert-danger">
                <strong>¡Error!</strong> Error de Login <div href="#" class="alert-link">Verifique sus credenciales </div>
            </div>
        <?php endif; ?>
        <?php utils::deleteSesion('alert'); ?>
        <div class="row mt-4 mb-2">
            <div class="col-12 col-md-6 mx-auto">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-ihc py-4 text-white text-center">
                            <h2>Inicio de Sesión</h2>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title text-right">Digite sus credenciales</h6>
                            <form action="<?= base_url ?>administrador/login" method="POST">
                                <div class="row">
                                    <div class="col-12 col-md-12 d-none d-sm-block">
                                        <img src="<?= base_url ?>assets/images/usuario2.png" class="img-fluid mx-auto d-block" width="25%">
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Correo electrónico</label>
                                            <input type="email" name="email" class="form-control" aria-describedby="helpId" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="font-weight-bold">Contraseña</label>
                                            <input type="password" name="password" class="form-control" aria-describedby="helpId" required>
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-4">
                                            <button type="submit" name="" class="btn btn-info btn-block bg-ihc">Iniciar Sesión</button>
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