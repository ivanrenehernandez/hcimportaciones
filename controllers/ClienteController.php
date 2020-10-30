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
            require 'models/Categoria.php';

            $categoria = new Categoria();
            $categorias = $categoria->listar();

            require 'models/Calidad.php';
            $calidad = new Calidad();
            $calidades = $calidad->listar();

            require 'models/Producto.php';
            $producto = new Producto();
            $productos = $producto->listar();

            require 'views/cliente/home.php';
            die();
        }
        header("Location:" . base_url . 'home/login');
    }
}
