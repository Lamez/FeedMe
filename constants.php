<?php
	//constants.php: This file is for setting variables that will not change from page to page, but that is used from page to page.

	/* Files\Pages */
	define("HEADER", "theme_core/header.php");
	define("FOOTER", "theme_core/footer.php");
	define("LOGIN_PAGE", "login");
	define("RECOVERY_PAGE", "password_recovery");
	define("DEFAULT_PAGE", "home");

	/* Folders */
	define("ERROR_DIR", "pages/errors/");
	define("THEME_CORE", "theme_core/");
	define("PAGES", "pages/");
	
	/*Names */
	define("APP_NAME", "FeedMe");
	define("VERSION", "0.0.1");
	
	/* Database Table Information */
	define("TBL_PEOPLE", "people");
	
	/* Salt */
	define("SALT", "BootyHole1345");
	
	/* Database Information */
	define("INSTALLED", 0);
	define("DB_HOST", "");
	define("DB_USER", "");
	define("DB_PASS", "");
	define("DB_NAME", "");
	
	/* Due to Installation later on down the road nothing should be past this point */
?>