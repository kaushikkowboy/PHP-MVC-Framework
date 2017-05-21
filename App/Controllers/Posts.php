<?php
namespace App\Controllers;

class Posts extends \Core\Controller {

	public function indexAction(){
		echo 'Index function of Posts';
		echo '<p> Query string parameter: <pre>'.htmlspecialchars(print_r($_GET,true));
	}

	public function addNewAction(){
		echo 'Add New function of Posts';
	}

	public function editAction(){
		echo 'Hello from edit action';
		echo '<p> Route parameter: <pre>'. htmlspecialchars(print_r($this->route_params,true));
	}
}