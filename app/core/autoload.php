<?php
spl_autoload_register(
	function($class_name){
		//for linux/unix/macOS compatibility....
		$class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
		require_once($class_name . '.php');
	}
);