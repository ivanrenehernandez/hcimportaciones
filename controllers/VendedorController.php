<?php

class VendedorController
{

    public function logout()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'vendedor') {
            $_SESSION['logout'] = '1';
            utils::deleteSesion('usuario');
            utils::deleteSesion('rol');
            header("Location:" . base_url . 'home/login');
            die();
        }
        header("Location:" . base_url . 'home/secret');
    }

    public function index()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
            require 'models/Categoria.php';

            $categoria = new Categoria();
            $categorias = $categoria->listar();

            require 'models/Calidad.php';
            $calidad = new Calidad();
            $calidades = $calidad->listar();

            require 'models/Producto.php';
            $producto = new Producto();
            $productos = $producto->listar();

            require 'views/vendedor/home.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }

    public function registrarProducto()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
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
                        header("Location:" . base_url . 'vendedor/index');
                        die();
                    } else {
                        $_SESSION['alert'] = 'register_failed';
                        header("Location:" . base_url . 'vendedor/index');
                        die();
                    }
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'vendedor/index');
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function eliminarProducto()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
            if (isset($_POST['id'])) {
                require 'models/Producto.php';
                $producto = new Producto();
                $producto->setId($_POST['id']);
                $delete = $producto->eliminar();
                if ($delete) {
                    $_SESSION['alert'] = 'delete_complete';
                    header("Location:" . base_url . 'vendedor/index');
                    die();
                } else {
                    $_SESSION['alert'] = 'delete_failed';
                    header("Location:" . base_url . 'vendedor/index');
                    die();
                }
            } else {
                $_SESSION['alert'] = 'delete_failed';
                header("Location:" . base_url . 'vendedor/index');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function perfilProducto()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
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

                require_once 'views/vendedor/ver-producto.php';
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }
    public function actualizarProducto()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
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
                        header("Location:" . base_url . 'vendedor/perfilProducto&id=' . $id);
                        die();
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'vendedor/perfilProducto&id=' . $id);
                        die();
                    }
                } else {
                    $_SESSION['alert'] = 'update_failed';
                    header("Location:" . base_url . 'vendedor/perfilProducto&id=' . $id);
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    public function perfil()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
            $id = $_SESSION['usuario']->id;
            require_once 'models/vendedor.php';
            $vendedor = new Vendedor();
            $vendedor->setId($id);
            $_SESSION['usuario'] = $vendedor->buscar()->fetch_object();
            require_once 'views/vendedor/perfil.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }

    public function actualizar()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
            if ($_POST) {
                $id = $_SESSION['usuario']->id;
                $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
                $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $documento = isset($_POST['documento']) ? $_POST['documento'] : false;
                $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : false;
                $email = isset($_POST['email']) ? $_POST['email'] : false;
                $celular = isset($_POST['celular']) ? $_POST['celular'] : false;
                if ($nombres && $apellidos && $documento && $fecha_nacimiento && $email && $celular) {
                    require_once 'models/Vendedor.php';
                    $vendedor = new Vendedor();
                    $vendedor->setId($id);
                    $vendedor->setNombres($nombres);
                    $vendedor->setApellidos($apellidos);
                    $vendedor->setDocumento($documento);
                    $vendedor->setFecha_nacimiento($fecha_nacimiento);
                    $vendedor->setEmail($email);
                    $vendedor->setCelular($celular);
                    $update = $vendedor->actualizar();
                    if ($update) {
                        $_SESSION['usuario'] = $vendedor->buscar()->fetch_object();
                        $_SESSION['alert'] = 'update_complete';
                        header("Location:" . base_url . 'vendedor/perfil');
                        die();
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'vendedor/perfil');
                        die();
                    }
                }
                $_SESSION['alert'] = 'update_failed';
                header("Location:" . base_url . 'vendedor/perfil');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    public function actualizarClave()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
            if ($_POST) {
                $id = $_SESSION['usuario']->id;
                $password = isset($_POST['password']) ? $_POST['password'] : false;
                require_once 'models/Vendedor.php';
                $vendedor = new Vendedor();
                $vendedor->setId($id);
                $vendedor->setPassword($password);
                $update = $vendedor->actualizarClave();
                if ($update) {
                    $_SESSION['alert'] = 'update_complete';
                    header("Location:" . base_url . 'vendedor/perfil');
                    die();
                } else {
                    $_SESSION['alert'] = 'update_failed';
                    header("Location:" . base_url . 'vendedor/perfil');
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }
}
