<?php
	class Website{
		private $db;
		function __construct($db){
			$this->db = $db;
		}
		public function add($name, $address, $folder){
			$this->db->execute("INSERT INTO ".TBL_WEBSITES." (name, address, folder) VALUES('".$name."', '".$address."', '".$folder."')");
		}
		public function getAll(){
			$this->db->execute("SELECT * FROM ".TBL_WEBSITES);
			$data = $this->db->fetchAll();
			return $data;
		}
	};
?>