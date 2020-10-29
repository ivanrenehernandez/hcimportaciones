<?php
require_once 'modeloBase.php';
class Producto extends modeloBase
{
    private $id, $categoria_id, $calidad_id, $titulo, $descripcion, $precio, $fecha_registro;

    function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    public function getCalidad_id()
    {
        return $this->calidad_id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);
    }

    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }

    public function setCalidad_id($calidad_id)
    {
        $this->calidad_id = $this->db->real_escape_string($calidad_id);
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $this->db->real_escape_string($titulo);
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);
    }

    public function getCategoria()
    {
        $tabla = 'categoria';
        $campos = '*';
        $id = $this->getCalidad_id();
        return parent::selectOne($tabla, $campos, $id);
    }
    public function buscar()
    {
        $tabla = 'producto p';
        $campos = 'p.id ,p.titulo, p.descripcion, p.precio, c.id AS categoria_id, a.id AS calidad_id,c.nombre AS categoria, a.nombre AS calidad';
        $tabla2 = 'categoria c';
        $join = 'p.categoria_id = c.id';
        $tabla3 = 'calidad a';
        $join2 = 'p.calidad_id = a.id';
        $id = 'p.id = ' . $this->getId();
        return parent::selectOneJoin2($tabla, $campos, $tabla2, $join, $tabla3, $join2, $id);
    }
    public function actualizar()
    {
        $tabla = 'producto';
        $campos = "categoria_id = '{$this->getCategoria_id()}', calidad_id = '{$this->getCalidad_id()}', titulo = '{$this->getTitulo()}', descripcion = '{$this->getDescripcion()}', precio = '{$this->getPrecio()}'";
        $id = 'id = ' . $this->getId();
        return parent::update($tabla, $campos, $id);
    }
    public function listar()
    {
        $tabla = 'producto p';
        $campos = 'p.id ,p.titulo, p.descripcion, p.precio, c.nombre AS categoria, a.nombre AS calidad';
        $tabla2 = 'categoria c';
        $join = 'p.categoria_id = c.id';
        $tabla3 = 'calidad a';
        $join2 = 'p.calidad_id = a.id';
        $order = 'p.id';
        return parent::select2Join($tabla, $campos, $tabla2, $join, $tabla3, $join2, $order);
    }
    public function insertar()
    {
        $tabla = 'producto';
        $campos = '(titulo, descripcion, precio, categoria_id, calidad_id, fecha_registro)';
        $fecha = getdate();
        $valores = "('{$this->getTitulo()}','{$this->getDescripcion()}','{$this->getPrecio()}','{$this->getCategoria_id()}','{$this->getCalidad_id()}','{$fecha}')";
        return parent::registrar($tabla, $campos, $valores);
    }

    public function eliminar()
    {
        $tabla = 'producto';
        $id = 'id = ' . $this->getId();
        return parent::delete($tabla, $id);
    }
}
