<?php
	//includes.php: this file is to pack all the classes and needed 'include' files in one central spot.
	//error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE);//turn off strict error reporting.
	if(!isset($path))
		$path = "";
	include($path."constants.php");
	include($path."core/People.php");
	include($path."core/Person.php");
	include($path."core/Session.php");
	include($path."core/SessionPerson.php");
	include($path."core/Database.php");
	include($path."core/Website.php");
	include($path."core/SMTP.php");
	include($path."core/Email.php");
	include($path."core/DatabaseEmail.php");
	
	//include("core/Auth.php");
	//include("core/File.php");
	include($path."core/Page.php");

?>