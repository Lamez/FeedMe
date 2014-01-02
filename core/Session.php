<?php
	class Session{
		public function __construct(){
			$this->start();
		}
		//Functions: make and add are the same. :)
		public function make($name, $value = NULL){
			$_SESSION[$name] = $value;
		}
		public function add($name, $value = NULL){
			$_SESSION[$name] = $value;
		}
		public function change($name, $value){
			if(isset($_SESSION[$name]))
				$_SESSION[$name] = $value;
			else
				$this->make($name, $value);
		}
		public function get($name){
			if(isset($_SESSION[$name]))
				return $_SESSION[$name];
			else
				return NULL;
		}
		public function exists($name){
			return isset($name); 
		}
		public function remove($name){
			if(isset($_SESSION[$name]))
				unset($_SESSION[$name]);
		}
		public function removeAll(){
			$this->destroy();
			$this->start();
		}
		public function start(){
			@session_start();
		}
		public function destroy(){
			@session_destroy();
		}
		public function displayAll(){
			print_r($_SESSION);
		}
		public function toString(){
			$this->displayAll();
		}
		public function display($name){
			if(isset($name))
				echo $_SESSION[$name];
			else
				echo "";
		}
	}
?>