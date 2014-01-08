<?php
	$page = new Page("Edit Profile", $person);
	$page->requireLogin();
	$id = $page->getQuery("id");
	$people = new People($db); 
	if($page->queryEqual("validate", 1)){
		$page->removeQuery("validate");
		$people->editInfo($_POST["email"], $_POST["first_name"], $_POST["last_name"], $_POST["password_A"], $_POST["password_B"]);
		//reading this from the future, where the hell did (data[]) come from? ...I will fix this later.
		if(count($data[1]) == 0){ //No Errors.. 
			$page->addQuery("edit", 1);
			$session->remove("errors");
			$session->remove("values");
		}else{
			$session->add("errors", $data[1]);
			$session->add("values", $data[0]);
		}
		$page->redirect();
	}else if(!is_null($id) && $id != $person->id() && is_null($session->get("values"))){
		$id = $page->getQuery("id");
		$data = $people->listInfoFromId($id);
		$first_name = $data[0]["first_name"];
		$last_name = $data[0]["last_name"];
		$email = $data[0]["email"];
	}else if(!is_null($session->get("values"))){
		$values = $session->get("values");
		$first_name = $values["first_name"];
		$last_name = $values["last_name"];
		$email = $values["email"];
	}else{
		$first_name = $person->first_name();
		$last_name = $person->last_name();
		$email = $person->email();
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
        	<form action="<?php echo $page->makeLink("validate", 1, array("dark", "page")); ?>" class="validate" method="post">
            	<fieldset class="set">
                	<div class="field">
                    	<label>Name: </label>
                    	<div class="entry">
                    		<div class="dual">
                        		<input type="text" class="required" name="first_name" value="<?php echo $first_name; ?>" />
                            	<input type="text" class="required" name="last_name" value="<?php echo $last_name; ?>" />
                       		</div>  
               	    	</div>
        		 	</div>
                </fieldset>
                <fieldset class="set">
                	<div class="field">
                    	<label>Email: </label>
                        <div class="entry">
                        	<input type="text" class="custom[email]" name="email" value="<?php echo $email; ?>" />
                        </div>
                    </div>
                </fieldset>
                <fieldset class="set">
                	<div class="field">
                    	<label> </label>
                    	<div class="entry">
                        	<input type="password" name="password_A" placeholder="Password" />
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