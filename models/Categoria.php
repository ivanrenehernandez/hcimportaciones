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
}
