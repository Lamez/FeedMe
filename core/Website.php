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
			return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $address) //valid chars check
            && preg_match("/^.{1,253}$/", $address) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $address));
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