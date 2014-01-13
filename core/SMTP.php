<?php
	class SMTP{
		var $db;
		function __construct($db){
			$this->db = $db;
		}
		public function getSettings($id){
			$results = $this->db->execute("SELECT * FROM ".TBL_SMTP." WHERE id = '".$id."'");
			return $results;
		}
		public function getCount(){
			$this->db->execute("SELECT id FROM ".TBL_SMTP);
			return $this->db->numRows();
		}
		private function addSettings($email, $username, $password, $auth, $protocol, $port, $server, $default){
			//main = defefault, default is a MySQL keyword so it returns a error if used.
			$this->db->execute("INSERT INTO ".TBL_SMTP." (email, username, password, auth, protocol, port, server, main) 
			VALUES (".$email.", ".$username.", ".$password.", ".$auth.", ".$protocol.", ".$port.", ".$server.", ".$default.")");
		}
	}
?>