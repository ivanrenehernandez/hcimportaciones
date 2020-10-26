<?php
require_once 'modeloBase.php';
class Existencia extends modeloBase
{
    private $id, $bodega_id, $producto_id, $cantidad;

    function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBodega_id()
    {
        return $this->bodega_id;
    }

    public function getProducto_id()
    {
        return $this->producto_id;
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

    public function setBodega_id($bodega_id)
    {
        $this->bodega_id = $this->db->real_escape_string($bodega_id);

        return $this;
    }

    public function setProducto_id($producto_id)
    {
        $this->producto_id = $this->db->real_escape_string($producto_id);

        return $this;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $this->db->real_escape_string($cantidad);

        return $this;
    }
}
