<?php
require_once 'modeloBase.php';
class Producto extends modeloBase
{
    private $id, $categoria_id, $calidad_id, $titulo, $descripcion, $precio;

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
}
