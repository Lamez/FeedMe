a
<?php
	//constants.php: This file is for setting variables that will not change from page to page, but that is used from page to page.
	include("core/Database-Config.php");
	/* Files\Pages */
	define("HEADER", "theme_core/header.php");
	define("FOOTER", "theme_core/footer.php");
	define("LOGIN_PAGE", "?page=login");
	define("RECOVERY_PAGE", "?page=password_recovery");

	/* Folders */
	define("ERROR_DIR", "pages/errors/");
	define("THEME_CORE", "theme_core/");
	define("PAGES", "pages/");
	
	/*Names */
	define("APP_NAME", "WebConverter");
	define("VERSION", "0.0.1");
/*%%EOF%%*/
?>
b