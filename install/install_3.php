<?php
	$path = "../";
	include("includes.php");
	$page = new Page("Installation Wizard");
	$page->setPath($path);
	if($session->get("install_2") != 1){
		$page->redirect($page->getURL."install_2.php");
		exit;
	}else if(defined("INSTALLED")){
		$page->redirect("../");
		exit; //I need to stop adding these..
	}else if($page->getQuery("login") == 1){
		install(); //see includes.php
		$session->removeAll(); //starting clean!
		$page->redirect("../");
	}
	$page->showHeader(true);	
?>   
<div class="grid_12">
	<div class="widget wizard">
    	<header>
        	<div class="title">
            	<h2><?php echo $page->getTitle(); ?></h2>
                <span>Step 4: Finished!</span>
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
                    <li>
                    	<div>3</div>
                        <span>Account Setup</span>
                   	</li>
                    <li class="active">
                    	<div>4</div>
                        <span>Finished</span>
                  	</li>
               	</ul>
        	</nav>
      	</header>
        <div class="content">
        	<p style="padding: 5px;">We are done! It is time to login with your new account! It it would be a wise idea to delete the install folder.</p>
                <footer class="pane">
                	<p align="center">
                    	<?php 
							$page->addQuery("login", 1);
							echo $page->newButton("?".$page->getQueryString(), "bt blue lg", "Login >"); 
						?>
                    </p>
                </footer>
    	</div>
  	</div>
</div>
<?php
	$page->showFooter(true);
?>