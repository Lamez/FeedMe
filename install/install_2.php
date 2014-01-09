<?php
	$path = "../";
	include("includes.php");
	$page = new Page("Installation Wizard");
	$page->setPath($path);
	$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$person = new Person($db);
	if($session->get("install_1") != 1){
		$page->redirect($page->getURL."install_1.php");
		exit;
	}else if($person->countPeople() > 0){ //already did this step.
		$session->add("install_2", 1);
		$page->redirect($page->getURL."install_3.php");
	}else if($session->get("displayed") == 1 && $page->getQuery("create") == 1 && $_POST["displayed"] == 1){
		$session->remove("displayed");
		$data = $person->register($_POST["email"], $_POST["fname"], $_POST["lname"], $_POST["pw_1"], $_POST["pw_2"]);
		if(empty($data[1])){ //no errors! woo!
			$db->close();	
			//the cool thing about remove is, it only removes the session value if it exists, no need to check to remove before moving the driving code.
			$session->remove("fname");
			$session->remove("lname");
			$session->remove("email");
			$session->add("install_2", 1);
			$page->redirect($page->getURL."install_3.php");
			exit; //I don't know why I add these, there is no need, I mean, seriously. 
		}else{
			$session->add("fname", $_POST["fname"]);
			$session->add("lname", $_POST["lname"]);
			$session->add("email", $_POST["email"]);
			$session->add("errors", $data[1]);
			$page->addQuery("error", 1);
			$page->removeQuery("create");
			$page->redirect();
			exit;
		}
	}
	$page->showHeader(true);	
	function dispError($name, $error){
		echo '<label for="'.$name.'" class="error">'.$error.'</label>';
	}
	$error_array = NULL;
	if($page->getQuery("error") == 1)
		$error_array = $session->get("errors");
?>   
<div class="grid_12">
	<div class="widget wizard">
    	<header>
        	<div class="title">
            	<h2><?php echo $page->getTitle(); ?></h2>
                <span>Step 3: Account Setup</span>
          	</div>
       		<nav class="steps">
            	<ul>
                	<li>
                    	<div>1</div>
                        <span>File Premissions</span>
                  	</li>
                    <li>
                    	<div>2</div>
                        <span>DB Setup</span>
                	</li>
                    <li class="active">
                    	<div>3</div>
                        <span>Account Setup</span>
                   	</li>
                    <li>
                    	<div>4</div>
                        <span>Finished</span>
                  	</li>
               	</ul>
        	</nav>
      	</header>
        <div class="content">
        	<p style="padding: 5px;">Let's create your account!</p>
       		<form class="validate" action="<?php echo $page->makeLink("create", 1, array("dark", "page")); ?>" method="post">
            	<fieldset class="set">
                	<div class="field">
                    	
                    	<label>First Name: </label>
                        <div class="entry error-container">
                        	<input type="text" class="required" name="fname" value="<?php echo $session->get("fname"); ?>">
                            <?php
								if($page->getQuery("error") == 1 && isset($error_array["first_name"]))
									dispError("fname", $error_array["first_name"]);
							?>
                        </div>
                    </div>
                	<div class="field">
                    	<label>Last Name: </label>
                        <div class="entry error-container">
                        	<input type="text" class="required" name="lname" value="<?php echo $session->get("lname"); ?>">
                            <?php
								if($page->getQuery("error") == 1 && isset($error_array["last_name"]))
									dispError("lname", $error_array["last_name"]);
							?>
                        </div>
                    </div>
                    <div class="field">
                    	<label>Email: </label>
                        <div class="entry error-container">
                        	<input type="text" class="custom[email] required" name="email" value="<?php echo $session->get("email"); ?>">
                            <?php
								if($page->getQuery("error") == 1 && isset($error_array["email"]))
									dispError("email", $error_array["email"]);
							?>                            
                        </div>
                  	</div>
                	<div class="field">
                    	<label>Password: </label>
                        <div class="entry error-container">
                        	<input type="password" class="required" name="pw_1">
                            <?php
								if($page->getQuery("error") == 1 && isset($error_array["password"]))
									dispError("pw_1", $error_array["password"]);
							?>
                        </div>
                	</div>
                    <div class="field">
                    	<label>Retype Password: </label>
                        <div class="entry">
                        	<input type="password" class="required" name="pw_2">
                        </div>
                	</div>
                 	<input type="hidden" name="displayed" value="1">
                    <?php $session->add("displayed", 1); ?>
                    <footer class="pane">
                        <p align="center">
                            <?php
                               // echo $page->newButton("install_0.php", "bt blue large", "< Previous Step", true);
                                //echo "\t";
                               /* $page->addQuery("setup", 1);
                                echo $page->newButton("install_1.php", "bt blue large", "Next Step >", true);*/
                            ?>
                            <input type="submit" value="Next Step >" class="bt blue large" />
                        </p>
                    </footer>
            	</fieldset>
       		</form>
    	</div>
  	</div>
</div>
<?php
	$page->showFooter(true);
?>