<?php
require_once 'modeloBase.php';
class Carrito extends modeloBase
{
    private $id, $cliente_id, $existencia_id, $cantidad;

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

    public function getExistencia_id()
    {
        return $this->existencia_id;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);

        return $this;
    }

    public function setCliente_id($cliente_id)
    {
        $this->cliente_id = $this->db->real_escape_string($cliente_id);

        return $this;
    }

    public function setExistencia_id($existencia_id)
    {
        $this->existencia_id = $this->db->real_escape_string($existencia_id);

        return $this;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $this->db->real_escape_string($cantidad);

        return $this;
    }
}
