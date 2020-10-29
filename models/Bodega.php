<?php
require_once 'modeloBase.php';
class Bodega extends modeloBase
{
    private $id, $nombre;

    function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function listar()
    {
        $tabla = 'bodega';
        $id = 'id';
        return parent::selectTotal($tabla, $id);
    }

    public function insertar()
    {
        $tabla = 'bodega';
        $campos = '(nombre)';
        $valores = "('{$this->getNombre()}')";
        return parent::registrar($tabla, $campos, $valores);
    }

    public function buscar()
    {
        $tabla = 'calidad';
        $campos = '*';
        $id = 'id = ' . "'{$this->getId()}'";
        return parent::selectOne($tabla, $campos, $id);
    }

    public function actualizar()
    {
        $tabla = 'calidad';
        $campos = "nombre = '{$this->getNombre()}'";
        $id = 'id = ' . $this->getId();
        return parent::update($tabla, $campos, $id);
    }

    public function eliminar()
    {
        $tabla = 'calidad';
        $id = 'id = ' . $this->getId();
        return parent::delete($tabla, $id);
    }
}
