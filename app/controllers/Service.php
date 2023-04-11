<?php
namespace app\controllers;

// use DateTime;
// use IntlDateFormatter;
use \app\core\TimeHelper;

class Service extends \app\core\Controller{
	public function index($client_id){//parent id
		$client = new \app\models\Client();
		$client = $client->get($client_id);
		$this->view('Service/index', $client);
	}

	public function create($client_id){//parent id
		if(isset($_POST['action'])){
			//make a new client
			$service = new \app\models\Service();
			//populate the client
			$service->description = htmlentities($_POST['description']);
			$service->datetime = TimeHelper::DTInput($_POST['datetime']);
			$service->client_id = $client_id;
			//invoke the insert method
			$service->insert();
			//back to the list of clients
			header('location:/Service/index/' . $client_id);
		}else{
			$client = new \app\models\Client();
			$client = $client->get($client_id);
			$this->view('Service/create', $client);
		}
	}

	public function delete($service_id){//PK value
		$service = new \app\models\Service();
		$service = $service->get($service_id);
		//$client = $service->getClient(); //do this in the view
		if(isset($_POST['action'])){
			//proceed with deletion
			$client_id = $service->client_id;
			$service->delete();
			header('location:/Service/index/' . $client_id);
		}else{
			$this->view('Client/delete', $service);
		}
	}

	public function edit($service_id){
		//modify a service record
		$service = new \app\models\Service();
		$service = $service->get($service_id);

		if(isset($_POST['action'])){
			//save the changes to the object
			$service->description = htmlentities($_POST['description']);
			$service->datetime = TimeHelper::DTInput($_POST['datetime']);
			//we don't change key values
			//save the changes to the database
			$service->update();
			$client_id = $service->client_id
			header('location:/Service/index/' . $client_id);
		}else{
			$this->view('Service/edit', $service);
		}
	}

	// public function date(){
	// 	//TODO: get the user timezone choice (get this from the browser)
	// 	$date = new DateTime();
	// 	//$date = new DateTime('Tuesday, April 4, 2023, 15:23:06');

	// 	global $lang;
	// 	echo TimeHelper::DTOutput($date, $lang, 'America/Toronto');
	// }

}