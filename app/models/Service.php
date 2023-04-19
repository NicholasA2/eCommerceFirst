<?php
namespace app\models;

use app\core\TimeHelper;

class Service extends \app\core\Model{
	public $service_id;
	#[\app\validators\NonNull]
	#[\app\validators\NonEmpty]
	protected $description;
	#[\app\validators\NonNull]
	#[\app\validators\DateTime]
	protected $datetime; //protected to force the execution of __set (and __get) in Model
	public $client_id;
	public $branch_id;
//	public $name;

	protected function setdatetime($value){
		//on setting, change the timezone
		$this->datetime = TimeHelper::DTInput($value);
	}

	protected function setdescription($value){
		$this->description = htmlentities($value, ENT_QUOTES);
	}

	//protected to force execution of __call in Model
	protected function insert(){
		$SQL = "INSERT INTO service (description, datetime, client_id, branch_id) value (:description, :datetime, :client_id, :branch_id)";
		$STH = self::$connection->prepare($SQL);
		$data = [
			'description'=>$this->description,
			'datetime'=>$this->datetime,
			'client_id'=>$this->client_id, 
			'branch_id'=>$this->branch_id
		];
		$STH->execute($data);
		$this->service_id = self::$connection->lastInsertId();
	}

	protected function update(){
		$SQL = "UPDATE service SET description=:description, datetime=:datetime, branch_id=:branch_id WHERE service_id=:service_id";
		$STH = self::$connection->prepare($SQL);
		$data = [
					'description'=>$this->description,
					'datetime'=>$this->datetime,
					'branch_id'=>$this->branch_id,
					'service_id'=>$this->service_id
				];
		$STH->execute($data);
		return $STH->rowCount();
	}

	public function delete(){
		$SQL = "DELETE FROM service WHERE service_id=:service_id";
		$STH = self::$connection->prepare($SQL);
		$data = ['service_id'=>$this->service_id];
		$STH->execute($data);
		return $STH->rowCount();
	}

	public function getAllForClient($client_id){
		//$SQL = "SELECT * FROM service WHERE client_id=:client_id";

		$SQL = "SELECT * FROM service JOIN branch 
		ON service.branch_id = branch.branch_id
		WHERE client_id=:client_id";

		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id'=>$client_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Service');
		return $STH->fetchAll();
	}

	public function get($service_id){
		$SQL = 'SELECT * FROM service JOIN branch ON service.branch_id = branch.branch_id WHERE service_id=:service_id';

		$STH = self::$connection->prepare($SQL);
		$STH->execute(['service_id'=>$service_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Service');
		return $STH->fetch();
	}

	public function getClient(){
		$SQL = "SELECT * FROM client WHERE client_id = :client_id";
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id'=>$this->client_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Client');
		return $STH->fetch();
	}

}