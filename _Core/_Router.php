<?php
class _Router{
protected $routes =[];

//Add function will add routes in routing table
public function add($route, $params){
	$this->routes[$route] =  $params;
}

//Get all routes from routing table
public function getRoutes(){
	return $this->routes;
}

//Match the routes in routing table, if it's there then set $params
public function match($url){
	foreach ($this->routes as $route => $params) {
		if($url == $route){
			$this->params = $params;
			return true;
		}
	}
	return false;
}

//Get currently matched parameters
public function getParams(){
	return $this->params;
}

}