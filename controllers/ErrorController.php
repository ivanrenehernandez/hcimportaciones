<?php
class ErrorController
{
    public function error404()
    {
        if (isset($_SESSION['usuario'])) {
            require_once 'views/UError404.php';
        } else {
            require_once 'views/Error404.php';
        }
    }
}
