<?php
require_once 'modeloBase.php';
class Vendedor extends modeloBase
{
    private $id, $nombres, $apellidos, $documento, $celular, $email, $password;

    function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getDocumento()
    {
        return $this->documento;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $this->db->real_escape_string($nombres);
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function setDocumento($documento)
    {
        $this->documento = $this->db->real_escape_string($documento);
    }

    public function setCelular($celular)
    {
        $this->celular = $this->db->real_escape_string($celular);
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    public function setPassword($password)
    {
        $this->password = $this->db->real_escape_string($password);
    }

    public function listar()
    {
        $tabla = 'vendedor v';
        $id = 'id';
        return parent::selectTotal($tabla, $id);
    }

    public function insertar()
    {
        $tabla = 'vendedor';
        $password = '1234';
        $campos = '(nombres, apellidos, documento, email, password, celular, fecha_nacimiento)';
        $fecha = getdate();
        $valores = "('{$this->getNombres()}','{$this->getApellidos()}','{$this->getDocumento()}','{$this->getEmail()}','{$password}','{$this->getCelular()}','{$fecha}')";
        return parent::registrar($tabla, $campos, $valores);
    }

    public function eliminar()
    {
        $tabla = 'vendedor';
        $id = 'id = ' . $this->getId();
        return parent::delete($tabla, $id);
    }
}