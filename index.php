<?php
	//index.php: this is the driver that will call the absolutly needed files and the requested file if it exists, if not calls 404.php. 
	include("includes.php"); //calls the classes each page might need.
	if(defined("INSTALLED")){
		$session = new Session();
		$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$person = new SessionPerson($db, $session);
		
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
	}else{
		$page = new Page("");
		$page->redirect($page->getURL."install/install_0.php");
		//		header("Location: ".$page->currentURL($false)."/install/install.php");
		//echo "Please Install ".APP_NAME.".";
	}
?>
