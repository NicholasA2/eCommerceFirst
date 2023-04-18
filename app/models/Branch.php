<?php
namespace app\models;

use \app\core\TimeHelper;

class Branch extends \app\core\Model{
	public $branch_id;
	public $name;
	public $street;
	public $city;
	public $province;
	public $postal;

	public function getAll(){
		$SQL = "SELECT * FROM branch WHERE client_id=:client_id";
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id'=>$client_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Service');
		return $STH->fetchAll();
	}
}