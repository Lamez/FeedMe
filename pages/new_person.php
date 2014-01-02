<?php
	$page = new Page("Create New Person", $person);
	$page->requireLogin();
	if($page->queryEqual("validate", "try")){
		$update = 0;
		if($person->validName($_POST['first_name'])){
			$first_name = strtolower($_POST['first_name']);
			$update = 1;
		}else{
			$page->addQuery("fnameError", 1);
			$update = 0;
		}
		
		if($person->validName($_POST['last_name'])){
			$last_name = strtolower($_POST['last_name']);
			$update = 1;
		}else{
			$page->addQuery("lnameError", 1);
			$update = 0;
		}

		if($person->validEmail($_POST['email'])){
			if(!$person->emailExists($_POST['email'])){
				$email = strtolower($_POST['email']);
				$update = 1;
			}else{
				$page->addQuery("emailError", 1);
				$update = 0;	
			}
		}else{
			$page->addQuery("emailError", 2);
			$update = 0;
		}
		if(!empty($_POST['password_A']) || !empty($_POST['password_B'])){
			if($_POST['password_A'] === $_POST['password_B']){
				if($person->validPassword($_POST['password_A'])){
					$password = $person->makePassword($_POST['password_A']);
					$update = 1;
				}else{
					$page->addQuery("passwordError", 2);
					$update = 0;
				}
			}else{
				$page->addQuery("passwordError", 1);
				$update = 0;
			}
		}
		if($update)
			$person->addPerson($email, $first_name, $last_name, $password);
			
		$page->addQuery("update", $update);			
		$page->removeQuery("validate");
		$page->redirect();
	}else{
		$page->showHeader();
?>
<div class="grid_12">
	<div class="widget">
    <header>
    	<div class="icon">
        	<span class="icon" data-icon="card"></span>
        </div>
		<div class="title">
        	<h2>Create New Person</h2>
        </div>
    </header>
    <div class="content" >
    	<form action="<?php echo $page->makeLink("validate", "try", array("dark", "page")); ?>" class="validate" method="post">
        	<fieldset class="set">
            	<div class="field">
                	<label> </label>
                    <div class="entry">
                    	<div class="dual">
                        	<input type="text" class="required" name="first_name" placeholder="First Name" />
                            <input type="text" class="required" name="last_name" placeholder="Last Name" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="set">
            	<div class="field">
                	<label> </label>
                    <div class="entry">
                    	<input type="text" class="custom[email]" name="email" placeholder="Email" />
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
	}
	$page->showFooter();
?>