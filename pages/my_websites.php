<?php
	$page = new Page("My Websites", $person);
	$page->requireLogin();
	$page->showHeader();
	$website = new Website($db);
	if($page->getQuery("addWebsite") == 1){
		$name = "";
		$address = "";
		$folder = "";
		//add entry checking and update DB
		//if insert == 1
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
            <form action="<?php echo $page->makeLink("insert", 1, array("dark", "page", "addWebsite")); ?>" class="validate" method="post">
            	<fieldset class="set">
            		<div class="field">
                 
                    	<label>Website Name: </label>
                        <div class="entry">
                        	<p>Enter the name of the website, this is for your reference!</p>
                       		<input type="text" class="required" name="name" />
                  		</div>
                    </div>
            		<div class="field">
                    	<label>Address: </label>
                        <div class="entry">
                        	<p>Do not add the http:// or https://, I will take care of it!</p>
                       		<input type="text" class="required" name="address" />
                  		</div>
                    </div>
            		<div class="field">
                    	<label>Folder: </label>
                        <div class="entry">
                        	<p>Enter the folder you want <?php APP_NAME ?> to parse, leave blank for the root folder!</p>
                       		<input type="text" name="folder" />
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