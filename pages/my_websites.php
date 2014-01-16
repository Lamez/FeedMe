<?php
	$page = new Page("My Websites", $person);
	$page->requireLogin();
	$website = new Website($db);
	if($page->getQuery("addWebsite") == 1){
		if($page->getQuery("insert") == 1 && $session->get("displayed_wb") == 1){
			$session->add("name", $_POST["name"]);
			$session->add("address", $_POST["address"]);
			$session->add("folder", $_POST["folder"]);
			//field checking and insering into the DB.	
			
			$session->remove("displayed_wb");
			$page->removeQuery("insert");
			$page->redirect();
			exit;
		}
		$name = $session->get("name");
		$address = $session->get("address");
		$folder = $session->get("folder");
		
		$page->showHeader();
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
	}else{
		$page->showHeader();
?>
<div class="grid_12">
	<div class="widget minimizable">
    	<header>
        	<div class="icon"><span class="icon" data-icon="computer"></span></div>
            <div class="title"><h2>My Websites</h2></div>
   		</header>
        <div class="content">
       		<?php
				$page->addQuery("addWebsite", 1);
			?>
        	<div style="margin-left: 1%;  padding-top: 1%; "><?php echo $page->newButton("?".$page->getQueryString(), "small bt blue", "Add Website"); ?></div>
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
							echo '<tr>
								  	<td>'.$data["id"].'</td>
								  	<td>'.$data["name"].'</td>
								  	<td>'.$data["address"].'</td>
								  	<td>'.$data["folder"].'</td>
							 	  </tr>';
						}
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