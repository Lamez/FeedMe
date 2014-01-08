<?php
	$path = "../";
	include("includes.php");
	$page = new Page("Installation Wizard");
	$page->setPath($path);
	$page->showHeader(true);
?>   
<div class="grid_12">
	<div class="widget wizard">
    	<header>
        	<div class="title">
            	<h2><?php echo $page->getTitle(); ?></h2>
                <span>Step 1: Checking File Premissions</span>
          	</div>
       		<nav class="steps">
            	<ul>
                	<li class="active">
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
				<?php 
					//$check = substr(sprintf('%o', fileperms($path."constants.php")), -4);
					//settype($check, "int");
					//$bool = chmod("constants.php", 0755) || $check == 755;
					$bool = is_writable($path."constants.php");
					if($bool)
						$color = "009900"; //green. 66ff99.
					else
						$color = "ff0000"; //red.
					$session->change("install_0", $bool);
				?>
        	<table class="table">
            	<thead>
                	<tr>
                    	<th>File Name</th>
                        <th>Writable</th>
                 	</tr>
             	</thead>
                <tbody>
                	<tr>
                    	<td><p style="color: #<?php echo $color; ?>"><?php echo $path; ?>constants.php</p></td>
                        <td><p style="color: #<?php echo $color; ?>"><?php echo ($bool ? "Yes" : "No") ?></p></td>
                    </tr>
        		</tbody>
   			</table>
            <footer class="pane">
           		<p align="center">
					<?php
                    	if($bool){
							echo $page->newButton("install_1.php", "bt blue large", "Next Step >", true);
							//echo '<a href="install_1.php" class="bt blue large"><span class="glyph"></span>Next Step ></a>'; 
						}
                    ?>
                </p>
         	</footer>
    	</div>
  	</div>
</div>
<?php
	$page->showFooter(true);
?>