<?php 
//entry point to the application
//include the dependencies
require_once 'app/core/init.php';
//to include external files in PHP we can use include, include_once, require and require_once
//require is for stuff you need
//include can be less fatal
//_once is to insure things are only included once
new app\core\App;