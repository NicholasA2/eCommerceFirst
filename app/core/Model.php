<?php
namespace app\core;

use PDO;
use ReflectionClass;

class Model{
	public static ?PDO $connection = null;
	public function __construct(){
		
		if(self::$connection == null){
			//load the .env file from the given folder
			$env = \Dotenv\Dotenv::createImmutable(getcwd());
			$env->load();
			$env->required(['db_host','db_user','db_pass','db_name','db_charset'])->notEmpty();
			$host = $_ENV['db_host'];
			$dbname = $_ENV['db_name'];
			$user = $_ENV['db_user'];
			$pass = $_ENV['db_pass'];
			$charset = $_ENV['db_charset'];
			try {
				$options = [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
					PDO::ATTR_EMULATE_PREPARES => false
				];

				self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass, $options);
				self::$connection->query("SET NAMES $charset");
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	public function isValid() : bool{
		//the goal of this function is to validate the data
		$reflection = new ReflectionClass($this);
		$properties = $reflection->getProperties();
		foreach ($properties as $property) {
			$attributes = $property->getAttributes(
				\app\core\Validator::class,
				\ReflectionAttribute::IS_INSTANCEOF
			);
			$data = $property->getValue($this);
			foreach ($attributes as $attribute) {
				//create an object of that validator class
				$validator = $attribute->newInstance();
				//run the validation method on the data in the property
				if(!$validator->isValid($data))
					return false;//return false on bad data
			}
		}
		return true;//return true if all the data is valid
	}

	public function __call($method, $arguments){
		if($this->isValid()){
			call_user_func_array([$this, $method], $arguments);
			//$this->$method(...$arguments);
			//$this->$method($arguments[0], $arguments[1],...);
		}
	}

	public function __set($name, $value){
		$method = "set$name";
		if(method_exists($this, $method))
			$this->$method($value);
		else
			$this->$name = $value;
	}

	public function __get($name){
		if(isset($this->$name))
			return $this->$name;
		else
			return '';
	}

}