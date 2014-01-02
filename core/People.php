<?php
	class People{
		private $db;
		public function __construct(Database $db){
			$this->db = $db;
		}
		public function fetchAllPeople(){
			$this->db->execute("SELECT * FROM ".TBL_PEOPLE);
			return $this->db->fetchAll();
		}
		public function addPerson($email, $first_name, $last_name, $password){
			$this->db->execute("INSERT INTO ".TBL_PEOPLE." 
			(email, first_name, last_name, password) VALUES ('".$email."', '".$first_name."', '".$last_name."', '".$password."')");
		}
		public function deletePerson($id){
			$this->db->delete(TBL_PEOPLE, "id = '".$id."'");
		}
		public function listInfoFromId($id){
			$this->db->execute("SELECT * FROM ".TBL_PEOPLE." WHERE id = '".$id."'");
			return $this->db->fetchAll();
		}
		public function listInfoFromEmail($email){
			$this->db->execute("SELECT * FROM ".TBL_PEOPLE." WHERE email = '".$email."'");
			$a = $this->db->fetchAll();
			return $a;
		}
		public function countPeople(){
			$this->db->execute("SELECT id FROM ".TBL_PEOPLE);
			return $this->db->numRows();
		}
		/* Validation Functions */
		public function validEmail($email){ 
    		return filter_var($email, FILTER_VALIDATE_EMAIL); //1 = valid, 0 = invalid.
		}
		/*public function validEmail($email){
			// First, we check that there's one @ symbol, 
  			// and that the lengths are right.
  			if(!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)){
    			// Email invalid because wrong number of characters 
    			// in one section or wrong number of @ symbols.
   				return false;
  			}
  			// Split it into sections to make life easier
  			$email_array = explode("@", $email);
  			$local_array = explode(".", $email_array[0]);
  			for($i = 0; $i < sizeof($local_array); $i++){
    			if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i])){
      				return false;
    			}
  			}
  			// Check if domain is IP. If not, 
  			// it should be valid domain name
  			if(!ereg("^\[?[0-9\.]+\]?$", $email_array[1])){
    			$domain_array = explode(".", $email_array[1]);
				if(sizeof($domain_array) < 2){
					return false; // Not enough parts to domain
				}
				for($i = 0; $i < sizeof($domain_array); $i++){
					if(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|↪([A-Za-z0-9]+))$",$domain_array[$i])){
						return false;
					}
				}
  			}
  			return true;
		}*/
		public function validName($name){
			if(!empty($name)){
				for($i=0; $i<strlen($name); $i++){
					if(is_numeric($name[$i]))
						return false; //please don't hate me for this :(
				}
				return true;
			}else
				return false;
		}
		public function validPassword($password){ //Makes sure the password is not blank and its size is greater than 4 and less than 100
			if(!empty($password)){
				$l = strlen($password);
				return $l > 4 && $l < 100;
			}else
				return false;
		}
		public function emailExists($email){//This email checks if an email is already in the db.
			$this->db->execute("SELECT id FROM ".TBL_PEOPLE." WHERE email = '".strtolower($email)."'");
			return $this->db->numRows() > 0;
		}
		//Function that makes the password encryption.
		protected function makePassword($password){
			return md5("~~89~~".SALT.$password.SALT."!!89!!");
		}
		
		/* Chnage Value Functions */
		private function changeValue($id, $rowName, $value){
			$this->db->execute("change ".TBL_PEOPLE." SET ".$rowName." = '".$value."' WHERE id = '".$id."'");
		}
		public function changeFirstName($id, $newName){
			if($this->validName($newName)){
				$this->changeValue($id, "first_name", strtolower($newName));
				return true;
			}
			return false;
		}
		public function changeLastName($id, $newName){
			if($this->validName($newName)){
				$this->changeValue($id, "last_name", strtolower($newName));
				return true;
			}
			return false;
		}
		public function changeEmail($id, $email){
			if($this->validEmail($email) && !$this->emailExists($email)){
				$this->changeValue($id, "email", strtolower($email));
				return true;
			}
			return false;
		}
		public function changePassword($id, $password){
			if($this->validPassword($password)){
				$this->changeValue($id, "password", $this->makePassword($password));
				return true;
			}
			return false;
		}
		//This function (below) checks for valid inputs, if not adds the error to an array, or if so, adds to a value array
		//If there are no errors, then add the data to the database and returns the value array and error array in an array..
		public function register($email, $first_name, $last_name, $password_A, $password_B){
			/*Removing Previous Errors*/
			if(isset($errors))
				unset($errors);
			/*                       */
			
			$errors = array();
			$values = array();
			//Email Checking..
			$values["email"] = strtolower($email);

			if($this->validEmail($email))
				if($this->emailExists($email))
					$errors["email"] = "Email is already in use."; //Email is already in the database.
			else
				$errors["email"] = "Email is invalid."; //Email is not vaild.
			//First Name Checking..
			$values["first_name"] = strtolower($first_name);
			if(!$this->validName($first_name))
				$errors["first_name"] = "First Name is not a valid name.";
			//Last Name Checking..
			$values["last_name"] = strtolower($last_name);
			if(!$this->validName($last_name))
				$errors["last_name"] = "Last Name is not a valid name.";
			//Password Checking..
			if($password_A === $password_B)
				if($this->validPassword($password_A)) //Same password, so we only need to check one.
					$values["password"] = $this->makePassword($password_A);
				else
					$errors["password"] = "Password is not a valid password.";				
			else
				$errors["password"] = "Passwords did not match.";
			if(count($errors) == 0)
				$this->addPerson($values["email"], $values["first_name"], $values["last_name"], $values["password"]);
			return array($values, $errors);		
		}
		public function editInfo($email, $first_name, $last_name, $password_A, $password_B){
			/*Removing Previous Errors*/
			if(isset($errors))
				unset($errors);
			/*                       */
			
			$errors = array();
			$values = array();
			//Email Checking..
			$values["email"] = strtolower($email);

			if($this->validEmail($email))
				if($this->emailExists($email))
					$errors["email"] = "Email is already in use."; //Email is already in the database.
			else
				$errors["email"] = "Email is invalid."; //Email is not vaild.
			//First Name Checking..
			$values["first_name"] = strtolower($first_name);
			if(!$this->validName($first_name))
				$errors["first_name"] = "First Name is not a valid name.";
			//Last Name Checking..
			$values["last_name"] = strtolower($last_name);
			if(!$this->validName($last_name))
				$errors["last_name"] = "Last Name is not a valid name.";
			//Password Checking..
			if($password_A === $password_B)
				if($this->validPassword($password_A)) //Same password, so we only need to check one.
					$values["password"] = $this->makePassword($password_A);
				else
					$errors["password"] = "Password is not a valid password.";				
			else
				$errors["password"] = "Passwords did not match.";
			if(count($errors) == 0)
				//update info
			return array($values, $errors);	
		}
	}
?>