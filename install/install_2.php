<?php
	$path = "../";
	include("includes.php");
	$page = new Page("Installation Wizard");
	$page->setPath($path);
	if($session->get("install_1") != 1){
		$page->redirect($page->getURL."install_1.php");
		exit;
	}
	$page->showHeader(true);
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
        	<p style="padding: 5px;">In order for <?php echo APP_NAME." ".VERSION; ?> to work correctly, certain files must be writeable.</p>
				
            <footer class="pane">

         	</footer>
    	</div>
  	</div>
</div>
<?php
	$page->showFooter(true);
?>