<?php 
namespace app\models;

class Client extends \app\core\Model{
	public $client_id;
	public $first_name;
	public $last_name;
	public $middle_name;

	public function insert(){
		$SQL = "INSERT INTO client( first_name, last_name, middle_name) value (:first_name, :last_name, :middle_name)";
		$STH = $this->connection->prepare($SQL);
		$data = ['first_name'=>$this->first_name,
		 			'last_name'=>$this->last_name,
		 			'middle_name'=>$this->middle_name];
		$STH->execute($data);
		$this->client_id = $this->connection->lastInsertId();
	}

}