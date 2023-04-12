<?php 
namespace app\core;

interface Validator{
	public function isValid($data) : boolean; //return true for valid data
}