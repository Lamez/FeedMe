<?php
	$page = new Page("Manage People", $person, 0);
	$page->requireLogin();
	$people = new People($db); //for $db see includes.php
	if($page->queryEqual("delete", 1)){
		$page->removeQuery("delete");
		if(!empty($_POST['delete'])){
			//might want to ask if they want to delete these people :3
			$i = 0;
			foreach($_POST['delete'] as $id){
				$db->delete(TBL_PEOPLE, "id = '".$id."'");
				$i++;
			}
			$page->addQuery("updatePeople", 1);
			$page->addQuery("removed", $i);
		}
		$page->redirect();
	}else if($page->queryEqual("addPerson", 1)){
		$page->removeQuery("addPerson");
		$data = $people->register($_POST["email"], $_POST["first_name"], $_POST["last_name"], $_POST["password_A"], $_POST["password_B"]);
		if(count($data[1]) == 0){ //No Errors..
			$page->addQuery("personAdded", 1);
			$session->remove("errors");
			$session->remove("values");
		}else{
			$session->add("errors", $data[1]);
			$session->add("values", $data[0]);
		}
		$page->redirect();
	}else{
		if($page->queryEqual("personAdded", 1)){
			$page->newNotice("Person Added", "A new account has been made.", "green");
		}
		if($page->queryEqual("updatePeople", 1)){
			$removed = $page->getQuery("removed");
			$page->newNotice("People Removed", "You removed ".$removed." people.", "red");
		}
		$page->showHeader();
		$all_people = $people->fetchAllPeople(); //Find all the peeps in the DB.
		$num_of_people = count($all_people);
	?>
	 <div class="grid_6">
		<div class="widget minimizable">
        	<?php
				if($page->queryEqual("updatePeople", 1))
					echo $page->newAlert("", "Seleted People Deleted", "green");
			?>
			<header>
				<div class="icon">
					<span class="icon" data-icon="cards-address"></span>
				</div>
				<div class="title">
					<h2><?php echo $page->getTitle(); ?></h2>
				</div>
				
			 </header>
			 <div class="content">
			 
				<form action="<?php echo $page->makeLink("delete", 1, array("page", "dark")); ?>" method="post">
					<ul class="users compact list">
						<?php for($i = 0; $i<$num_of_people; $i++){ ?>
						<li>
							<article>
								<figure><img src="<?php echo $page->getThemePath(); ?>/images/profile_image.png" width="20" height="20" alt="thumb" /></figure>
								<div class="info">
                               
									<h3><?php echo ucfirst($all_people[$i]["first_name"]). " " . ucfirst($all_people[$i]["last_name"]); ?></h3>
									<span><?php echo $all_people[$i]["email"]; ?></span>
								</div>
								<dl>
									<dt></dt>
									<dd><a href="<?php echo $page->makeMultiLink(array("page", "id"), array("edit_person", $all_people[$i]["id"])); ?>">Edit</a></dd>
									<?php if($all_people[$i]["id"] != $person->id()) { //So you cannot delete yourself.?>
										<dt></dt>
										<dd>
										<label>
											<span class="checked"><input type="checkbox" name="delete[]" value="<?php echo $all_people[$i]["id"]; ?>" class="js-init" style="opacity: 0;"></span>
										</label>
									<?php } ?>
									 </dd>
								</dl>
							</article>
						</li>
						<?php } //End for loop ?>
					</ul>
					<footer class="pane"><input type="submit" value="Delete" class="fullpane-bt" /></footer>
				</form>                     
			</div>
		</div>
	</div>
    <div class="grid_6">
        <div class="widget minimizable">
        	<?php
				if($page->queryEqual("personAdded", 1))
					echo $page->newAlert("", "Person Added", "green");
			?>
        <header>
            <div class="icon">
                <span class="icon" data-icon="card"></span>
            </div>
            <div class="title">
                <h2>Create New Person</h2>
            </div>
        </header>
        <div class="content">
        <?php
			$email = $first_name = $last_name = "";
        	if(!is_null($session->get("values"))){ //values from session
				$v = $session->get("values");
				$email = $v["email"];
				$first_name = $v["first_name"];
				$last_name = $v["last_name"];
			}
		
			$error_list = $session->get("errors");
			$session->remove("errors");
		?>
        	
            <form action="<?php echo $page->makeLink("addPerson", 1, array("dark", "page")); ?>" class="validate" method="post">
                <fieldset class="set">
                    <div class="field">
                        <div class="entry">
                            <div class="dual">
                                <input type="text" class="required" id="first_name" name="first_name" value="<?php echo $first_name; ?>" placeholder="First Name" />	
                                <input type="text" class="required" id="last_name" name="last_name" value="<?php echo $last_name; ?>" placeholder="Last Name" />
                                <div class="entry error-container">
                                	<div class="errors">
                                    	<?php 
											if(isset($error_list["first_name"]))
												echo '<label>'.$error_list["first_name"].'</label>';
											
											if(isset($error_list["last_name"]))
												echo '<label>'.$error_list["last_name"].'</label>';
										?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="set">
                    <div class="field">
                        <div class="entry">
                            <input type="text" class="required" name="email" value="<?php echo $email; ?>" placeholder="Email" />
                            <div class="entry error-container">
                               	<div class="errors">
                                   	<?php 
										if(isset($error_list["email"]))
											echo '<label>'.$error_list["email"].'</label>';
									?>
                            	</div>
                            </div>
                            
                        </div>
                    </div>
                </fieldset>
                <fieldset class="set">
                    <div class="field">
                        <div class="entry">
                            <input type="password" name="password_A" placeholder="Password" class="required" />
                            <div class="entry error-container">
                            	<div class="errors">
                                	<?php 
										if(isset($error_list["password"]))
											echo '<label>'.$error_list["password"].'</label>';
									?>
                            	</div>
                            </div>
                            
                        </div>
                    </div>
                </fieldset>
                <fieldset class="set">
                    <div class="field">   
                        <div class="entry">
                            <input type="password" name="password_B" placeholder="Re-type Password" class="required" />
                        </div>
                    </div>
                </fieldset>
                <footer class="pane">
                    <input type="submit" value="Add" class="fullpane-bt" />
                </footer>
            </form>
            </div>
        </div>
    </div>
<?php
		$page->showFooter();
		}//End Page->query("delete") if statement.
?>