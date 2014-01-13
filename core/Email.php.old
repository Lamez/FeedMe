<?php
	require("pear/Mail.php");
	class Email extends Mail{
		var $name, $email, $subject, $body;
		var $f_name, $f_email;
		var $auth, $username, $password;
		var $server, $port;
		var $error = NULL, $sent;
		function __construct($name, $email, $subject, $body, $from = NULL, $femail = NULL){
			$this->name = $name;
			$this->email = $email;
			$this->subject = $subject;
			$this->body = $body;
			$this->callSettings();
			if(!is_null($from))
				$this->f_name = $from;
			if(!is_null($femail))
				$this->f_email = $femail;
			$this->send();
		}
		function send(){
			$from = $this->f_name." <".$this->f_email.">";
			$to = $this->name." <".$this->email.">";
			$headers = array (	'From' => $from,
								'To' => $to,
								'Reply-To' => $from,
								'Subject' => $this->subject);	  
			$smtp = Mail::factory('smtp',
			array (	'host' => $this->server,
					'port' => $this->port,
					'auth' => $this->auth,
					'username' => $this->username,
					'password' => $this->password));
			$mail = $smtp->send($to, $headers, $this->body);
			if(PEAR::isError($mail)){
				$this->error = $mail->getMessage();
				$this->sent = false;
			}else
				$this->sent = true;
		}
		function error(){
			echo $this->error;
		}
		private function callSettings(){
			$id = $this->getDefault();
			if($id !=  -1){
				global $db;
				$q = $db->select(TBL_SMTP, "*", "id = '$id'");
				$f = $q->fetchRow();
				$this->auth = settype($f['auth'], "boolean");
				if($this->auth){
					$this->username = $f['username'];
					$this->password = $f['password'];
				}
				$this->server = "";
				if($f['protocol'] != 'NA')
					$this->server = $f['protocol']."://";
				$this->server .= $f['server'];
				$this->port = $f['port'];
				$this->f_name = $f['name'];
				$this->f_email = $f['email'];				
			}else{
				$this->error = "Email Settings not Set";
				$this->sent = false;
			}
		}
		private function getDefault(){
			global $db;
			if($db->select(TBL_SMTP, "id", "`default` = '1'")->numRows() > 0){
				$f = $db->fetchRow();
				return $f['id'];
			}else{
				if($this->countAccounts() > 0){
					$q = $db->select(TBL_SMTP, "id");
					$f = $q->fetchRow();
					return $f['id'];
				}else
					return -1;
			}
		}
		private function countAccounts(){
			global $db;
			return $db->select(TBL_SMTP, "id")->numRows();			
		}
	};
?>
