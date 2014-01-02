<?php
	$page = new Page("401 Access Denied");
	$page->showHeader(true);
?>
<div id="error-page">
	<header>
    	<h1>401</h1>
		<h2>Access denied</h2>
	</header>
    <section class="content">
    	<p>Sorry you have too many login attempts. Access denied.</p>
        <p><a href="<?php echo $page->makeLink("page", "password_recovery"); ?>">Try Recovering your password.</a>
    </section>
</div>
<?php
	$page->showFooter(true);
?>

