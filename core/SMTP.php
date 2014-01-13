<?php
	class SMTP{
		var $db;
		function __construct($db){
			$this->db = $db;
		}
		public function getSettings($id){
			$this->db->execute("SELECT * FROM ".TBL_SMTP." WHERE id = '".$id."'");
			return $this->db->fetchAll();
		}
		public function getCount(){
			$this->db->execute("SELECT id FROM ".TBL_SMTP);
			return $this->db->numRows();
		}
		public function getDefault(){
			$this->db->execute("SELECT * FROM ".TBL_SMTP." WHERE main = '1'");
			return $this->db->fetchRow();
		}
		private function addSettings($email, $username, $password, $auth, $protocol, $port, $server, $default){
			//main = defefault, default is a MySQL keyword so it returns a error if used.
			$this->db->execute("INSERT INTO ".TBL_SMTP." (email, username, password, auth, protocol, port, server, main) 
			VALUES (".$email.", ".$username.", ".$password.", ".$auth.", ".$protocol.", ".$port.", ".$server.", ".$default.")");
		}
	}
?>