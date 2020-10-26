<?php
require_once 'config/parametros.php';
require_once 'models/administrador.php';
class HomeController
{
    public function index()
    {
        require_once 'views/home.php';
    }
    public function login()
    {
        require 'views/login.php';
    }
}
