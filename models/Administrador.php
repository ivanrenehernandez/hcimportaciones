<?php
require_once 'modeloBase.php';
class Administrador extends modeloBase
{
    private $id, $email, $password;

    function __construct()
    {
        parent::__construct();
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPassword($password)
    {
        $this->password = $this->db->real_escape_string($password);
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);
    }

    public function login()
    {
        $admin = $this->seleccionarUno();
        if ($admin && $admin->num_rows == 1) {
            $admin = $admin->fetch_object();
            if ($this->getPassword() == $admin->password) {
                return $admin;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function logout()
    {
       utils::deleteSesion('usuario');
       utils::deleteSesion('rol');
       
    }

    private function seleccionarUno()
    {
        $tabla = 'administrador a';
        $campos = 'a.id, a.email, a.password';
        $id = 'a.email = ' . "'{$this->getEmail()}'";
        return parent::selectOne($tabla, $campos, $id);
    }
}
