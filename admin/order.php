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
					$acsql =	mysql_query("UPDATE tbl_order SET action='Completed' WHERE order_no='$id'")
								or die (mysql_error(). "Can't Update :( ");
								$msg = "<script>alert (\"Transaction has been completed!!!\")</script>";
								echo $msg;
				}
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Administrator | Orders</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
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
	                                    <li>Orders</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Orders</div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Date</th>
												<th>Transaction Code</th>
												<th>Receipt Number</th>
												<th>Payment Status</th>
												<th>Payment Action</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$sql = mysql_query("SELECT b.order_no,a.first_name, a.last_name, b.date, b.payment_code, b.amount, b.status, b.action
													FROM tbl_members a
													JOIN tbl_order b ON b.member_id = a.member_id");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->order_no . "</td>";
														echo "<td>" . $row->first_name .' '. $row->last_name . "</td>";
														echo "<td>" . $row->amount . "</td>";
														echo "<td>" . $row->date . "</td>";
														echo "<td>" . $row->payment_code . "</td>";
														echo "<td>" . $row->receipt . "</td>";
														echo "<td>" . $row->status . "</td>";
														echo "<td>" . $row->action . "</td>";
														echo "<td>" . "<a href=\"order.php?myVar=$row->order_no&acti='Completed'\"><button class='btn btn-success btn-mini notification' id='notification-sticky' name='acti' > Approve</button></a>" . "</td>";
														echo "</tr>";
														
														
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
        <link href="vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/jquery.uniform.min.js"></script>
        <script src="vendors/chosen.jquery.min.js"></script>
        <script src="vendors/bootstrap-datepicker.js"></script>

        <script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>


        <script src="assets/scripts.js"></script>
        <script>
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>
    </body>

</html>
<?php } ?>