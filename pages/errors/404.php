<?php
	//include("../Page.php");
	$page = new Page("404 Page Not Found");
	$page->showHeader(true);
?>
<div id="error-page">
	<header>
    	<h1>404</h1>
		<h2>Error</h2>
	</header>
    <section class="content">
    	<p>Sorry, the page you was trying to access doesn't exists!</p>
    </section>
</div>
<?php
	$page->showFooter(true);
?>

