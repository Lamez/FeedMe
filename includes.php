<?php
	//includes.php: this file is to pack all the classes and needed 'inlclude' files in one central spot.
	if(!isset($path))
		$path = "";
	include($path."constants.php");
	include($path."core/People.php");
	include($path."core/Person.php");
	include($path."core/Session.php");
	include($path."core/SessionPerson.php");
	include($path."core/Database.php");

	$session = new Session();
	$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$person = new SessionPerson($db, $session);
	
	//include("core/Auth.php");
	//include("core/File.php");
	include($path."core/Page.php");

?>