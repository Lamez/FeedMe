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
		public function isUp($address){
			$ch = curl_init($address);
			curl_setopt($ch, CURLOPT_NOBODY, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_exec($ch);
			$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			return 200 == $retcode; //true if online or "up"
		}
		public function validAddress($address){
			//$ip = preg_match("^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$", $address);
			//$hostname = preg_match("^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$", $address);
			return preg_match("#^(https?://)?[^/.]+(\.[^/.])+/?$#", $address);
		}
		public function hasProtocol($input){
			$address = parse_url($input);
			if(empty($address["scheme"]))
				return false;
			else
				return $address["scheme"] == 'https' || $address["scheme"] == 'http';
		}
	};
?>