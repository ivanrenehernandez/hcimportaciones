<?php
class Conexion
{
	public static function connect()
	{
		$db = new mysqli('us-cdbr-east-02.cleardb.com:3306', 'b687065cd3ef28', '6d4fe31e', 'heroku_839e95a79aa9f67');
		// $db = new mysqli('localhost:3308', 'root', '', 'tienda_master');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}
}
// mysql://b687065cd3ef28:6d4fe31e@us-cdbr-east-02.cleardb.com/heroku_839e95a79aa9f67?reconnect=true
