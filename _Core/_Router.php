<?php
class _Router{
protected $routes =[];

//Add function will add routes in routing table
public function add($route, $params = []){
	//Convert the route to a regular expression(escape forward slashes)
	$route = preg_replace('/\//', '\\/', $route);
	//convert variables {controller} {action}
	$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
	//convert variables with custom regular expression {id:\d+}
	$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
	//Add start and end delimiters, and case censitive flag
	$route = '/^'. $route . '$/i';

	$this->routes[$route] =  $params;
}

//Get all routes from routing table
public function getRoutes(){
	return $this->routes;
}

//Match the routes in routing table, if it's there then set $params
public function match($url){ 
	//$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
	foreach ($this->routes as $route => $params) {
		if(preg_match($route, $url, $matches)){
			//$params = [];
			foreach ($matches as $key => $match) {
				if(is_string($key)){
					$params[$key]= $match;
				}
			}
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