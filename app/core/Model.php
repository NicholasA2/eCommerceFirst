<?php
namespace app\core;

use PDO;

class Model{
	public static ?PDO $connection = null;
	public function __construct(){
		
		if(self::$connection == null){
			$host = 'localhost';
			$dbname = 'webapplication';
			$user = 'root';
			$pass = '';
			$charset = 'utf8mb4';
			try {
				self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass);
				self::$connection->query("SET NAMES $charset");
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
}