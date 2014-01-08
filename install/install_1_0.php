<?php
	//This creates the tables in the database
	//this needs to be updated as tables are being made in the application.
	//I agree, a more streamline approach needs to me made here.
	$path = "../";
	include("includes.php");
	if($session->get("install_1") == 2){
		$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$db->execute("CREATE TABLE IF NOT EXISTS people(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			email VARCHAR(50),
			first_name VARCHAR(30),
			last_name VARCHAR(30),
			password VARCHAR(100)
		);");
		$session->add("install_1", 1);
		header("Location: install_2.php");
	}else{
		header("Location: install_1.php");
	}
?>