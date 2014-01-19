<?php
	$page = new Page("Login", $person);
	if($person->isAuth()){
		$page->changeQuery("page", DEFAULT_PAGE);
		$page->redirect();
		exit;
	}
	if(!$session->exists("login-page-trys"))
		$session->add("login-page-trys", 0);
	if($session->get("login-page-trys") > 3){
		$page->removeQuery("validate");
		$page->removeQuery("ref");
		$page->removeQuery("error");
		$page->addQuery(42, 1); //This needs to be removed at some point
		$page->changeQuery("page", 401);
		$page->redirect();
		exit; //no need to load the rest of the page.
	}else{
		if($page->getQuery("validate") == "try"){
			if($person->login($_POST['emailField'], $_POST['passwordField'])){ //Login was correct, lets go to the correct destination.
				$redirect = $page->getQuery("ref");
				if(is_null($redirect) || empty($redirect)) //oh, no destination is mind, lets go to the default page (home)
					$redirect = DEFAULT_PAGE;
				$session->remove("login-page-trys"); //remove
				$page->redirect($page->makeLink("page", $redirect, array("dark")));
			}else{ //go back to login page. and show error..
				$value = $session->get("login-page-trys") + 1;
				$session->change("login-page-trys", $value);
				$page->addQuery("login-error", 1);
				$page->removeQuery("validate");
				$page->redirect();
			}
			exit; //There is really no need to load the rest of the page when validating.
		}
	}
	$page->showHeader(true);
?>

<div id="login" class="single">
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
                <?php 
                    if($page->queryEqual("login-error", "1"))
                        echo $page->newAlert("", "Invalid Email, Password combination", "red");	
					else if($page->queryEqual("pw_reset", 1))
						echo $page->newAlert("", "Your password has been reset.", "green");
                ?>
                <!-- class="validate-engine" -->
                <form action="<?php echo $page->makeLink("validate", "try", array("page", "ref", "error", "dark")); ?>"  method="post">
                    <div class="fieldset primary-widget">
                        <label>
                            <span class="icon" data-icon="user"></span>
                            <input type="text" placeholder="Email" data-validation-engine="validate[required, custom[email]]" name="emailField" id="emailField" autofocus />
                        </label>
                        <label>
                            <span class="icon" data-icon="lock"></span>
                            <input type="password" placeholder="Password" data-validation-engine="validate[required]" name="passwordField" id="passwordField" />
                        </label>
                    </div>        
                   <!-- <label class="check-container">
                        <input type="checkbox" /> Keep me logged in
                    </label> -->   
                    <input type="submit" value="Log In!" class="full-bt" />
                 </form>
            </section>
        </div>
<?php
	$page->showFooter(true);
?>