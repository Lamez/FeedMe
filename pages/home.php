<?php
	$page = new Page("Home", $person);
	$page->requireLogin();
	$page->newNotice("!", "d", "red");
	$page->showHeader();
	$page->newNotice("after headeR", "you head the man", "green");
	$session->displayAll();
	$page->showFooter();
?>