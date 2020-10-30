<?php
require_once 'modeloBase.php';
class Carrito extends modeloBase
{
    private $id, $cliente_id, $estado;

    function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCliente_id()
    {
        return $this->cliente_id;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);
    }

    public function setCliente_id($cliente_id)
    {
        $this->cliente_id = $this->db->real_escape_string($cliente_id);
    }

    public function setEstado($estado)
    {
        $this->estado = $this->db->real_escape_string($estado);
    }

    public function insertar()
    {
        $tabla = 'carrito';
        $campos = '(cliente_id)';
        $valores = "('{$this->getCliente_id()}')";
        return parent::registrar($tabla, $campos, $valores);
    }
}
