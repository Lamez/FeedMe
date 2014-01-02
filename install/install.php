<?php
	//index.php for /install project.
	$path = "../";
	include($path."includes.php");
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
        <div class="content" style="padding-top: 10px; padding-bottom: 10px">
        	<p style="padding: 5px;">In order for <?php echo APP_NAME." ".VERSION; ?> to work correctly, certain files must be writeable.</p>
 			<p>
				<?php 
					$check = substr(sprintf('%o', fileperms($path."constants.php")), -4);
					settype($check, "int");
					$bool = chmod($path."constants.php", 0755) || $check == 755;
					if($bool)
						$color = "66ff99";
					else
						$color = "ff6633"; 
						?>
                    <table width="40%" border="0" style="margin-left: 35%;">
                    	<tr>
                        	<td><u>File Name</u></td>
                            <td><u>Required Premissions</u></td>
                            <td><u>Current Premissions</u></td>
                        </tr>
                        <tr bgcolor="<?php echo $color; ?>" style="color: black;">
                        	<td> /Constants.php</td>
                            <td> 0755</td>
                            <td> 0<?php echo $check; ?></td>
                         </tr>
                     </table>
                     <?php
						if($bool)
							echo "link";
					?>
            </p>
        </div>
	</div>
</div>
<?php
	$page->showFooter(true);
?>