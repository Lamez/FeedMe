<?php
	class File{
		private $fileName;
		private $handle;
		function __construct($fileName){
			$this->setName($fileName);
			if(!$this->exists()){ //If the file does not exists, make it.
				$this->openFile('r');
				$this->closeFile();
			}
		}
		public function setName($fileName){
			$this->fileName = $fileName;
		}
		public function getName(){
			return $this->fileName;
		}
		private function openFile($function){//$function can be r = read, w = write, a = append.
			$this->handle = fopen($this->getName(), $function);
		}
		private function closeFile(){
			fclose($this->handle);
		}
		public function read(){
			$this->openFile('r');
			$line = "";
			while(!feof($this->handle)){
				$line .= fgets($this->handle);
			}
			$this->closeFile();
			return $line;
		}
		/*public function writeToLine($string, $lineNumber){
			$this->openFile('a');
			for($i=0; $i<=$lineNumber; $i++){
				if(feof($this->handle))
					fwrite($this->handle, "\n");
				else
					$line = fgets($this->handle);
			}
			fwrite($this->handle, $string);
			$this->closeFile();
		}*/
		public function write($string){
			$this->openFile('w');
			fwrite($this->handle, $string);
			$this->closeFile();
		}
		public function append($string){
			$this->openFile('a');
			fwrite($this->handle, $string);
			$this->closeFile();
		}
		public function delete(){
			unlink($this->getName());
		}
		public function exists(){
			return file_exists($this->getName());
		}
	}
?>