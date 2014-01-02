<?php
	$page = new Page("Home", $person);
	$page->requireLogin();
	$page->showHeader();
	$session->displayAll();
	$page->showFooter();
?>