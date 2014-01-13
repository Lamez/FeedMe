<?php
	//This file is used by Page.php that is in the includes folder. This page is included..
	//$this referes to the page object. core/Page.php
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $this->getTitle(); ?></title>
        
        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>css/reset.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>css/grid-fluid.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>css/websymbols.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>css/formalize.css" />
        <script type="text/javascript">var basePathIcons = '<?php echo $this->getThemePath(); ?>images/fugue-icons/icons/'; </script> 
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>css/esplendido.css" />
        <?php if(!$this->queryEqual("dark", 1)){ //if dark does notexists and dark is not true ?>
       		<link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>css/light.css" />
        <?php } ?>
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>plugins/chosen/chosen.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>plugins/ui/ui-custom.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>plugins/tipsy/tipsy.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>plugins/validationEngine/validationEngine.jquery.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>plugins/elrte/css/elrte.min.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>plugins/miniColors/jquery.miniColors.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>plugins/fullCalendar/fullcalendar.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>plugins/elfinder/css/elfinder.css" />
        <link rel="stylesheet" href="<?php echo $this->getThemePath(); ?>plugins/shadowbox/shadowbox.css" />

        <!-- JAVASCRIPTs -->
        <!--[if lt IE 9]>
            <script language="javascript" type="text/javascript" src="<?php echo $this->getThemePath(); ?>plugins/jqPlot/excanvas.min.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo $this->getThemePath(); ?>js/html5shiv.js"></script>
        <![endif]-->
        <script src="<?php echo $this->getThemePath(); ?>js/jquery.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>js/esplendido.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>js/browserDetect.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>js/jquery.formalize.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/prefixfree.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jquery.uniform.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/chosen/chosen.jquery.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/ui/ui-custom.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/ui/multiselect/js/ui.multiselect.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/ui/ui.spinner.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/datables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jquery.metadata.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/sparkline.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/progressbar.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/feedback.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/tipsy/jquery.tipsy.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jquery.maskedinput-1.3.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jquery.validate.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/validationEngine/languages/jquery.validationEngine-en.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/validationEngine/jquery.validationEngine.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jquery.elastic.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/elrte/elrte.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/miniColors/jquery.miniColors.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/fullCalendar/fullcalendar.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/elfinder/elfinder.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jquery.modal.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/shadowbox/shadowbox.js"></script>
        <!-- chart -->
        <script src="<?php echo $this->getThemePath(); ?>plugins/jqPlot/jquery.jqplot.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jqPlot/plugins/jqplot.cursor.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jqPlot/plugins/jqplot.highlighter.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jqPlot/plugins/jqplot.barRenderer.min.js"></script>
        <script src="<?php echo $this->getThemePath(); ?>plugins/jqPlot/plugins/jqplot.pointLabels.min.js"></script>


        <!-- /chart -->
        <link rel="shortcut icon" href="<?php echo $this->getThemePath(); ?>images/favicon.png">
    </head>

<body>
            <div id="wrapper" class="container_12">

           
            <?php if(!$simpleHeader){ ?>
            <!-- # Sidebar -->
            <aside id="sidebar">
                <!-- Logo -->
                <div id="logo">
                    <img src="<?php echo $this->getThemePath(); ?>images/logo-small.png" alt="Logo" />
                </div>
                <!-- /Logo -->
                <!-- Me bar -->
                <div id="me" class="secondary-widget">
                    <figure>
                        <img src="<?php echo $this->getThemePath(); ?>images/profile_image.png" alt="Profile Image" width="50px" height="50px" />
                    </figure>
                    <div>
                        <h1><?php echo $this->person; ?></h1>
                        <center><ul>
                            <li><a href="<?php echo $this->makeLink("page", "edit_person"); ?>" title="Edit profile">Edit Profile</a></li>
                            <li><a href="<?php echo $this->makeLink("page", "logout"); ?>" title="Logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /Me bar -->
                <!-- Menu -->
                <div class="menu primary-widget">
                	<nav>
                    	<ul>
							<?php 
                                echo $this->newMenuItem("Home", "home", "cloud");
								echo $this->newMenuItem("My Websites", "my_websites", "list-with-icons");
								//echo $this->newMenuItem("Template Home", "http://themeforest.net/item/esplendido-premium-admin-template/2245222?sso?WT.ac=search_item&WT.seg_1=search_item&WT.z_author=lucaswxp", "cloud", true);
                            	echo $this->newSubMenu("People Managment", 
								array("My Profile", "Manage People",), 
								array("edit_person", "manage_people"), 
								"user");
								echo $this->newMenuItem("SMTP Settings", "smtp_settings", "database");
							?>
                    	</ul>
                    <nav>
                </div>
                <!-- /Menu -->
            </aside>
            <!-- /Sidebar -->                
                <!-- Content section -->
            
            <!-- # Main section -->
            <section id="main">
                            <!-- QuickActions section -->
                <section id="quick-actions" class="quick-actions grid_12">
                    <nav>
                        <ul>
                            <li>
                                <a href="<?php echo $this->makeLink("page", "logout"); ?>" title="Logout" class="modal">
                                    <span class="glyph logout"></span>
                                    Logout
                                </a>
                            </li>
                       		<?php if(!$this->queryEqual("dark", 1)){ ?>
                                <li>
                                    <a href="<?php echo $this->makeLink("dark", 1, array("page")); ?>" title="Change Theme" class="modal">
                                        <span class="glyph move"></span>
                                        Dark Theme
                                    </a>
                                </li>
                            <?php }else{ ?>
                                 <li>
                                    <a href="<?php echo $this->makeLink("dark", 0, array("page")); ?>" title="Change Theme" class="modal">
                                        <span class="glyph move"></span>
                                        Light Theme
                                    </a>
                                </li>
                          <?php } ?>
                        </ul>
                    </nav>
                </section>
                                <!-- Content section -->
                <section id="content">
			
                    <header class="pagetitle grid_12">
                        <h1><?php echo $this->getTitle(); ?></h1>
                        	<?php if($this->showCrumbs()){ 
							print_r($this->crumbs); ?>
                            <nav class="breadcrumbs">
                                <ul>							 
                                    <li><a href="#"><?php $this->printCrumb(0); ?></a></li>
                                    <li><a href="#"><?php $this->printCurmb(1); ?></a></li>
                                    <li><a href="#"><?php $this->printCrumb(2); ?></a></li>
                                </ul>
                            </nav>
                           <?php } ?>
                    </header>
                </section>
 <?php } //simpleHeader if statement closing brace?>