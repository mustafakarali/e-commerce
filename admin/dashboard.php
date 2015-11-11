<?php
	session_start();
	include("includes/dbcon.php");
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {		
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Administrator | Menu Panel</title>
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
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Menu Panel</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="row-fluid padd-bottom">
                                  <div class="span3">
                                      <a href="catalogue.php" class="thumbnail">
                                        <img title="Catalogue" data-src="holder.js/260x180" alt="260x180" style="width: 200px; height: 200px;" src="images/clipboard.png">
                                      </a>
                                  </div>
                                  <div class="span3">
                                      <a href="member.php" class="thumbnail">
                                        <img title="Members" data-src="holder.js/260x180" alt="260x180" style="width: 200px; height: 200px;" src="images/book.png">
                                      </a>
                                  </div>
                                  <div class="span3">
                                      <a href="order.php" class="thumbnail">
                                        <img title="Orders" data-src="holder.js/260x180" alt="260x180" style="width: 200px; height: 200px;" src="images/calendar.png">
                                      </a>
                                  </div>
                                  <div class="span3">
                                      <a href="content.php" class="thumbnail">
                                        <img title="Edit Page" data-src="holder.js/260x180" alt="260x180" style="width: 200px; height: 200px;" src="images/colors.png">
                                      </a>
                                  </div>
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