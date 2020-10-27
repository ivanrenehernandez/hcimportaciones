<?php
class utils
{
    public static function deleteSesion($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }
    public static function deleteRequest($name)
    {
        if (isset($_REQUEST[$name])) {
            $_REQUEST[$name] = null;
            unset($_REQUEST[$name]);
        }
        return $name;
    }
}
