<?php
namespace Core;
// Base Controller

abstract class Controller{ // abstract class. because we are not going to create any obj directly

	protected $route_params =[];

	public function __construct($route_params){
		$this->route_params = $route_params;
	}

	public function __call($name, $args){ //Action Filter
		$method = $name.'Action';
		if(method_exists($this, $method)){
			if($this->before()!== false){
				call_user_func_array([$this,$method], $args);
				$this->after();
			}
		} else {
			echo "Method $method not found in controller".get_class($this);
		}
	}

	// Before filter - called before an action method
	protected function before(){

	}

	// After filter - called after an action method
	protected function after(){
		
	}
}