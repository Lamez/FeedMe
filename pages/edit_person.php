<?php
	$page = new Page("Edit Profile", $person);
	$page->requireLogin();
	$id = $page->getQuery("id");
	if(empty($id)){
		$id = $person->id(); //default value.
	} 
	if($page->queryEqual("validate", 1)){
		$page->removeQuery("validate");
		$data = $person->editInfo($id, $session->get("current_values"), $_POST["email"], $_POST["first_name"], $_POST["last_name"], $_POST["password_A"], $_POST["password_B"]);
		if(count($data[1]) == 0){ //No Errors.. 
			$page->addQuery("edit", 1);
			$session->remove("errors_ep");
			$session->remove("values_ep");
			
		}else{
			$session->add("errors_ep", $data[1]);
			$session->add("values_ep", $_POST);
		}
		$page->redirect();
	}else if(!is_null($session->get("values_ep"))){ //values have been set from form submit
		$values = $session->get("values_ep");
		$first_name = $values["first_name"];
		$last_name = $values["last_name"];
		$email = $values["email"];
	}else if(is_null($session->get("values_ep")) && $id != $person->id()){ //no need to pull from the DB if we have it in the session.
		$data = $person->listInfoFromId($id);
		$first_name = $data[0]["first_name"];
		$last_name = $data[0]["last_name"];
		$email = $data[0]["email"];
	}else{ //no values (default)
		$first_name = $person->first_name();
		$last_name = $person->last_name();
		$email = $person->email();
	}
	$current_values["email"] = $email;
	$current_values["first_name"] = $first_name;
	$current_values["last_name"] = $last_name;
	$session->add("current_values", $current_values);
	function dispError($name, $list){
		if(!empty($list[$name]))
			echo '<div class="error-container"><label for="'.$name.'" class="error">'.$list[$name].'</label></div>';
	}
	$errors = $session->get("errors_ep");
	if($page->queryEqual("edit", 1)){
		$page->newNotice("Profile Update!", "The user information has been update!", "green");
	}
	$page->showHeader();
?>
 <div class="grid_12">
	<div class="widget">
    	<header>
        	<div class="icon"><span class="icon" data-icon="card-address"></span></div>
			<div class="title"><h2><?php echo $page->getTitle(); ?></h2></div>
        </header>
        <div class="content">
        	<form action="<?php echo $page->makeLink("validate", 1, array("dark", "page", "id")); ?>" class="validate" method="post">
            	<fieldset class="set">
                	<div class="field">
                    	<label>Name: </label>
                    	<div class="entry">
                    		<div class="dual">
                        		<input type="text" class="required" name="first_name" value="<?php echo $first_name; ?>" />
                            	<input type="text" class="required" name="last_name" value="<?php echo $last_name; ?>" />
                                <?php
									dispError("first_name", $errors);
									dispError("last_name", $errors);
								?>
                       		</div>  
               	    	</div>
        		 	</div>
                </fieldset>
                <fieldset class="set">
                	<div class="field">
                    	<label>Email: </label>
                        <div class="entry">
                        	<input type="text" class="custom[email]" name="email" value="<?php echo $email; ?>" />
                            <?php
								dispError("email", $errors);
							?>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="set">
                	<div class="field">
                    	<label> </label>
                    	<div class="entry">
                        	<input type="password" name="password_A" placeholder="Password" />
                            <?php
								dispError("password", $errors);
							?>							
                        </div>
                   	</div>
                </fieldset>
                <fieldset class="set">
                	<div class="field">
                    	<label> </label>
                    	<div class="entry">
                        	<input type="password" name="password_B" placeholder="Re-type Password" />
                        </div>
                   	</div>
                </fieldset>
                <footer class="pane">
                	<input type="submit" value="Submit" class="fullpane-bt" />
                </footer>
            </form>
        </div>
    </div>
 </div>
<?php
	$page->showFooter();
?>