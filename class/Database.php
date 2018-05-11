<?php 

class Database {

	//Private database private and static
	private static $database;


	public static function getConnect(){

		if(!self::$database) {

			$host = "localhost";
			$user = "root";
			$pass = "root";
			$name = "mundial";

			$params = "mysql:host=$host;dbname=$name;charset=utf8";

			try {

				self::$database = new PDO($params, $user, $pass);
				
			} catch (Exception $e) {

				echo "No se conecto a la base de datos: " . $e->getMessage();;
				
			}

		}

		return self::$database;

	}


}

 ?>