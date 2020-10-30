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
    }

    public function setBodega_id($bodega_id)
    {
        $this->bodega_id = $this->db->real_escape_string($bodega_id);
    }

    public function setProducto_id($producto_id)
    {
        $this->producto_id = $this->db->real_escape_string($producto_id);
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $this->db->real_escape_string($cantidad);
    }

    public function productos()
    {
        $tabla = 'existencias e';
        $campos = 'e.id, e.cantidad, e.producto_id, p.titulo AS producto, p.categoria_id, a.nombre AS categoria, p.calidad_id, c.nombre AS calidad';
        $join1 = 'bodega b';
        $campos1 = 'e.bodega_id = b.id';
        $join2 = 'producto p';
        $campos2 = 'e.producto_id = p.id';
        $join3 = 'categoria a';
        $campos3 = 'p.categoria_id = a.id';
        $join4 = 'calidad c';
        $campos4 = 'p.calidad_id = c.id';
        $id = 'b.id = ' . $this->getBodega_id();
        $sql = "SELECT $campos FROM $tabla INNER JOIN $join1 ON $campos1 INNER JOIN $join2 ON $campos2 INNER JOIN $join3 ON $campos3 INNER JOIN $join4 ON $campos4 WHERE $id";
        return $this->db->query($sql);
    }

    public function listar()
    {
        $tabla = 'existencias e';
        $campos = 'e.id, e.cantidad, e.bodega_id, b.nombre AS bodega, e.producto_id, p.titulo AS producto, p.categoria_id, a.nombre AS categoria, p.calidad_id, c.nombre AS calidad';
        $join1 = 'bodega b';
        $campos1 = 'e.bodega_id = b.id';
        $join2 = 'producto p';
        $campos2 = 'e.producto_id = p.id';
        $join3 = 'categoria a';
        $campos3 = 'p.categoria_id = a.id';
        $join4 = 'calidad c';
        $campos4 = 'p.calidad_id = c.id';
        return $this->db->query("SELECT $campos FROM $tabla INNER JOIN $join1 ON $campos1 INNER JOIN $join2 ON $campos2 INNER JOIN $join3 ON $campos3 INNER JOIN $join4 ON $campos4");
    }

    public function insertar()
    {
        $tabla = 'existencias';
        $campos = '(bodega_id, producto_id, cantidad)';
        $valores = "('{$this->getBodega_id()}', '{$this->getProducto_id()}', '{$this->getCantidad()}')";
        return parent::registrar($tabla, $campos, $valores);
    }

    public function buscar()
    {
        $tabla = 'existencias';
        $campos = '*';
        $id = 'id = ' . "'{$this->getId()}'";
        return parent::selectOne($tabla, $campos, $id);
    }

    public function actualizar()
    {
        $tabla = 'existencias';
        $campos = "bodega_id = '{$this->getBodega_id()}', producto_id = '{$this->getProducto_id()}', cantidad = '{$this->getCantidad()}'";
        $id = 'id = ' . $this->getId();
        return parent::update($tabla, $campos, $id);
    }

    public function eliminar()
    {
        $tabla = 'existencias';
        $id = 'id = ' . $this->getId();
        return parent::delete($tabla, $id);
    }
}
