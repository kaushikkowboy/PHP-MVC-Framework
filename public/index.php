<?php

require('../_core/_Router.php');
$router = new _Router;

//Add some routes
$router->add('',['controller' => 'Home', 'action' => 'index']); //Default home page
$router->add('posts',['controller' => 'Posts', 'action' => 'index']); //Posts index fn
//$router->add('posts/new',['controller' => 'Posts', 'action' => 'new']); //Posts add fn
$router->add('{controller}/{action}'); 
$router->add('{controller}/{id:\d+}/{action}');
$url = $_SERVER['QUERY_STRING'];
 
 //Checking The url and getting Routes from route table

if($router->match($url)){
	echo '<pre>';
	var_dump($router->getParams());
}else{
	echo 'No route found for URL'.$url;
}