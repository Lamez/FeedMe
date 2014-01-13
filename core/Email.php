<?php
	class Email{
		private $db, $email, $from, $to, $settings, $error, $sent;
		function __construct(){
			$email = NULL;
			$from = NULL;
			$settings = NULL;
			$to = NULL;
			$sent = false;
			$error = "";
		}
		public function email($subject, $body){
			$email["subject"] = $subject;
			$email["body"] = $body;
			$this->email = $email;
		}
		public function to($name, $email){
			$to["name"] = $name;
			$to["email"] = $email;
			$this->to = $to;
		}
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
		public function sendEmail(){
			require("pear/Mail.php");
			$mail = new Mail();
			$from = $this->from["name"]." <".$this->from["email"].">";
			$to = $this->to["name"]." <".$this->to["email"].">";
			$headers = array (	'From' => $from,
								'To' => $to,
								'Reply-To' => $from,
								'Subject' => $this->email["subject"]);	  
			$smtp = $mail->factory('smtp',
			array (	'host' => $this->settings["protocol"]."://".$this->settings["server"],
					'port' => $this->settings["port"],
					'auth' => $this->settings["auth"],
					'username' => $this->settings["username"],
					'password' => $this->settings["password"]));
			$mail = $smtp->send($to, $headers, $this->email["body"]);
			if(PEAR::isError($mail)){
				$this->error = $mail->getMessage();
				$this->sent = false;
			}else
				$this->sent = true;		
		}
		public function error(){
			return $this->error;
		}
		public function sent(){
			return $this->sent;
		}
	};
?>