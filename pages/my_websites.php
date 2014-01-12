<?php
	$page = new Page("My Websites", $person);
	$page->requireLogin();
	$page->showHeader();
	$website = new Website($db);
?>
 <div class="grid_12">
                        <div class="widget minimizable">
                            <header>
                                <div class="icon">
                                    <span class="icon" data-icon="computer"></span>
                                </div>

                                <div class="title">
                                    <h2>My Websites</h2>
                                </div>
                            </header>

                            <div class="content">
                                
                                    <table class="datatable">
                                        <thead>
                                            <tr>
                                                <th class="w20">ID</th>
                                                <th class="w20">Name</th>
                                                <th class="w20">Address</th>
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
	$page->showFooter();
?>