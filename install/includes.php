<?php
	//installation includes.
	include($path."includes.php");
	$session = new Session();
	function writeToFile($server, $username, $password, $name){
		$data = 		
		'define("SALT", "'.rand().'@'.rand().'");
		/* Database Information */
		define("DB_HOST", "'.$server.'");
		define("DB_USER", "'.$username.'");
		define("DB_PASS", "'.$password.'");
		define("DB_NAME", "'.$name.'");
		?>';
		$filename = getcwd() . "/../constants.php";
		$line_i_am_looking_for = 23;
		$lines = file($filename, FILE_IGNORE_NEW_LINES);
		$lines[$line_i_am_looking_for] = $data;
		file_put_contents($filename , implode("\n", $lines));
	}
	function install(){
		$data = 
		'define("INSTALLED", "true");
		?>';
		$filename = getcwd() . "/../constants.php";
		$line_i_am_looking_for = 30;
		$lines = file($filename, FILE_IGNORE_NEW_LINES);
		$lines[$line_i_am_looking_for] = $data;
		file_put_contents($filename , implode("\n", $lines));
	}
	function displayOption($page){
		if(!$page->queryEqual("dark", 1)){ 
        	echo '<li>
            	<a href="'.$page->makeLink("dark", 1, array("page")).'" title="Change Theme" class="modal"><span class="glyph move"></span>Dark Theme</a>
       		</li>';
		}else{
        	echo '<li>
            	<a href="'.$page->makeLink("dark", 0, array("page")).'" title="Change Theme" class="modal"><span class="glyph move"></span>Light Theme</a>
       		</li>';			
		}
	}
?>