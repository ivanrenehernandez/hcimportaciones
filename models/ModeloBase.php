<?php
require_once 'config/db.php';
class ModeloBase extends Conexion
{
    public $db;

    public function __construct()
    {
        $this->db = Conexion::connect();
    }

    public function registrar($tabla, $campos, $valores)
    {
        $sql = "INSERT INTO $tabla $campos VALUES $valores;";
        // echo "\n sql: " . $sql . "\n";
        // die();
        return $this->db->query($sql);
    }
    public function selectOne($tabla, $campos, $id)
    {
        $sql = "SELECT $campos FROM $tabla WHERE $id;";
        // echo "\n sql: " . $sql . "\n";
        // die();
        return $this->db->query($sql);
    }
    public function selectOneJoin($tabla, $campos, $tabla2, $join, $id)
    {
        $sql = "SELECT $campos FROM $tabla INNER JOIN $tabla2 ON $join WHERE $id;";
        // echo "\n sql: " . $sql. "\n";
        // die();
        return $this->db->query($sql);
    }
    public function selectOneJoin2($tabla, $campos, $tabla2, $join, $tabla3, $join2, $id)
    {
        $sql = "SELECT $campos FROM $tabla INNER JOIN $tabla2 ON $join INNER JOIN $tabla3 ON $join2  WHERE $id;";
        // echo "\n sql: " . $sql . "\n";
        // die();
        return $this->db->query($sql);
    }
    public function selectJoin($tabla, $campos, $tabla2, $join, $id)
    {
        $sql = "SELECT $campos FROM $tabla INNER JOIN $tabla2 ON $join ORDER BY $id ASC;";
        // echo "\n sql: " . $sql. "\n";
        // die();
        return $this->db->query($sql);
    }
    public function select2Join($tabla, $campos, $tabla2, $join, $tabla3, $join2, $order)
    {
        $sql = "SELECT $campos FROM $tabla INNER JOIN $tabla2 ON $join INNER JOIN $tabla3 ON $join2  ORDER BY $order ASC;";
        // echo "\n sql: " . $sql . "\n";
        // die();
        return $this->db->query($sql);
    }
    public function selectLeftJoin($tabla, $campos, $tabla2, $join, $tabla3, $join2, $id, $order)
    {
        $sql = "SELECT $campos FROM $tabla INNER JOIN $tabla2 ON $join INNER JOIN $tabla3 ON $join2 WHERE $id ORDER BY $order ASC;";
        // echo "\n sql: " . $sql . "\n";
        // die();
        return $this->db->query($sql);
    }
    public function selectTotal($tabla, $id)
    {
        $sql = "SELECT * FROM $tabla ORDER BY $id ASC;";
        // echo "\n sql: " . $sql. "\n";
        return  $this->db->query($sql);
    }
    public function selectTotalActivity($tabla, $campos, $tabla2, $join, $tabla3, $join2,  $group)
    {
        $sql = "SELECT $campos FROM $tabla INNER JOIN $tabla2 ON $join INNER JOIN $tabla3 ON $join2  GROUP BY $group;";
        // echo "\n sql: " . $sql . "\n";
        // die();
        return $this->db->query($sql);
    }
    public function selectPesoActivity($tabla, $campos, $tabla2, $join, $tabla3, $join2,  $id)
    {
        $sql = "SELECT $campos FROM $tabla INNER JOIN $tabla2 ON $join INNER JOIN $tabla3 ON $join2 WHERE $id;";
        // echo "\n sql: " . $sql . "\n";
        // die();
        return $this->db->query($sql);
    }

    public function update($tabla, $campos, $id)
    {
        $sql = "UPDATE $tabla SET $campos WHERE $id;";
        // echo "\n sql: " . $sql . "\n";
        // die();
        return  $this->db->query($sql);
    }
    public function delete($tabla, $valor)
    {
        $sql = "DELETE FROM $tabla WHERE $valor;";
        // echo "\n sql: " . $sql . "\n";
        // die();
        return  $this->db->query($sql);
    }

    public function size(String $tabla)
    {
        $sql = "SELECT * FROM $tabla;";
        $total = $this->db->query($sql);
        // echo "\n sql: " . $sql . "\n";
        // die();
        return mysqli_num_rows($total);
    }
}
