<?php 
namespace app\controllers;

class Client extends \app\core\Controller{
	public function index(){
		$client = new \app\models\Client();
		echo "Client index";
	}

	public function create(){
		if(isset($_POST['action'])){
			//make a new client
			$client = new \app\models\Client();
			//populate the client
			$client->first_name = $_POST['first_name'];
			$client->last_name = $_POST['last_name'];
			$client->middle_name = $_POST['middle_name'];
			//invoke the insert method
			$client->insert();
			header('location:/Client/index');
		}else{
			$this->view('Client/create');
		}
	}
}