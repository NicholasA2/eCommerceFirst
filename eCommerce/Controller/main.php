<?php 
namespace app\controllers;

class Main extends app\core\Controller{
	function index() {
		$this->view('Main/index');
	}

	function index2() {
		$this->view('Main/index2');
	}

	function greetings($name = "Carl") {//optional parameter:$name
		$this->view('Main/greetings', $name);
	}
}