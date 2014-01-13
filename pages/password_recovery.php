<?php
	$page = new Page("Password Recovery");
	if($page->getQuery("passwordReset") == 1.0){ //SMTP settings found.. send email.
	}else if($page->getQuery("passwordReset") == 1.1){ //No SMTP configured.. ask for email, fname, and lname
		$email = strtolower($_POST["email"]);
		$fname = strtolower($_POST["fname"]);
		$lname = strtolower($_POST["lname"]);
		$db->execute("SELECT id FROM ".TBL_PEOPLE." WHERE first_name = '".$fname."' AND last_name = '".$lname."' AND email = '".$email."'");
		if($db->numRows() > 0){
			$session->add("pw_reset", 2); //needed...
			$session->add("usn_id", $db->fetchRow());
			$page->changeQuery("passwordReset", 2);
		}else{
			$page->removeQuery("passwordReset");
			$page->addQuery("error", 1.1);
		}
		$page->redirect();
		exit;
	}else if($page->getQuery("passwordReset") == 2){
		if($session->get("pw_reset") == 2){
			$page->showHeader(true);
			echo'    
			<div id="forgot-password" class="single">
				<header>
					<img src="'.$page->getThemePath().'images/logo-large.png" alt="Logo" />
				</header>
                <section class="content">
                     <form class="validate-engine" method="post" action="'.$page->makeLink("passwordReset", "2.1", array("dark", "page")).'">
                        <div class="fieldset primary-widget">
                            <label>
                                <span class="icon" data-icon="ui-text-field-password"></span>
                                <input type="text" placeholder="New Password" data-validation-engine="validate[required]" id="pw_1" autofocus />
                            </label>
							<label>
                                <span class="icon" data-icon="ui-text-field-password-green"></span>
                                <input type="text" placeholder="Re-Type Password" data-validation-engine="validate[required]" id="pw_2"/>
                            </label>
                         </div>       
                         <input type="submit" value="Login!" class="full-bt" />
                    </form>
                </section>
				</div>';
				$session->add("pw_reset", 2.1); 
		}else{
			$page->removeQuery("passwordReset");
			$page->redirect();
			exit;
		}
	}else if($page->getQuery("passwordReset") == 2.1){
		if($session->get("pw_reset") == 2.1){
			//check passwords and make password nad update row.
			
		}else{
			$page->removeQuery("passwordReset");
			$page->redirect();
			exit;
		}
			
	}else{
		$page->showHeader(true);
?>
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
            <?php
            $smtp = new SMTP($db);
            if($smtp->getCount() > 0){ 
                echo'    
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
                </section>';
            }else{
            ?>
                <section class="content">
                    <form class="validate-engine" method="post" action="<?php echo $page->makeLink("passwordReset", "1.1", array("dark", "page")); ?>">
                        <div class="fieldset primary-widget">
                            <label>
                                <span class="icon" data-icon="mail"></span>
                                <input type="text" placeholder="Your Email" data-validation-engine="validate[required, custom[email]]" id="email" name="email" autofocus />
                            </label>
                            <label>
                                <span class="icon" data-icon="user-silhouette"></span>
                                <input type="text" placeholder="Your First name" data-validation-engine="validate[required]" id="fname" name="fname" />
                            </label>
                            <label>
                                <span class="icon" data-icon="user-silhouette"></span>
                                <input type="text" placeholder="Your Last name" data-validation-engine="validate[required]" id="lname"  name="lname" />
                            </label>
                         </div>       
                         <input type="submit" value="Recover password!" class="full-bt" />
                    </form>
                </section>
            <?php
            } //end if count > 0
            ?>
        </div>
<?php
	}//end if page = 1 or 2
	$page->showFooter(true);
?>
