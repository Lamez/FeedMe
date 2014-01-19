<?php
	$page = new Page("Home", $person);
	$page->requireLogin();
	$page->showHeader();
	$page->newNotice("Your IP Address", "Your IP Address is: ".$_SERVER["REMOTE_ADDR"], "yellow");
	$session->displayAll();
	$page->showFooter();
?>