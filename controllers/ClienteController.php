<?php

class ClienteController
{

    public function login()
    {
        if (!isset($_SESSION['usuario'])) {
            require 'models/Administrador.php';
            $cliente = new Cliente();
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cliente->setEmail($email);
            $cliente->setPassword($password);
            $res = $cliente->login();
            if ($res) {
                $_SESSION['usuario'] = $cliente;
                $_SESSION['rol'] = 'cliente';
                header("Location:" . base_url . 'cliente/index');
                die();
            } else {
                $_SESSION['alert'] = 'login_failed';
                header("Location:" . base_url . 'home/secret');
                die();
            }
        }
        // require_once 'views/administrador/home.php';
    }
    public function logout()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'cliente') {
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
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'cliente') {
            require 'models/Producto.php';
            $producto = new Producto();
            $productos = $producto->listar();

            require 'views/cliente/home.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }

    public function perfil()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'cliente') {
            $id = $_SESSION['usuario']->id;
            require_once 'models/Cliente.php';
            $cliente = new Cliente();
            $cliente->setId($id);
            $_SESSION['usuario'] = $cliente->buscar()->fetch_object();
            require_once 'views/cliente/perfil.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }

    public function actualizar()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'cliente') {
            if ($_POST) {
                $id = $_SESSION['usuario']->id;
                $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
                $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $documento = isset($_POST['documento']) ? $_POST['documento'] : false;
                $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : false;
                $email = isset($_POST['email']) ? $_POST['email'] : false;
                $celular = isset($_POST['celular']) ? $_POST['celular'] : false;
                if ($nombres && $apellidos && $documento && $fecha_nacimiento && $email && $celular) {
                    require_once 'models/Cliente.php';
                    $cliente = new Cliente();
                    $cliente->setId($id);
                    $cliente->setNombres($nombres);
                    $cliente->setApellidos($apellidos);
                    $cliente->setDocumento($documento);
                    $cliente->setFecha_nacimiento($fecha_nacimiento);
                    $cliente->setEmail($email);
                    $cliente->setCelular($celular);
                    $update = $cliente->actualizar();
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
                $_SESSION['alert'] = 'update_failed';
                header("Location:" . base_url . 'cliente/perfil');
                die();
            }
        }
        header("Location:" . base_url . 'home/login');
    }

    public function actualizarClave()
    {
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'cliente') {
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
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'cliente') {
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
        if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'cliente') {
        }
        header("Location:" . base_url . 'home/login');
    }
}
