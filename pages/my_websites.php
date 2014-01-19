<?php
	$page = new Page("My Websites", $person);
	$page->requireLogin();
	$website = new Website($db);
	if($page->getQuery("addWebsite") == 1){ //ADD A WEBSITE
		if($page->getQuery("insert") == 1 && $session->get("displayed_wb") == 1){
			$session->add("debug", $_POST);
			$session->add("name", $_POST["name"]);
			$_POST["address"] = strtolower($_POST["address"]);
			$_POST["address"] = stripslashes($_POST["address"]);
			$session->add("address", $_POST["address"]);
			$session->add("folder", $_POST["folder"]);
			$session->remove("displayed_wb");
			$page->removeQuery("insert");
			//field checking and insering into the DB.	
			if(!$website->validAddress($_POST["address"])){
				$page->addQuery("error", 1);
				$page->redirect();	
				exit;
			}else{
				if(empty($_POST["folder"])){
					$_POST["folder"] = "/";
				}else{
					$_POST["folder"] = stripslashes($_POST["folder"]);
					$_POST["folder"] = "/".$_POST["folder"];
				}
				if(!$website->hasProtocol($_POST["address"])){
					$_POST["address"] = "http://".$_POST["address"]; 
				}
				$website->add($_POST["name"], $_POST["address"], $_POST["folder"]);
				$session->remove("address");
				$session->remove("name");
				$session->remove("folder");
				$page->removeQuery("addWebsite");
				$page->redirect();
				exit;
			}
		}else{
			$name = $session->get("name");
			$address = $session->get("address");
			$folder = $session->get("folder");
			
			$page->showHeader();
			$page->removeQuery("error");
?>
        <div class="grid_12">
            <div class="widget minimizable">
            <header>
                <div class="icon">
                    <span class="icon" data-icon="card"></span>
                </div>
                <div class="title">
                    <h2>Add A Website</h2>
                </div>
            </header>
            <div class="content">
            <?php $session->add("displayed_wb", 1); ?>  	
                <form action="<?php echo $page->makeLink("insert", 1, array("dark", "page", "addWebsite")); ?>" class="validate" method="post">
                    <fieldset class="set">
                        <div class="field">
                     
                            <label>Website Name: </label>
                            <div class="entry">
                                <p>Enter the name of the website, this is for your reference!</p>
                                <input type="text" class="required" name="name" value="<?php echo $name; ?>"/>
                            </div>
                        </div>
                        <div class="field">
                            <label>Address: </label>
                            <div class="entry">
                                <input type="text" class="required" name="address" value="<?php echo $address; ?>"/>
                                 <?php
									if($page->getQuery("error") == 1){
										echo '<div class="error-container"><label for="address" class="error">The address you have entered is not valid.</label></div>';
									}
								?>
                            </div>
                        </div>
                        <div class="field">
                            <label>Folder: </label>
                            <div class="entry">
                                <p>Enter the folder you want <?php APP_NAME ?> to parse, leave blank for the root folder!</p>
                                <input type="text" name="folder" value="<?php echo $folder; ?>" />
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
		}//end else to if insert == 1
	}else if(is_numeric($page->getQuery("deleteWebsite"))){ //DELETE WEBSITE
		$id = $page->getQuery("deleteWebsite");
		if($website->IdExists($id)){
			if(!is_null($session->get("website-info-".$id))){
				if(!is_null($page->getQuery("ans"))){
					//handle the request
					$session->remove("website-info-".$id); //no longer needed..
					$page->removeQuery("deleteWebsite");
					$page->removeQuery("ans");
					if($page->getQuery("ans") == 2){//yes delete :(
						$website->delete($id);
					}
					$page->redirect();
					exit;
				}else{
					$page->showHeader();
					//ask user if they are sure they want to delete
					$data = $session->get("website-info-".$id);
					?>
					<div class="grid_12">
						<div class="widget minimizable">
							<header>
								<div class="icon"><span class="icon" data-icon="computer"></span></div>
								<div class="title"><h2>Delete?</h2></div>
							</header>
							<div class="content">
								<p style="padding: 5px; text-align:center;">
									Are you sure you want to delete <u><?php echo $data["name"]; ?></u>? <br />
									All of the information associated with this website will be permanently deleted and cannot be recoved!<br /><br />
									<div style="color:#000000; text-align: center">
										<?php echo  $data["name"]."<br />".
													$data["address"].$data["folder"]."<br /> Online? ".
													$data["online"]; ?>
								   
										<br /><br />
										<a href="?<?php echo $page->getQueryString(); ?>&ans=1" class="bt blue sm">No!</a> or <a href="?<?php echo $page->getQueryString(); ?>&ans=2" class="bt red sm">Yes!</a>
										<br /><br />
									</div>
								</p>
							</div>
						</div>
					</div>                
					<?php
				}
			}else{
				$page->removeQuery("deleteWebsite");
				$page->redirect();
			}
		}else{ //not in DB redirect
			$page->removeQuery("deleteWebsite");
			$page->redirect();
			exit;
		}
	}else{ //DEFAULT PAGE..SHOW WEBSITES.
		function printModal($id, $name, $address, $folder, $online, $button, $session){
			if($online)
				$online = '<font color="#00CC33">Yes</font>';
			else
				$online = '<font color="#FF0000">No</font>';
			$data = array(
				"name" => $name,
				"address" => $address,
				"folder" => $folder,
				"online" => $online
			);
			$session->add("website-info-".$id, $data);
			echo '							
			<div class="" style="color: #000000;">
                        <div id="website-'.$id.'" class="widget grid_6" hidden>
                            <header>
                                <div class="icon">
                                    <span class="icon" data-icon="applications-stack"></span>
                                </div>
                                
                                <div class="title">
                                    <h2>'.$name.'</h2>
                                </div>
                            </header>
                            <div class="content">
                                <div class="inner">
                                    <p>'.$name.'</p>
                                	<p>'.$address.$folder.'</p>
									<p>Online: '.$online.'</p>
								</div>
                                <footer class="pane">
                                    <a href="#" class="close bt red">Close</a>'.$button.'
                                </footer>
                            </div>
                        </div>
                    </div>';
		}
		$page->showHeader();
?>
<div class="grid_12">
	<div class="widget minimizable">
    	<header>
        	<div class="icon"><span class="icon" data-icon="computer"></span></div>
            <div class="title"><h2>My Websites</h2></div>
   		</header>
        <div class="content">
        	<div style="margin-left: 1%;  padding-top: 1%; "><?php echo $page->newButton("?".$page->getQueryString().'&addWebsite=1', "small bt blue", "Add Website"); ?></div>
            <table class="datatable">
            	<thead>
                	<tr>
                    	<th class="">ID</th>
                        <th class="">Name</th>
                   		<th class="">Address</th>
                    	<th>Folder</th>
                   	</tr>
            	</thead>
         		<tbody>
                	<?php
						$array = $website->getAll();
						foreach($array as $data){
							if(is_null($session->get("website-online-".$data["id"]))){
								$session->add("website-online-".$data["id"], $website->isUp($data["address"]));
							}
							//$online = $website->isUp($data["address"]) ? "Yes" : "No";
							$online = "?";
							echo '<tr>
								  	<td>'.$data["id"].'</td>
								  	<td><a href="#website-'.$data["id"].'" title="Open modal" class="modal"><span class="glyph open-in-new-window"></span> '.$data["name"].'</a></td>
								  	<td>'.$data["address"].'</td>
								  	<td>'.$data["folder"].'</td>
							 	  </tr>';
								  $page->changeQuery("deleteWebsite", $data["id"]);
								  printModal(
									  $data["id"], 
									  $data["name"], 
									  $data["address"], 
									  $data["folder"], 
									  $session->get("website-online-".$data["id"]), 
									  '<a href=?'.$page->getQueryString().' class="bt red lg">Delete This Website?</a>',
									  $session
								  );//I could have just passed the data array..., silly goose.
						}
						$page->removeQuery("deleteWebsite");
					?>
             	</tbody>
          	</table>
     	</div>
	</div>
</div>
<?php
	}//end if addWebsite == 1
	$page->showFooter();
?>