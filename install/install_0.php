<?php
	$path = "../";
	include("includes.php");
	$session->add("install_0", false);
	$page = new Page("Installation Wizard");
	$page->setPath($path);
	$page->showHeader(true);
	$session->displayAll();
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
					echo $session->displayAll();
				?>
				<div class="grid_12">
                    <div class="widget">
                        <header>
                            <div class="icon">
                                <span class="icon" data-icon="table" style="background-image: url(http://localhost/FeedMe/Template/final/examples/images/fugue-icons/icons/table.png);"></span>
                            </div>
                            <div class="title"><h2>File Premissions</h2></div>
                        </header>
                        <div class="content" style="display: block;">
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
                        </div>
                    </div>
                </div>
                <p align="center">
					<?php
                        if($bool){
							echo '<a href="install_1.php" class="bt blue large"><span class="glyph"></span>Next Step</a>'; 
						}
                    ?>
                </p>
        </div>
	</div>
</div>
<?php
	$page->showFooter(true);
?>