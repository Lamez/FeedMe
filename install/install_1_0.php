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
		$db->execute("CREATE TABLE IF NOT EXISTS websites(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(30),
			address VARCHAR(50),
			folder VARCHAR(50)
		);");
		$db->execute("CREATE TABLE IF NOT EXISTS smtp(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			email VARCHAR(50),
			username VARCHAR(50),
			password VARCHAR(100),
			auth INT(1),
			protocol VARCHAR(4),
			port INT(5),
			server VARCHAR(50),
			main INT(1)
		);");
		$session->add("install_1", 1);
		$db->close();
		header("Location: install_2.php");
	}else{
		header("Location: install_1.php");
	}
?>