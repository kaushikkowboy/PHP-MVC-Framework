<?php
//controller class
//require('../App/Controllers/Posts.php');

/**
*  Auto Loader
*/
spl_autoload_register(function ($class){
	$root = dirname(__DIR__); // parent directory
	$file = $root.'/'.str_replace('\\', '/', $class).'.php';
	if(is_readable($file)){
		require ($root . '/' . str_replace('\\', '/', $class).'.php');
	}
});

//router class
// require('../_core/Router.php');
$router = new Core\Router();

//Add some routes
$router->add('',['controller' => 'Home', 'action' => 'index']); //Default home page 
$router->add('{controller}/{action}'); 
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}',['namespace' => 'Admin']); 
$router->dispatch($_SERVER['QUERY_STRING']);