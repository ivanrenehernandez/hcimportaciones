<?php
require_once 'modeloBase.php';
class Cliente extends modeloBase
{
    private $id, $nombres, $apellidos, $documento, $fecha_nacimiento, $celular, $email, $password;

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

    public function getFecha_nacimiento()
    {
        return $this->fecha_nacimiento;
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

    public function setFecha_nacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $this->db->real_escape_string($fecha_nacimiento);
    }

    public function login()
    {
        $cliente = $this->seleccionarUno();
        if ($cliente && $cliente->num_rows == 1) {
            $cliente = $cliente->fetch_object();
            if ($this->getPassword() == $cliente->password) {
                return $cliente;
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

    public function insertar()
    {
        $tabla = 'cliente';
        $campos = '(nombres, apellidos, documento, celular, fecha_nacimiento, email, password)';
        $valores = "('{$this->getNombres()}','{$this->getApellidos()}','{$this->getDocumento()}','{$this->getCelular()}','{$this->getFecha_nacimiento()}','{$this->getEmail()}','{$this->getPassword()}')";
        return parent::registrar($tabla, $campos, $valores);
    }


    public function listar()
    {
        $tabla = 'cliente';
        $id = 'id';
        return parent::selectTotal($tabla, $id);
    }

    public function eliminar()
    {
        $tabla = 'cliente';
        $id = 'id = ' . $this->getId();
        return parent::delete($tabla, $id);
    }

    public function buscar()
    {
        $tabla = 'cliente';
        $campos = '*';
        $id = 'id = ' . "'{$this->getId()}'";
        return parent::selectOne($tabla, $campos, $id);
    }

    public function actualizar()
    {
        $tabla = 'cliente';
        $campos = "nombres = '{$this->getNombres()}', apellidos = '{$this->getApellidos()}', fecha_nacimiento = '{$this->getFecha_nacimiento()}', celular = '{$this->getCelular()}', email = '{$this->getEmail()}', password = '{$this->getPassword()}', documento = '{$this->getDocumento()}'";
        $id = 'id = ' . $this->getId();
        return parent::update($tabla, $campos, $id);
    }

    private function seleccionarUno()
    {
        $tabla = 'cliente e';
        $campos = 'e.id, e.email, e.password';
        $id = 'e.email = ' . "'{$this->getEmail()}'";
        return parent::selectOne($tabla, $campos, $id);
    }
}
