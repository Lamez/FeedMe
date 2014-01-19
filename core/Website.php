<?php
	class Website{
		private $db;
		function __construct($db){
			$this->db = $db;
		}
		public function add($name, $address, $folder){
			$this->db->execute("INSERT INTO ".TBL_WEBSITES." (name, address, folder) VALUES('".$name."', '".$address."', '".$folder."')");
		}
		public function update($id, $name, $address, $folder){
			$this->db->execute("UPDATE ".TBL_WEBSITES." SET name = '".$name."', address = '".$address."', folder = '".$folder."' WHERE id = '".$id."'");
		}
		public function delete($id){
			$this->db->execute("DELETE FROM ".TBL_WEBSITES." WHERE id = '".$id."'");
		}
		public function getAll(){
			$this->db->execute("SELECT * FROM ".TBL_WEBSITES);
			$data = $this->db->fetchAll();
			return $data;
		}
		public function IdExists($id){
			$this->db->execute("SELECT id FROM ".TBL_WEBSITES." WHERE id = '".$id."'");
			return $this->db->numRows() > 0;
		}
		public function formatFolder($folder){
			if(empty($folder)){
				$folder = "/";
			}else{
				$folder = str_replace(" " , "_", $folder);
				$folder = strtolower($folder);
				$folder = str_replace("/", "", $folder);
				$folder = str_replace("\\", "", $folder);
			}
			if($folder != "/")
				return "/".$folder;
			else
				return $folder;
		}
		public function formatAddress($address){
			$address = strtolower($address);
			//$address = str_replace("/", "" , $address);
			return str_replace("\\", "", $address);
		}
		/*public function isUp($address){
			$ch = curl_init($address);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			return curl_exec($ch);
			curl_close($ch);
			//$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		}*/
		public function isUp($address){
			$data = @get_headers($address);
			return !empty($data);
		}
		public function validAddress($address){
			$address = parse_url($address);
			if(!empty($address["host"]))
				$address = $address["host"];
			else
				$address = $address["path"];
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