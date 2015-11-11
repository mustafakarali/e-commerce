<?php
	session_start();
	include "includes/dbcon.php";
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {	
	$btnactive = "<button class='btn btn-primary' name='btn'><i class='icon-pencil icon-white'></i> Edit</button>";
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Administrator | Catalogue</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
<?php include 'includes/sidebar.php'; ?>
                
                <!--/span-->
                <div class="span12" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="dashboard.php">Menu Panel</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Catalogue</a></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#bracelets" data-toggle="tab">Bracelets</a></li>
                <li><a href="#earrings" data-toggle="tab">Earrings</a></li>
                <li><a href="#necklace" data-toggle="tab">Necklace</a></li> 
                <li><a href="#pendants" data-toggle="tab">Pendants</a></li>
                <li><a href="#rings" data-toggle="tab">Rings</a></li> 
                <li><a href="#sets" data-toggle="tab">Sets</a></li>
				
			</ul>
              <div id="myTabContent" class="tab-content">
			  <!-- start bracelets -->
                <div class="tab-pane fade active in" id="bracelets">
					
                <p>                 
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Bracelets</h5></div>
                                    <div class="pull-right"><a href="newbracelets.php">
                                      <button class="btn" style="margin-bottom:5px;"> Add New Item</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Image File</th>
                                                <th>Pearl Type</th>
                                                <th>Price</th>
												<th>Description</th>
												<th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$sql = mysql_query("SELECT * FROM tbl_bracelets");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->bracelets_no . "</td>";
														echo "<td>" . $row->name . "</td>";
														echo "<td align='center'>" . "<img border=\"0\" src=\"../products/bracelets/".$row->path."\" width=\"75\" height=\"75\">" . "</td>";
														echo "<td>" . $row->type . "</td>";
														echo "<td>" . $row->price . "</td>";
														echo "<td>" . $row->description . "</td>";
														echo "<td>" . $row->stock . "</td>";
														echo "<td>" . "<a href=\"updateBracelets.php?myVar=$row->bracelets_no\">". $btnactive."</td>";
														echo "</tr>";
													}
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
				</p>
                </div>
			  <!-- end bracelets -->
			  
			  <!-- start earrings -->				
                <div class="tab-pane fade" id="earrings">				
                  <p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Earrings</h5></div>
                                    <div class="pull-right"><a href="newearrings.php">
                                      <button class="btn" style="margin-bottom:5px;"> Add New Item</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Image File</th>
                                                <th>Pearl Type</th>											
                                                <th>Price</th>
												<th>Description</th>
												<th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
													$sql = mysql_query("SELECT * FROM tbl_earrings");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->earrings_no . "</td>";
														echo "<td>" . $row->name . "</td>";
														echo "<td align='center'>" . "<img border=\"0\" src=\"../products/earrings/".$row->path."\" width=\"75\" height=\"75\">" . "</td>";
														echo "<td>" . $row->type . "</td>";
														echo "<td>" . $row->price . "</td>";
														echo "<td>" . $row->description . "</td>";
														echo "<td>" . $row->stock . "</td>";
														echo "<td>" . "<a href=\"updateEarrings.php?myVar=$row->earrings_no\">". $btnactive."</td>";
														echo "</tr>";
														echo "</tr>";
													}
												?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>				  
				  </p>
                </div>
			<!-- end earrings -->
			
			<!-- start necklace -->
                <div class="tab-pane fade" id="necklace">
				<p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Necklace</h5></div>
                                    <div class="pull-right"><a href="newnecklace.php">
                                      <button class="btn" style="margin-bottom:5px;"> Add New Item</button>
                                    </a>
                                    </div>									
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Image File</th>
                                                <th>Pearl Type</th>											
                                                <th>Price</th>
												<th>Description</th>
												<th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$sql = mysql_query("SELECT * FROM tbl_necklace");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->necklace_no . "</td>";
														echo "<td>" . $row->name . "</td>";
														echo "<td align='center'>" . "<img border=\"0\" src=\"../products/necklace/".$row->path."\" width=\"75\" height=\"75\">" . "</td>";
														echo "<td>" . $row->type . "</td>";
														echo "<td>" . $row->price . "</td>";
														echo "<td>" . $row->description . "</td>";
														echo "<td>" . $row->stock . "</td>";
														echo "<td>" . "<a href=\"updateNecklace.php?myVar=$row->necklace_no\">". $btnactive."</td>";
														echo "</tr>";
														echo "</tr>";
													}
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>				
				</p>
                </div>
			<!-- end necklace -->
			
			<!-- start pendant -->
                <div class="tab-pane fade" id="pendants">
				<p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Pendants</h5></div>
                                    <div class="pull-right"><a href="newpendant.php">
                                      <button class="btn" style="margin-bottom:5px;"> Add New Item</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Image File</th>
                                                <th>Pearl Type</th>											
                                                <th>Price</th>
												<th>Description</th>
												<th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$sql = mysql_query("SELECT * FROM tbl_pendant");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->pendant_no . "</td>";
														echo "<td>" . $row->name . "</td>";
														echo "<td align='center'>" . "<img border=\"0\" src=\"../products/pendant/".$row->path."\" width=\"75\" height=\"75\">" . "</td>";
														echo "<td>" . $row->type . "</td>";
														echo "<td>" . $row->price . "</td>";
														echo "<td>" . $row->description . "</td>";
														echo "<td>" . $row->stock . "</td>";
														echo "<td>" . "<a href=\"updatePendant.php?myVar=$row->pendant_no\">". $btnactive."</td>";
														echo "</tr>";
														echo "</tr>";
													}
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>				
				</p>
                </div>
			<!-- end pendant -->	
			<!-- start ring -->
                <div class="tab-pane fade" id="rings">
				<p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Rings</h5></div>
                                    <div class="pull-right"><a href="newrings.php">
                                      <button class="btn" style="margin-bottom:5px;"> Add New Item</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Image File</th>
                                                <th>Pearl Type</th>
                                                <th>Price</th>
												<th>Description</th>
												<th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$sql = mysql_query("SELECT * FROM tbl_rings");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->rings_no . "</td>";
														echo "<td>" . $row->name . "</td>";
														echo "<td align='center'>" . "<img border=\"0\" src=\"../products/rings/".$row->path."\" width=\"75\" height=\"75\">" . "</td>";
														echo "<td>" . $row->type . "</td>";
														echo "<td>" . $row->price . "</td>";
														echo "<td>" . $row->description . "</td>";
														echo "<td>" . $row->stock . "</td>";
														echo "<td>" . "<a href=\"updateRings.php?myVar=$row->rings_no\">". $btnactive."</td>";
														echo "</tr>";
														echo "</tr>";
													}
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>				
				</p>
                </div>	
			<!-- end ring -->	
			<!-- start sets -->
                <div class="tab-pane fade" id="sets">
				<p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Sets</h5></div>
                                    <div class="pull-right"><a href="newsets.php">
                                      <button class="btn" style="margin-bottom:5px;"> Add New Item</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Image File</th>
                                                <th>Pearl Type</th>
												<th>Description</th>
												<th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$sql = mysql_query("SELECT * FROM tbl_set");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->set_no . "</td>";
														echo "<td>" . $row->name . "</td>";
														echo "<td align='center'>" . "<img border=\"0\" src=\"../products/set/".$row->path."\" width=\"75\" height=\"75\">" . "</td>";
														echo "<td>" . $row->type . "</td>";
														echo "<td>" . $row->price . "</td>";
														echo "<td>" . $row->description . "</td>";
														echo "<td>" . $row->stock . "</td>";
														echo "<td>" . "<a href=\"updateSet.php?myVar=$row->set_no\">". $btnactive."</td>";
														echo "</tr>";
														echo "</tr>";
													}
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>				
				</p>
                </div>
			<!-- end sets -->
			 </div>
            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
            </div>
            <hr>
<?php include 'includes/footer.php'; ?>
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>
<?php } ?>