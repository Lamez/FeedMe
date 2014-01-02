<?php
	//For changes, see: http://www.php.net/manual/en/mysqli.connect.php
	class Database{
		var $mysqli, $result, $q, $affectedRows;
		function __construct($host, $user, $pass, $db){
			if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
				echo 'Error: You MySQLi is not installed.';
				exit;
			}else
				$this->connect($host, $user, $pass, $db);
		}
		private function connect($host, $user, $pass, $db){
			$this->mysqli = new MySQLi($host, $user, $pass, $db);
			if(mysqli_connect_error()){
				echo 'Error: Cannot connect to the Database.';
				exit;
			}
		}
		private function clean(){
			$str = $this->q;
			$str = @trim($str);
			if(get_magic_quotes_gpc()){
				$str = stripslashes($str);
			}
			$this->q = mysqli_real_escape_string($this->mysqli, $str);
		}
		public function execute($query, $mode = MYSQLI_STORE_RESULT){
			$this->q = $query;
			$this->clean();
			$result = $this->mysqli->query($query, $mode);				
			if(is_object($result) && $result instanceof MySQLi_Result){//if result is a object and is part of the mysqli class?
				$this->result = $result;
				$this->affectedRows = $this->result->num_rows;
			}else
				$this->affectedRows = $this->mysqli->affected_rows;
			return $this;
		}
		public function fetchRow(){
			return $this->result->fetch_assoc();
		}
		public function fetchAll(){
			/*$row = $this->result->fetch_all($mode); 
			 See manual for the mode under mysqli_result::fetch_all
			//return !empty($row) ? $row : array();//if not empty return row, else return an array? */
			$row = array();
			while($f = $this->fetchRow()){
				$row[] = $f;
			}
			return !empty($row) ? $row : array();
		}
		public function numRows(){
			return $this->affectedRows;
		}
		public function delete($table, $where){
			return $this->execute("DELETE FROM ".$table." WHERE ".$where);
		}
		public function deleteAll($table){
			return $this->execute("TRUNCATE ".$table);
		}
		public function update($table, $set, $where){
			return $this->execute("UPDATE ".$table." SET ".$set." WHERE ".$where);
		}
		public function select($table, $select = "*", $where = NULL, $cap = ""){
			if(is_null($where) || empty($where))
				return $this->execute("SELECT ".$select." FROM ".$table." ".$cap);
			else
				return $this->execute("SELECT ".$select." FROM ".$table." WHERE ".$where." ".$cap);
		}
		public function lastId(){
			return $this->mysqli->insert_id;
		}
		public function resetInc($table, $inc){
			$this->execute("ALTER TABLE ".$table." AUTO_INCREMENT = ".$inc);
		}
		public function error(){
			return @mysqli_error($this->mysqli). " <strong><font color=\"red\">QUERY</font>: ".$this->q."</strong>";
		}
		private function close(){
			@mysqli_close($this->mysqli);
		}
		/*function __destruct(){
			$this->close();
		}*/
	}
?>
