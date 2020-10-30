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
            require 'models/Producto.php';
            $producto = new Producto();
            $productos = $producto->listar();

            require_once 'views/vendedor/home.php';
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
                        header("Location:" . base_url . 'vendedor/index');
                        die();
                    } else {
                        $_SESSION['alert'] = 'update_failed';
                        header("Location:" . base_url . 'vendedor/index');
                        die();
                    }
                }
                $_SESSION['alert'] = 'update_failed';
                header("Location:" . base_url . 'vendedor/index');
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
                require_once 'models/Cliente.php';
                $cliente = new Cliente();
                $cliente->setId($id);
                $cliente->setPassword($password);
                $update = $cliente->actualizarClave();
                if ($update) {
                    $_SESSION['alert'] = 'update_complete';
                    header("Location:" . base_url . 'cliente/perfil');
                    die();
                } else {
                    $_SESSION['alert'] = 'update_failed';
                    header("Location:" . base_url . 'cliente/perfil');
                    die();
                }
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    public function comprar()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
            $id = $_GET['id'];
            require_once 'models/Producto.php';
            $producto = new Producto();
            $producto->setId($id);
            $producto = $producto->buscar()->fetch_object();
            require 'views/cliente/comprar-producto.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }

    public function comprarProducto()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'vendedor') {
        }
        header("Location:" . base_url . 'home/login');
    }
}
