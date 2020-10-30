<?php
class HomeController
{
    public function index()
    {
        require_once 'views/home.php';
    }
    public function login()
    {
        if (!isset($_SESSION['usuario'])) {
            require 'views/login.php';
            die();
        }
        header("Location:" . base_url . $_SESSION['rol'] . '/index');
    }
    public function secret()
    {
        // utils::deleteSesion('usuario');
        // utils::deleteSesion('rol');
        if (!isset($_SESSION['usuario'])) {
            require_once 'views/login-admin.php';
            die();
        }
        header("Location:" . base_url . $_SESSION['rol'] . '/index');
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
    public function loginUsuario()
    {
        if (!isset($_SESSION['usuario'])) {
            if ($_POST) {
                $rol = isset($_POST['rol']) ? $_POST['rol'] : false;
                switch ($rol) {
                    case 'cliente':
                        if (!isset($_SESSION['usuario'])) {
                            require 'models/Cliente.php';
                            $cliente = new Cliente();
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $cliente->setEmail($email);
                            $cliente->setPassword($password);
                            $res = $cliente->login();
                            if ($res) {
                                $_SESSION['usuario'] = $res;
                                $_SESSION['rol'] = 'cliente';
                                header("Location:" . base_url . 'cliente/index');
                                die();
                            } else {
                                $_SESSION['alert'] = 'login_failed';
                                header("Location:" . base_url . 'home/secret');
                                die();
                            }
                        }
                        break;
                    case 'vendedor':
                        break;
                    default:
                        break;
                }
            }
        }
    }
}
