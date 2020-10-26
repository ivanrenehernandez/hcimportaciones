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
}
