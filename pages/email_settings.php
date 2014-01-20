<?php
	$page = new Page("Email Settings", $person);
	$page->showHeader();
	echo $page->newMenuItem("Testing", "home", "database");
	$page->showFooter();
?>