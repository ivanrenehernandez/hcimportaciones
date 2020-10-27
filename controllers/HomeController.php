<?php
class HomeController
{
    public function index()
    {
        require_once 'views/home.php';
    }
    public function login()
    {
        // utils::deleteSesion('usuario');
        if (!isset($_SESSION['usuario'])) {
            require 'views/login.php';
        }
    }
    public function secret()
    {
        require_once 'views/login-admin.php';
    }

    public function registrarUsuario()
    {
        if (!isset($_SESSION['usuario'])) {
            if (isset($_POST)) {
                $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : false;
                $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $documento = isset($_POST['documento']) ? $_POST['documento'] : false;
                $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : false;
                $email = isset($_POST['email']) ? $_POST['email'] : false;
                $clave = isset($_POST['clave']) ? $_POST['clave'] : false;
                if ($nombres && $apellidos && $documento && $fecha_nacimiento && $email && $clave) {
                    require_once 'models/Cliente.php';
                    $cliente = new Cliente();
                    $cliente->setNombres($nombres);
                    $cliente->setApellidos($apellidos);
                    $cliente->setDocumento($documento);
                    $cliente->setFecha_nacimiento($fecha_nacimiento);
                    $cliente->setEmail($email);
                    $cliente->setPassword($clave);
                    $save = $cliente->insertar();
                    if ($save) {
                        $_SESSION['alert'] = 'register_complete';
                        header("Location:" . base_url . 'home/login');
                    } else {
                        $_SESSION['alert'] = 'register_failed';
                        header("Location:" . base_url . 'home/login');
                    }
                } else {
                    $_SESSION['alert'] = 'register_failed';
                    header("Location:" . base_url . 'home/login');
                }
            }
        }
    }
    public function loginCliente()
    {
        if (!isset($_SESSION['usuario'])) {
        }
    }
    public function loginAdministrador()
    {
        if (!isset($_SESSION['usuario'])) {
        }
    }
    public function loginVendedor()
    {
        if (!isset($_SESSION['usuario'])) {
        }
    }
}
