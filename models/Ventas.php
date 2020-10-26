<?php
require_once 'modeloBase.php';
class Venta extends modeloBase
{
    private $id, $vendedor_id, $carrito_id;

    function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getVendedor_id()
    {
        return $this->vendedor_id;
    }

    public function getCarrito_id()
    {
        return $this->carrito_id;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);
    }

    public function setVendedor_id($vendedor_id)
    {
        $this->vendedor_id = $this->db->real_escape_string($vendedor_id);
    }

    public function setCarrito_id($carrito_id)
    {
        $this->carrito_id = $this->db->real_escape_string($carrito_id);
    }
}
