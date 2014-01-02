<?php
	//index.php: this is the driver that will call the absolutly needed files and the requested file if it exists, if not calls 404.php. 
	include("includes.php"); //calls the classes each page might need.
	if(!isset($_GET['page']) || empty($_GET['page']))
		$page = DEFAULT_PAGE;
	else
		$page = str_replace('/', '', stripslashes(strtolower($_GET['page'])));
		
	$file = PAGES.$page.".php";
	
	if(isset($_GET['42']) && $_GET['42'])
		$session->change("login-page-trys", 0);
		
	
	if($page == 401)
		include(ERROR_DIR."401.php");
	else if(file_exists($file))
		include($file);
	else
		include(ERROR_DIR."404.php");
?>
