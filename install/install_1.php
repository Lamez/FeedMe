<?php
	$path = "../";
	include("includes.php"); //contains $session.
	$page = new Page("Installation Wizard");
	$page->setPath($path); 
	$install_0 = $session->get("install_0");
	if((defined("DB_HOST") && defined("DB_USER") && defined("DB_NAME") && defined("DB_PASS")) || $session->get("install_1") == 1){
		$session->add("install_1", 2);
		$page->redirect($page->getURL."install_1_0.php");
		exit;		
	}else if(is_null($install_0) || !$install_0){ //checking previous step.
		$page->redirect($page->getURL."install_0.php");
		exit;		
	}else if($page->getQuery("setup") == 1 && $_POST["displayed"] == 1 && $session->get("displayed") == 1){ //maybe i'm a bit over protective..
		$session->remove("displayed");
		$session->add("server", $_POST["server"]);
		$session->add("uname", $_POST["uname"]);
		$session->add("name", $_POST["name"]);
		$simple_connection = mysqli_connect($_POST["server"], $_POST["uname"], $_POST["passw"]);
		if($simple_connection){ //connected..
			//create table.
			$name = str_replace(' ', '_', $_POST["name"]); //no spaces in table name, so.. _UNDERSCORES_!
			mysqli_query($simple_connection, "CREATE DATABASE IF NOT EXISTS ".$name.";");
			//close connection.
			mysqli_close($simple_connection);
			//store information and move to next step..
			writeToFile($_POST["server"], $_POST["uname"], $_POST["passw"], $name); //in includes...
			$session->remove("server");
			$session->remove("uname");
			$session->remove("name");
			$session->add("install_1", 2);
			$page->redirect($page->getURL."install_1_0.php");
		}else{
			//return error
			$page->addQuery("error", 1);
			$page->removeQuery("setup");
			$page->redirect();
		}
		exit;
	}
	$page->showHeader(true);
?>   
<div class="grid_12">
	<div class="widget wizard">
    	<header>
        	<div class="title">
            	<h2><?php echo $page->getTitle(); ?></h2>
                <span>Step 2: Database Configuration</span>
          	</div>
       		<nav class="steps">
            	<ul>
                	<li>
                    	<div>1</div>
                        <span>File Premissions</span>
                  	</li>
                    <li class="active">
                    	<div>2</div>
                        <span>DB Setup</span>
                	</li>
                    <li>
                    	<div>3</div>
                        <span>Account Setup</span>
                   	</li>
                    <li>
                    	<div>4</div>
                        <span>Locating Root</span>
          			</li>
                    <li>
                    	<div>5</div>
                        <span>Finished</span>
                  	</li>
               	</ul>
        	</nav>
      	</header>
        <div class="content">
        	<?php
				if($page->getQuery("error") == 1){
					echo $page->newAlert("Error", "Could not connect to the database. Check your creditals and try again.", "red");
				}
			?>
        	<p style="padding: 5px;"><?php echo APP_NAME." ".VERSION; ?>'s uses a database to store infomartion.</p>
       		<form class="validate" action="<?php echo $page->makeLink("setup", 1, array("dark", "page")); ?>" method="post">
            	<fieldset class="set">
                	<div class="field">
                    	<label>Database Server: </label>
                        <div class="entry error-container">
                        	<input type="text" class="required" name="server" value="<?php echo $session->get("server"); ?>">
                        </div>
                    </div>
                	<div class="field">
                    	<label>Database Username: </label>
                        <div class="entry error-container">
                        	<input type="text" class="required" name="uname" value="<?php echo $session->get("uname"); ?>">
                        </div>
                    </div>
                    <div class="field">
                    	<label>Database Password: </label>
                        <div class="entry">
                        	<input type="password" name="passw">
                        </div>
                  	</div>
                	<div class="field">
                    	<label>Database Name: </label>
                        <div class="entry">
                        	<input type="text" class="required" name="name" value="<?php
								$name = APP_NAME."_".rand();
								if(is_null($session->get("name")))
									echo $name;
								else
									echo $session->get("name");
							?>">
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