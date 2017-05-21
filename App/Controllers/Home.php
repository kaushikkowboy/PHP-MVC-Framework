<?php
namespace App\Controllers;

class Home extends \Core\Controller {
	protected function before(){
		echo '(before)';
		// return false; //flag for checking auth before executing function
	}
	protected function after(){
		echo '(after)';
	}


	public function indexAction(){
		echo 'Hello from Home index function';
	}
}