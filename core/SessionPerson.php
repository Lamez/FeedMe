<?php
	class SessionPerson extends Person{
		private $session;
		public function __construct($db, $session){
			parent::__construct($db);
			$this->session = $session;
		}
		public function login($email, $password){
			if(parent::login($email, $password)){
				$this->addVariable("LOGIN-isAuth", true);
				$this->addVariable("LOGIN-id", parent::id());
				$this->addVariable("LOGIN-email", parent::email());
				$this->addVariable("LOGIN-first_name", parent::first_name());
				$this->addVariable("LOGIN-last_name", parent::last_name());
				return true;
			}else
				return false;
		}
		public function logout(){
			$this->removeVariable("LOGIN-isAuth");
			$this->removeVariable("LOGIN-id");
			$this->removeVariable("LOGIN-email");
			$this->removeVariable("LOGIN-first_name");
			$this->removeVariable("LOGIN-last_name");
		}
		/* Get Functions */
		public function isAuth(){
			if($this->exists("LOGIN-isAuth"))
				return $this->getVariable("LOGIN-isAuth");
			else{
				$isAuth = parent::isAuth();
				$this->addVariable("LOGIN-isAuth", $isAuth);
				return $isAuth;
			}
		}
		public function id(){
			if($this->exists("LOGIN-id"))
				return $this->getVariable("LOGIN-id");
			else{
				$id = parent::getId();
				$this->addVariable("LOGIN-id", $id);
				return $id;
			}
		}
		public function email(){
			if($this->exists("LOGIN-email"))
				return $this->getVariable("LOGIN-email");
			else{
				$id = parent::getEmail();
				$this->addVariable("LOGIN-email", $id);
				return $id;
			}
		}
		public function first_name(){
			if($this->exists("LOGIN-first_name"))
				return $this->getVariable("LOGIN-first_name");
			else{
				$id = parent::getFirstName();
				$this->addVariable("LOGIN-first_name", $id);
				return $id;
			}
		}
		public function last_name(){
			if($this->exists("LOGIN-last_name"))
				return $this->getVariable("LOGIN-last_name");
			else{
				$id = parent::getLastName();
				$this->addVariable("LOGIN-last_name", $id);
				return $id;
			}
		}
		public function fullName(){
			return $this->__toString();
		}
		private function set($name, $value){
			if($this->exists("LOGIN-".$name))
				$this->changeVariable("LOGIN-".$name, $value);
			else
				$this->addVariable("LOGIN-".$name, $value);
		}
		/* Update Functions */
		/* ---------------- */
		/* Had to change the names from change to update in this class due to strict standards.
		 * In the people class, the function paramerter list calls for an id, these functions do not, therefor I cannot override them in PHP */

		public function updateFirstName($fname){
			if(parent::changeFirstName($this->id(), $fname)){
				$this->set("first_name", ucfirst($fname));
				return true;
			}
			return false;
		}
		public function updateLastName($lname){
			if(parent::changeLastName($this->id(), $lname)){
				$this->set("last_name", ucfirst($lname));
				return true;
			}
			return false;
		}
		public function updateEmail($email){
			if(parent::changeEmail($this->id(), $email)){
				$this->set("email", $email);
				return true;
			}
			return false;
		}
		public function updatePassword($password){
			return parent::changePassword($this->id(), $password);
		}
		
		/* Session Functions, only used in this class.. */
		private function getVariable($name){
			return $this->session->get($name);
		}
		private function addVariable($name, $value){
			$this->session->add($name, $value);
		}
		private function changeVariable($name, $value){
			$this->session->change($name, $value);
		}
		private function removeVariable($name){
			$this->session->remove($name);
		}
		private function exists($name){
			return $this->session->exists($name);
		}		
		//to call this function just echo the object. Example:
		//$person = new Person();
		//echo $person;
		//Output: James Little (or FirstName LastName)
		//Also fullName() calls this function.
		public function __toString(){
			return $this->first_name()." ".$this->last_name();
		}
	}
?>