<head>
    <title>Vendedor/Perfil</title>
</head>

<body>
    <?php require_once 'views/layouts/jumbotron.php'; ?>
    <?php require_once 'views/Vendedor/nav.php'; ?>
    <div class="content-body">
        <div class="container-fluid">
            <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] == 'update_complete') : ?>
                <div class="alert alert-success">
                    <strong>¡Excelente!</strong> Actualización completada, <div class="alert-link">Se ha completado la actualización.</div>
                </div>
            <?php elseif (isset($_SESSION['alert']) && $_SESSION['alert'] == 'update_failed') : ?>
                <div class="alert alert-danger">
                    <strong>¡Error!</strong> Error de actualización, <div href="#" class="alert-link">Verifique su información. </div>
                </div>
            <?php endif; ?>
            <?php utils::deleteSesion('alert'); ?>
            <div class="row my-2">
                <div class="col-12 col-sm-12 col-md-4 my-2">
                    <div class="card">
                        <div class="card-header py-4 bg-ihc"></div>
                        <div class="card-body">
                            <h3 class="card-title text-center">Perfil de Vendedor</h3>
                            <img src="https://d500.epimg.net/cincodias/imagenes/2016/07/04/lifestyle/1467646262_522853_1467646344_noticia_normal.jpg" class="img-fluid img-responsive mx-auto d-block" width="400vh">
                            <form action="<?= base_url ?>vendedor/actualizar" method="POST">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nombres</label>
                                    <input type="text" name="nombres" class="form-control" placeholder="Actualiza tu nombre" value="<?= $_SESSION['usuario']->nombres ?>">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control" placeholder="" value="<?= $_SESSION['usuario']->apellidos ?>">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="" value="<?= $_SESSION['usuario']->email ?>">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Documento</label>
                                    <input type="text" name="documento" class="form-control" placeholder="" value="<?= $_SESSION['usuario']->documento ?>">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Celular</label>
                                    <input type="text" name="celular" class="form-control" placeholder="" value="<?= $_SESSION['usuario']->celular ?>">
                                </div>
                                <div class="form-group my-1">
                                    <label class="font-weight-bold">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" class="form-control" aria-describedby="helpId" required value="<?= $_SESSION['usuario']->fecha_nacimiento ?>" min="1920-07-22" max="2010-12-31">
                                    <small id="helpId" class="text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning btn-block">Actualizar</button>
                                </div>
                            </form>
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#actualizar_contraseña">
                                Actualizar contraseña
                            </button>
                        </div>
                        <div class="card-footer py-4 bg-ihc"></div>
                    </div>
                </div>
                <!-- The Modal -->
                <div class="modal" id="actualizar_contraseña">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header bg-ihc">
                                <h4 class="modal-title">Actualizar contraseña</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="<?= base_url ?>Vendedor/actualizarClave" method="POST">
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Actualiza tu contraseña" value="<?= $_SESSION['usuario']->password ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text">********</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-info btn-block">Actualizar contraseña</button>
                                    </div>
                                </form>
                                <button class="btn btn-info float-right" onclick="mostrarPassword()">Mostrar</button>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer bg-ihc">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-8 my-2">
                    <h2>Mis Ventas</h2>
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function mostrarPassword() {
            var password = document.getElementById("password");
            if (password.type == "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>

    <?php require_once 'views/layouts/footer.php'; ?>
</body>