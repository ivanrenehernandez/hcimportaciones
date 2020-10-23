<?php
class Conexion{
	public static function connect(){
		$db = new mysqli('localhost:3308', 'root', '', 'tienda_master');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}
}

