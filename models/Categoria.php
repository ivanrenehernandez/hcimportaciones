<?php
require_once 'modeloBase.php';
class Categoria extends modeloBase
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
        $tabla = 'categoria';
        $id = 'id';
        return parent::selectTotal($tabla, $id);
    }

    public function insertar()
    {
        $tabla = 'categoria';
        $campos = '(nombre)';
        $valores = "('{$this->getNombre()}')";
        return parent::registrar($tabla, $campos, $valores);
    }

    public function buscar()
    {
        $tabla = 'categoria';
        $campos = '*';
        $id = 'id = ' . "'{$this->getId()}'";
        return parent::selectOne($tabla, $campos, $id);
    }

    public function actualizar()
    {
        $tabla = 'categoria';
        $campos = "nombre = '{$this->getNombre()}'";
        $id = 'id = ' . $this->getId();
        return parent::update($tabla, $campos, $id);
    }

    public function eliminar()
    {
        $tabla = 'categoria';
        $id = 'id = ' . $this->getId();
        return parent::delete($tabla, $id);
    }
}
