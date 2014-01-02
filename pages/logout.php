<?php
	//logout.php: logs out the person.
	$page = new Page("Logout");
	$person->logout(); //See includes.php $person is already declared in global scope.
	$page->changeQuery("page", "login");
	$page->redirect();
?>