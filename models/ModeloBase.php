<?php
require_once 'config/db.php';
class ModeloBase extends Conexion
{
    public $db;

    public function __construct()
    {
        $this->db = Conexion::connect();
    }
}
