<?php
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
