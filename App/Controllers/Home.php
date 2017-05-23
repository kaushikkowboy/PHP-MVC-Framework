<?php
namespace App\Controllers;
use \Core\View;
class Home extends \Core\Controller {
	protected function before(){
		echo '(before)';
		// return false; //flag for checking auth before executing function
	}
	protected function after(){
		echo '(after)';
	}


	public function indexAction(){
		View::render('Home/index.php', [
			'name' => 'Kaushik',
			'knows' => ['HTML','CSS','PHP'] 
			]);
	}
}