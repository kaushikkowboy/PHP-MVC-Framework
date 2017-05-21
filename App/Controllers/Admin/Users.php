<?php
namespace App\Controllers\Admin;

class Users extends \Core\Controller
{
	// Before - filter
	protected function before(){
		//Make sure an admin user is logged in for example 
		//return false;
	}

	public function indexAction(){
		echo 'Hello from Admin index function';
	}
}