<?php
	session_start();
	include "includes/dbcon.php";
	error_reporting(0);
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {	
	$id = $_REQUEST['myVar'];
	if(isset($_REQUEST['acti']))
				{
					$acsql =	mysql_query("UPDATE tbl_members SET status='1' WHERE member_id='$id'")
								or die (mysql_error(). "Can't Update :( ");
								$msg = "<script>alert (\"Members's Account is Activated!!\")</script>";
								echo $msg;
				}
				if(isset($_REQUEST['deac']))
				{

					$acsql =	mysql_query("UPDATE tbl_members SET status='0' WHERE member_id='$id'")
								or die (mysql_error(). "Can't Update :( ");
														
					$msg = "<script>alert (\"Member's Account is Deactivated!!\")</script>";
					echo $msg;
					}
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Administrator | Members </title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
		<link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
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
	                                    <li>Members</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Members</div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
												<th>Country</th>
												<th>Region</th>
												<th>City</th>
												<th>Address</th>
												<th>Contact</th>
												<th>Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
													$sql = mysql_query("SELECT * FROM tbl_members");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->member_id . "</td>";
														echo "<td>" . $row->first_name . "</td>";
														echo "<td>" . $row->last_name . "</td>";
														echo "<td>" . $row->email . "</td>";
														echo "<td>" . $row->country . "</td>";
														echo "<td>" . $row->region . "</td>";
														echo "<td>" . $row->city . "</td>";
														echo "<td>" . $row->address . "</td>";
														echo "<td>" . $row->contact . "</td>";
														echo "<td>" . $row->status . "</td>";
														echo "<td>" . "<a href=\"member.php?myVar=$row->member_id&acti=1\"><button class='btn btn-success btn-mini notification' id='notification-sticky' name='acti' > Activate</button></a>
																		<a href=\"member.php?myVar=$row->member_id&deac=0\"><button class='btn btn-danger btn-mini notification' id='notification-header' name='deacS'> Deactivate</button></a>"."</td>";
																		
													}
												?>
                                        </tbody>
                                    </table>
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
                <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>


        <script src="assets/scripts.js"></script>
        <script src="assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
            
        });
        </script>
    </body>

</html>
<?php } ?>