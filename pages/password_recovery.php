<?php
	$page = new Page("Password Recovery");
	$page->showHeader(true);
?>
<?php echo $page->newAlert("Currently", "Not Working", "blue"); ?>
<div id="forgot-password" class="single">

	<header>
        <img src="<?php echo $page->getThemePath(); ?>images/logo-large.png" alt="Logo" />
    </header>
    
    <nav>
    	<ul>
        	<?php echo $page->newMenuItem("Login", "login", ""); ?>
            <?php echo $page->newMenuItem("Password Recovery", "password_recovery", ""); ?>
        </ul>
    </nav>        
	<section class="content">
    	<form class="validate-engine">
        	<div class="fieldset primary-widget">
            	<label>
                	<span class="icon" data-icon="mail"></span>
                    <input type="text" placeholder="Your email" data-validation-engine="validate[required, custom[email]]" id="emailField" autofocus />
                </label>
             </div>       
             <input type="submit" value="Recover password!" class="full-bt" />
        </form>
	</section>
</div>
<?php
	$page->showFooter(true);
?>
