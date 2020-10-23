<head>
    <title>Login</title>
</head>

<body>
    <?php require_once 'views/layouts/jumbotron.php'; ?>
    <?php require_once 'views/layouts/nav.php'; ?>
    <div class="container-fluid content-body">
        <div class="row mt-4 mb-2">
            <div class="col-12 col-sm-12 col-md-6 mx-auto">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-ihc py-4 text-white text-center">
                            <h2>Registrarse</h2>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title text-right">Digite sus credenciales</h6>
                            <form>
                                <div class="row">
                                    <div class="col-12 col-md-4 d-none d-sm-block">
                                        <img src="<?= base_url ?>assets/images/usuario2.png" class="img-fluid mx-auto d-block">
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="form-group my-3">
                                            <label class="font-weight-bold">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" placeholder="" aria-describedby="helpId">
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-3">
                                            <label class="font-weight-bold">Apellidos</label>
                                            <input type="text" name="apellidos" class="form-control" placeholder="" aria-describedby="helpId">
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-3">
                                            <label class="font-weight-bold">Documento</label>
                                            <input type="text" name="documento" class="form-control" placeholder="" aria-describedby="helpId">
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Seleccionar el tipo de documento</label>
                                            <select class="form-control" name="" id="">
                                                <option>Comprador</option>
                                                <option>Vendedor</option>
                                            </select>
                                        </div>
                                        <div class="form-group my-3">
                                            <label class="font-weight-bold">Fecha de Nacimiento</label>
                                            <input type="date" name="email" class="form-control" placeholder="" aria-describedby="helpId" value="2000-07-22" min="2018-01-01" max="2018-12-31">
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-3">
                                            <label class="font-weight-bold">Contraseña</label>
                                            <input type="password" name="clave" class="form-control" placeholder="" aria-describedby="helpId">
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-3">
                                            <button type="button" name="" id="" class="btn btn-info btn-block bg-ihc">Registrarse</button>
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
            <div class="col-12 col-md-6 mx-auto">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-ihc py-4 text-white text-center">
                            <h2>Inicio de Sesión</h2>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title text-right">Digite sus credenciales</h6>
                            <form>
                                <div class="row">
                                    <div class="col-12 col-md-4 d-none d-sm-block">
                                        <img src="<?= base_url ?>assets/images/usuario2.png" class="img-fluid mx-auto d-block">
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="form-group my-3">
                                            <label class="font-weight-bold">Correo electrónico</label>
                                            <input type="text" name="email" class="form-control" placeholder="" aria-describedby="helpId">
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-3">
                                            <label class="font-weight-bold">Contraseña</label>
                                            <input type="password" name="email" class="form-control" placeholder="" aria-describedby="helpId">
                                            <small id="helpId" class="text-muted"></small>
                                        </div>
                                        <div class="form-group my-3">
                                            <button type="button" name="" id="" class="btn btn-info btn-block bg-ihc">Iniciar Sesión</button>
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