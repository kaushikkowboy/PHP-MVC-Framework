<?php
namespace Core;
class Router{
protected $routes =[];

//Add function will add routes in routing table
public function add($route, $params = []){
	//Convert the route to a regular expression(escape forward slashes)
	$route = preg_replace('/\//', '\\/', $route);
	//convert variables {controller} {action}
	$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
	//convert variables with custom regular expression {id:\d+}
	$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)',$route);
	//Add start and end delimiters, and case censitive flag
	$route = '/^'. $route . '$/i';

	$this->routes[$route] =  $params;
}

//Get all routes from r outing table
public function getRoutes(){
	return $this->routes;
}

//Match the routes in routing table, if it's there then set $params
public function match($url){  
	foreach ($this->routes as $route => $params) {
		if(preg_match($route, $url, $matches)){ 
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

//This fucntion is for create controller object and run that action
public function dispatch($url){
	$url = $this->removeQueryStringVariables($url);
	if($this->match($url)){
		$controller = $this->params['controller'];
		$controller = $this->convertToStudlyCaps($controller); 
		// $controller = "App\Controllers\\$controller";
		$controller = $this->getNamespace().$controller;
		if(class_exists($controller)){
			$controller_object = new $controller($this->params);

			$action = $this->params['action'];
			$action = $this->convertToCamelCase($action);

			if(is_callable([$controller_object,$action])){
				$controller_object->$action();
			} else{
				echo "Method $action (in controller $controller) not found";
			}
		} else{
			echo "Controller class $controller not found";
		}
	} else{
		echo "No route matched";
	}
}


protected function convertToStudlyCaps($string){
	return str_replace(' ','', ucwords(str_replace('-',' ',$string)));
} 

protected function convertToCamelCase($string){
	return lcfirst($this->convertToStudlyCaps($string));
}

// A URL Of the format localhost/?page (one variable name , no value) won't work however. 
protected function removeQueryStringVariables($url){
	if($url != ''){
		$parts = explode('&', $url , 2);
		if(strpos($parts[0], '=') === false){
			$url = $parts[0];
		}else{
			$url = '';
		}
	}
	return $url;
}

protected function getNamespace(){
	$namespace = 'App\Controllers\\';
	if(array_key_exists('namespace', $this->params)){
		$namespace .= $this->params['namespace'].'\\';
	}
	return $namespace;
}


}