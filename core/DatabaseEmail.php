<?php
	class DatabaseEmail extends Email{
		var $db, $id, $smtp, $error, $sent;
		function __construct($db){
			$this->db = $db;
			$this->smtp = new SMTP($db);
			$this->id = -1;
		}
		public function setID($id){
			$this->id = $id;
		}
		private function getSettings(){
			$r = $this->smtp->getSettings($this->id);
			return $r;
		}
		public function to($name, $email){
			parent::to($name, $email);
		}
		public function email($subject, $email){
			parent::email($subject, $email);
		}
		/*
				public function from($name, $email){
			$from["name"] = $name;
			$from["email"] = $email;
			$this->from = $from;
		}
		public function settings($server, $port, $protocol, $auth_required, $username = NULL, $password = NULL){
			$settings["server"] = $server;
			$settings["port"] = $port;
			$settings["protocol"] = $protocol;
			$settings["auth_required"] = $auth_required;
			$settings["username"] = $username;
			$settings["password"] = $password;
			$this->settings = $settings;
		}
		*/
		public function sendEmail(){
			$settings = array();
			if($this->id != -1)
				$settings = $this->getSettings();
			else
				$settings = $this->smtp->getDefault();
			print_r($settings);
			parent::from($settings["name"], $settings["email"]);
			parent::settings($settings["server"], $settings["port"], $settings["protocol"], $settings["auth"], $settings["username"], $settings["password"]);
			return parent::sendEmail();
		}
		public function sent(){
			return parent::sent();
		}
		public function error(){
			return parent::error();
		}
	}
?>