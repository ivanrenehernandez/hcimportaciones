<?php
// require_once 'config/parametros.php';
// require_once 'models/administrador.php';
class AdministradorController
{

    public function login()
    {
        if (!isset($_SESSION['usuario'])) {
            require 'models/Administrador.php';
            $administrador = new Administrador();
            $email = $_POST['email'];
            $password = $_POST['password'];
            $administrador->setEmail($email);
            $administrador->setPassword($password);
            $res = $administrador->login();
            if ($res) {
                $_SESSION['usuario'] = $administrador;
                $_SESSION['rol'] = 'administrador';
                header("Location:" . base_url . 'administrador/index');
            } else {
                $_SESSION['alert'] = 'login_failed';
                header("Location:" . base_url . 'home/secret');
            }
        }
        // require_once 'views/administrador/home.php';
    }
    public function logout()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            $_SESSION['logout'] = '1';
            utils::deleteSesion('usuario');
            utils::deleteSesion('rol');
            header("Location:" . base_url . 'home/login');
        }
        header("Location:" . base_url . 'home/secret');
        // else if (isset($_SESSION['usuario']) && $_SESSION['rol'] != 'administrador') {
        //     header("Location:" . base_url . $_SESSION['rol'] . '/inicio');
        // } else {
        //     header("Location:" . base_url . 'app/loginAdministrador');
        // }
    }

    # BODEGAS
    public function bodegas()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            require 'models/Bodega.php';
            $bodega = new Bodega();
            $bodegas = $bodega->listar();
            require_once 'views/administrador/bodegas.php';
            die();
        }
    }
    public function registrarBodega()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                if ($nombre) {
                    require_once 'models/Bodega.php';
                    $bodega = new Bodega();
                    $bodega->setNombre($nombre);
                    $save = $bodega->insertar();
                    if ($save) {
                        $_SESSION['alert'] = 'register_complete';
                        header("Location:" . base_url . 'administrador/bodegas');
                        die();
                    } else {
                        $_SESSION['alert'] = 'register_failed';
                        header("Location:" . base_url . 'administrador/bodegas');
                        die();
                    }
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/bodegas');
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function eliminarBodega()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST['id'])) {
                require 'models/Bodega.php';
                $bodega = new Bodega();
                $bodega->setId($_POST['id']);
                $delete = $bodega->eliminar();
                if ($delete) {
                    $_SESSION['alert'] = 'delete_complete';
                    header("Location:" . base_url . 'administrador/bodegas');
                    die();
                } else {
                    $_SESSION['alert'] = 'delete_failed';
                    header("Location:" . base_url . 'administrador/bodegas');
                    die();
                }
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/bodegas');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function perfilBodega()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if ($_GET) {
                require_once 'models/Bodega.php';
                require_once 'models/Existencias.php';

                $bodega = new Bodega();
                $id = isset($_GET['id']) ? $_GET['id'] : false;
                $existencia = new Existencia();
                $existencia->setBodega_id($id);
                $existencias = $existencia->productos();
                $bodega->setId($id);
                $bodega = $bodega->buscar()->fetch_object();
                require_once 'views/administrador/ver-bodega.php';
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function actualizarBodega()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                require_once 'models/Bodega.php';
                $bodega = new Bodega();
                $id = isset($_POST['id']) ? $_POST['id'] : false;
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                if ($nombre) {
                    $bodega->setId($id);
                    $bodega->setNombre($nombre);
                    $update = $bodega->actualizar();
                    if ($update) {
                        $_SESSION['alert'] = 'update_complete';
                        header("Location:" . base_url . 'administrador/perfilBodega&id=' . $bodega->getId());
                        die();
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'administrador/perfilBodega&id=' . $bodega->getId());
                        die();
                    }
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    # PRODUCTO
    public function index()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            require 'models/Categoria.php';

            $categoria = new Categoria();
            $categorias = $categoria->listar();

            require 'models/Calidad.php';
            $calidad = new Calidad();
            $calidades = $calidad->listar();

            require 'models/Producto.php';
            $producto = new Producto();
            $productos = $producto->listar();

            require 'views/administrador/home.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }
    public function registrarProducto()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
                $categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : false;
                $calidad_id = isset($_POST['calidad_id']) ? $_POST['calidad_id'] : false;
                $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : false;
                $precio =  isset($_POST['precio']) ? $_POST['precio'] : false;
                if ($titulo && $descripcion && $categoria_id && $calidad_id) {
                    require_once 'models/Producto.php';
                    $producto = new Producto();
                    $producto->setTitulo($titulo);
                    $producto->setDescripcion($descripcion);
                    $producto->setCategoria_id($categoria_id);
                    $producto->setCalidad_id($calidad_id);
                    $producto->setPrecio($precio);
                    $producto->setImage($image_url);
                    $save = $producto->insertar();
                    if ($save) {
                        $_SESSION['alert'] = 'register_complete';
                        header("Location:" . base_url . 'administrador/index');
                        die();
                    } else {
                        $_SESSION['alert'] = 'register_failed';
                        header("Location:" . base_url . 'administrador/index');
                        die();
                    }
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/index');
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function eliminarProducto()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST['id'])) {
                require 'models/Producto.php';
                $producto = new Producto();
                $producto->setId($_POST['id']);
                $delete = $producto->eliminar();
                if ($delete) {
                    $_SESSION['alert'] = 'delete_complete';
                    header("Location:" . base_url . 'administrador/index');
                    die();
                } else {
                    $_SESSION['alert'] = 'delete_failed';
                    header("Location:" . base_url . 'administrador/index');
                    die();
                }
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/index');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function perfilProducto()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if ($_GET) {
                require_once 'models/Producto.php';
                require 'models/Categoria.php';
                require 'models/Calidad.php';

                $producto = new Producto();
                $id = isset($_GET['id']) ? $_GET['id'] : false;
                $producto->setId($id);
                $producto = $producto->buscar()->fetch_object();

                $categoria = new Categoria();
                $categorias = $categoria->listar();

                $calidad = new Calidad();
                $calidades = $calidad->listar();

                require_once 'views/administrador/ver-producto.php';
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function actualizarProducto()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                $id = isset($_POST['id']) ? $_POST['id'] : false;
                $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
                $categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : false;
                $calidad_id = isset($_POST['calidad_id']) ? $_POST['calidad_id'] : false;
                $precio =  isset($_POST['precio']) ? $_POST['precio'] : false;
                if ($titulo && $descripcion && $categoria_id && $calidad_id) {
                    require_once 'models/Producto.php';
                    $producto = new Producto();
                    $producto->setId($id);
                    $producto->setTitulo($titulo);
                    $producto->setDescripcion($descripcion);
                    $producto->setCategoria_id($categoria_id);
                    $producto->setCalidad_id($calidad_id);
                    $producto->setPrecio($precio);
                    $save = $producto->actualizar();
                    if ($save) {
                        $_SESSION['alert'] = 'update_complete';
                        header("Location:" . base_url . 'administrador/perfilProducto&id=' . $id);
                        die();
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'administrador/perfilProducto&id=' . $id);
                        die();
                    }
                } else {
                    $_SESSION['alert'] = 'update_failed';
                    header("Location:" . base_url . 'administrador/perfilProducto&id=' . $id);
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    # CALIDAD
    public function calidad()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            require_once 'models/Calidad.php';
            $calidad = new Calidad();
            $calidades = $calidad->listar();
            require_once 'views/administrador/calidad.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }
    public function registrarCalidad()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                if ($nombre) {
                    require_once 'models/Calidad.php';
                    $calidad = new Calidad();
                    $calidad->setNombre($nombre);
                    $save = $calidad->insertar();
                    if ($save) {
                        $_SESSION['alert'] = 'register_complete';
                        header("Location:" . base_url . 'administrador/calidad');
                        die();
                    } else {
                        $_SESSION['alert'] = 'register_failed';
                        header("Location:" . base_url . 'administrador/calidad');
                        die();
                    }
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/calidad');
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function eliminarCalidad()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST['id'])) {
                require 'models/Calidad.php';
                $calidad = new Calidad();
                $calidad->setId($_POST['id']);
                $delete = $calidad->eliminar();
                if ($delete) {
                    $_SESSION['alert'] = 'delete_complete';
                    header("Location:" . base_url . 'administrador/calidad');
                    die();
                } else {
                    $_SESSION['alert'] = 'delete_failed';
                    header("Location:" . base_url . 'administrador/calidad');
                    die();
                }
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/calidad');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function perfilCalidad()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if ($_GET) {
                require_once 'models/Calidad.php';
                $calidad = new Calidad();
                $id = isset($_GET['id']) ? $_GET['id'] : false;
                $calidad->setId($id);
                $calidad = $calidad->buscar()->fetch_object();
                require_once 'views/administrador/ver-calidad.php';
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function actualizarCalidad()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                require_once 'models/Calidad.php';
                $calidad = new Calidad();
                $id = isset($_POST['id']) ? $_POST['id'] : false;
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                if ($nombre) {
                    $calidad->setId($id);
                    $calidad->setNombre($nombre);
                    $update = $calidad->actualizar();
                    if ($update) {
                        $_SESSION['alert'] = 'update_complete';
                        header("Location:" . base_url . 'administrador/perfilCalidad&id=' . $calidad->getId());
                        die();
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'administrador/perfilCalidad&id=' . $calidad->getId());
                        die();
                    }
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    # CATEGORIA
    public function categorias()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            require_once 'models/Categoria.php';
            $categoria = new Categoria();
            $categorias = $categoria->listar();
            require_once 'views/administrador/categorias.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }
    public function registrarCategoria()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                if ($nombre) {
                    require_once 'models/Categoria.php';
                    $categoria = new Categoria();
                    $categoria->setNombre($nombre);
                    $save = $categoria->insertar();
                    if ($save) {
                        $_SESSION['alert'] = 'register_complete';
                        header("Location:" . base_url . 'administrador/categorias');
                        die();
                    } else {
                        $_SESSION['alert'] = 'register_failed';
                        header("Location:" . base_url . 'administrador/categorias');
                        die();
                    }
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/categorias');
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function eliminarCategoria()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST['id'])) {
                require 'models/Categoria.php';
                $categoria = new Categoria();
                $categoria->setId($_POST['id']);
                $delete = $categoria->eliminar();
                if ($delete) {
                    $_SESSION['alert'] = 'delete_complete';
                    header("Location:" . base_url . 'administrador/categorias');
                    die();
                } else {
                    $_SESSION['alert'] = 'delete_failed';
                    header("Location:" . base_url . 'administrador/categorias');
                    die();
                }
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/categorias');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function perfilCategoria()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if ($_GET) {
                require_once 'models/Categoria.php';
                $categoria = new Categoria();
                $id = isset($_GET['id']) ? $_GET['id'] : false;
                $categoria->setId($id);
                $categoria = $categoria->buscar()->fetch_object();
                require_once 'views/administrador/ver-categoria.php';
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function actualizarCategoria()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                require_once 'models/Categoria.php';
                $categoria = new Categoria();
                $id = isset($_POST['id']) ? $_POST['id'] : false;
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                if ($nombre) {
                    $categoria->setId($id);
                    $categoria->setNombre($nombre);
                    $update = $categoria->actualizar();
                    if ($update) {
                        $_SESSION['alert'] = 'update_complete';
                        header("Location:" . base_url . 'administrador/perfilCategoria&id=' . $categoria->getId());
                        die();
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'administrador/perfilCategoria&id=' . $categoria->getId());
                        die();
                    }
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    # VENDEDOR
    public function vendedores()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            require_once 'models/Vendedor.php';
            $vendedor = new Vendedor();
            $vendedores = $vendedor->listar();
            require_once 'views/administrador/vendedores.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }
    public function registrarVendedor()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_SESSION['usuario'])) {
                # code...
            }
            if (isset($_POST)) {
                $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
                $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $documento = isset($_POST['documento']) ? $_POST['documento'] : false;
                $celular = isset($_POST['celular']) ? $_POST['celular'] : false;
                $email =  isset($_POST['email']) ? $_POST['email'] : false;
                $fecha_nacimiento =  isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : false;
                if ($nombres && $apellidos && $documento && $celular && $email && $fecha_nacimiento) {
                    require 'models/Vendedor.php';
                    $vendedor = new Vendedor();
                    $vendedor->setNombres($nombres);
                    $vendedor->setApellidos($apellidos);
                    $vendedor->setDocumento($documento);
                    $vendedor->setCelular($celular);
                    $vendedor->setEmail($email);
                    $vendedor->setFecha_nacimiento($fecha_nacimiento);
                    $save = $vendedor->insertar();
                    if ($save) {
                        $_SESSION['alert'] = 'register_complete';
                        header("Location:" . base_url . 'administrador/vendedores');
                        die();
                    } else {
                        $_SESSION['alert'] = 'register_failed';
                        header("Location:" . base_url . 'administrador/vendedores');
                        die();
                    }
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/vendedores');
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function eliminarVendedor()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST['id'])) {
                require 'models/Vendedor.php';
                $vendedor = new Vendedor();
                $vendedor->setId($_POST['id']);
                $delete = $vendedor->eliminar();
                if ($delete) {
                    $_SESSION['alert'] = 'delete_complete';
                    header("Location:" . base_url . 'administrador/vendedores');
                    die();
                } else {
                    $_SESSION['alert'] = 'delete_failed';
                    header("Location:" . base_url . 'administrador/vendedores');
                    die();
                }
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/vendedores');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function perfilVendedor()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if ($_GET) {
                require_once 'models/Vendedor.php';
                $vendedor = new Vendedor();
                $id = isset($_GET['id']) ? $_GET['id'] : false;
                $vendedor->setId($id);
                $vendedor = $vendedor->buscar()->fetch_object();
                require_once 'views/administrador/ver-vendedor.php';
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function actualizarVendedor()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                require_once 'models/Vendedor.php';
                $vendedor = new Vendedor();
                $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
                $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $documento = isset($_POST['documento']) ? $_POST['documento'] : false;
                $celular = isset($_POST['celular']) ? $_POST['celular'] : false;
                $email =  isset($_POST['email']) ? $_POST['email'] : false;
                $fecha_nacimiento =  isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : false;
                if ($nombres && $apellidos && $documento && $celular && $email && $fecha_nacimiento) {
                    $vendedor->setId($_POST['id']);
                    $vendedor->setNombres($nombres);
                    $vendedor->setApellidos($apellidos);
                    $vendedor->setDocumento($documento);
                    $vendedor->setCelular($celular);
                    $vendedor->setEmail($email);
                    $vendedor->setFecha_nacimiento($fecha_nacimiento);
                    $update = $vendedor->actualizar();
                    if ($update) {
                        $_SESSION['alert'] = 'update_complete';
                        header("Location:" . base_url . 'administrador/perfilVendedor&id=' . $vendedor->getId());
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'administrador/perfilVendedor&id=' . $vendedor->getId());
                    }
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    # CLIENTE

    public function clientes()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            require_once 'models/Cliente.php';
            $cliente = new Cliente();
            $clientes = $cliente->listar();
            require_once 'views/administrador/clientes.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }
    public function registrarCliente()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
                $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $documento = isset($_POST['documento']) ? $_POST['documento'] : false;
                $celular = isset($_POST['celular']) ? $_POST['celular'] : false;
                $email =  isset($_POST['email']) ? $_POST['email'] : false;
                if ($nombres && $apellidos && $documento && $celular && $email) {
                    require 'models/Cliente.php';
                    $cliente = new Cliente();
                    $cliente->setNombres($nombres);
                    $cliente->setApellidos($apellidos);
                    $cliente->setDocumento($documento);
                    $cliente->setCelular($celular);
                    $cliente->setEmail($email);
                    $save = $cliente->insertar();
                    if ($save) {
                        $_SESSION['alert'] = 'register_complete';
                        header("Location:" . base_url . 'administrador/clientes');
                        die();
                    } else {
                        $_SESSION['alert'] = 'register_failed';
                        header("Location:" . base_url . 'administrador/clientes');
                        die();
                    }
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'administrador/clientes');
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function eliminarCliente()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST['id'])) {
                require 'models/Cliente.php';
                $cliente = new Cliente();
                $cliente->setId($_POST['id']);
                $delete = $cliente->eliminar();
                if ($delete) {
                    $_SESSION['alert'] = 'delete_complete';
                    header("Location:" . base_url . 'administrador/clientes');
                    die();
                } else {
                    $_SESSION['alert'] = 'delete_failed';
                    header("Location:" . base_url . 'administrador/clientes');
                    die();
                }
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/clientes');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function perfilCliente()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if ($_GET) {
                require_once 'models/Cliente.php';
                $cliente = new Cliente();
                $id = isset($_GET['id']) ? $_GET['id'] : false;
                $cliente->setId($id);
                $cliente = $cliente->buscar()->fetch_object();
                require_once 'views/administrador/ver-cliente.php';
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function actualizarCliente()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                require_once 'models/Cliente.php';
                $cliente = new Cliente();
                $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
                $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $documento = isset($_POST['documento']) ? $_POST['documento'] : false;
                $celular = isset($_POST['celular']) ? $_POST['celular'] : false;
                $email =  isset($_POST['email']) ? $_POST['email'] : false;
                $fecha_nacimiento =  isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : false;
                if ($nombres && $apellidos && $documento && $celular && $email && $fecha_nacimiento) {
                    $cliente->setId($_POST['id']);
                    $cliente->setNombres($nombres);
                    $cliente->setApellidos($apellidos);
                    $cliente->setDocumento($documento);
                    $cliente->setCelular($celular);
                    $cliente->setEmail($email);
                    $cliente->setFecha_nacimiento($fecha_nacimiento);
                    $update = $cliente->actualizar();
                    if ($update) {
                        $_SESSION['alert'] = 'update_complete';
                        header("Location:" . base_url . 'administrador/perfilCliente&id=' . $cliente->getId());
                        die();
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'administrador/perfilCliente&id=' . $cliente->getId());
                        die();
                    }
                }
                $_SESSION['alert'] = 'update_failed';
                header("Location:" . base_url . 'administrador/perfilCliente&id=' . $cliente->getId());
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    # EXISTENCIA
    public function existencias()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            require_once 'models/Existencias.php';
            require_once 'models/Bodega.php';
            require_once 'models/Producto.php';
            $existencia = new Existencia();
            $existencias = $existencia->listar();
            $bodega = new Bodega();
            $bodegas = $bodega->listar();
            $producto = new Producto();
            $productos = $producto->listar();
            require_once 'views/administrador/existencias.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }
    public function registrarExistencia()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                require_once 'models/Existencias.php';
                $bodega_id = isset($_POST['bodega_id']) ? $_POST['bodega_id'] : false;
                $producto_id = isset($_POST['producto_id']) ? $_POST['producto_id'] : false;
                $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : false;
                if ($bodega_id && $producto_id && $cantidad) {
                    $existencia = new Existencia();
                    $existencia->setBodega_id($bodega_id);
                    $existencia->setProducto_id($producto_id);
                    $existencia->setCantidad($cantidad);
                    $save = $existencia->insertar();
                    if ($save) {
                        $_SESSION['alert'] = 'register_complete';
                        header("Location:" . base_url . 'administrador/existencias');
                        die();
                    } else {
                        $_SESSION['alert'] = 'register_failed';
                        header("Location:" . base_url . 'administrador/existencias');
                        die();
                    }
                }
                $_SESSION['alert'] = 'register_failed';
                header("Location:" . base_url . 'administrador/existencias');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function eliminarExistencia()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST['id'])) {
                require 'models/Existencias.php';
                $existencia = new Existencia();
                $existencia->setId($_POST['id']);
                $delete = $existencia->eliminar();
                if ($delete) {
                    $_SESSION['alert'] = 'delete_complete';
                    header("Location:" . base_url . 'administrador/existencias');
                    die();
                } else {
                    $_SESSION['alert'] = 'delete_failed';
                    header("Location:" . base_url . 'administrador/existencias');
                    die();
                }
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'administrador/existencias');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function perfilExistencia()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if ($_GET) {
                require_once 'models/Existencias.php';
                require_once 'models/Bodega.php';
                require_once 'models/Producto.php';

                $existencia = new Existencia();
                $id = isset($_GET['id']) ? $_GET['id'] : false;
                $existencia->setId($id);
                $existencia = $existencia->buscar()->fetch_object();
                $bodega = new Bodega();
                $bodegas = $bodega->listar();
                $producto = new Producto();
                $productos = $producto->listar();

                require_once 'views/administrador/ver-existencia.php';
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function actualizarExistencia()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'administrador') {
            if (isset($_POST)) {
                require_once 'models/Existencias.php';
                $bodega_id = isset($_POST['bodega_id']) ? $_POST['bodega_id'] : false;
                $producto_id = isset($_POST['producto_id']) ? $_POST['producto_id'] : false;
                $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : false;
                if ($bodega_id && $producto_id && $cantidad) {
                    $existencia = new Existencia();
                    $existencia->setId($_POST['id']);
                    $existencia->setBodega_id($bodega_id);
                    $existencia->setProducto_id($producto_id);
                    $existencia->setCantidad($cantidad);
                    $save = $existencia->actualizar();
                    if ($save) {
                        $_SESSION['alert'] = 'update_complete';
                        header("Location:" . base_url . 'administrador/perfilExistencia&id=' . $existencia->getId());
                        die();
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'administrador/perfilExistencia&id=' . $existencia->getId());
                        die();
                    }
                }
                $_SESSION['alert'] = 'update_failed';
                header("Location:" . base_url . 'administrador/perfilExistencia&id=' . $existencia->getId());
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
}
