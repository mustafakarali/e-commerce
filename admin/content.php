<?php
	session_start();
	include "includes/dbcon.php";
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {	
	$about = mysql_query("SELECT content FROM tbl_about");
						while($row=mysql_fetch_array($about))
						{
							$content1 = $row['content'];
						}
	
	$terms = mysql_query("SELECT * FROM tbl_terms");
						while($row=mysql_fetch_array($terms))
						{
							$content2 = $row['description'];
						}
	if(isset($_POST['update1']))
	{
		$desc = $_POST['desc'];
		
		if(empty($desc))
		{
			echo "<script>alert (\"Please fill out the field!\")</script>";
		}
		else{
			$sql1 = mysql_query("UPDATE tbl_about SET content='$desc' WHERE about_id='1'")
								or die (mysql_error());
								
			echo "<script>alert (\"Content Updated!\")</script>";
		}
	}
	/*if(isset($_POST['update2']))
	{
		$desc = $_POST['desc'];
		
		if(empty($desc))
		{
			echo "<script>alert (\"Please fill out the field!\")</script>";
		}
		else{
			$sql2 = mysql_query("UPDATE tbl_terms SET description='$content2' WHERE term_id='1'")
								or die (mysql_error());
								
			echo "<script>alert (\"Content Updated!\")</script>";
		}
	}	*/
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Administrator | Content Management</title>
         <link rel="shortcut icon" href="../_public/img/favicon.ico" />		
        <!-- Bootstrap --> 
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> 
		<link href="assets/styles.css" rel="stylesheet" media="screen">
		<link href="css/colorpicker.css" rel="stylesheet">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--> <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
	                                    <li>Content Management</a> 	</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
					<div class="block">
                            	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#about" data-toggle="tab">About Us</a></li>
                <li><a href="#terms" data-toggle="tab">Terms and Conditions</a></li>
			</ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="about">
					
                <p>         
                        <!-- block -->
                       <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>About Us</h5></div>
                                </div>
                                <div class="block-content collapse in">
								<form method="POST" action="">
                                    <table>

                                            <tr>
												<td valign="top"><label class="control-label" for="textarea2">Content&nbsp;&nbsp;&nbsp;</label></td>
												<td><textarea class="input-xlarge textarea" name="desc" placeholder="Enter text ..." style="width: 570px; height: 200px"><?php
						
						
						echo $content1;
						
					?></textarea>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td><button type="submit" name="update1" class="btn btn-primary">Update Content</button>
                                          <button type="reset" class="btn">Cancel</button></td>
                                            </tr>
                                    </table>
									</form>
                                </div>
                            </div>
				</p>
                </div>
				
                <div class="tab-pane fade" id="terms">				
                  <p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Terms and Conditions</h5></div>
                                </div>
                                <div class="block-content collapse in">
								<form method="POST" action="">
                                    <table>

                                            <tr>
												<td valign="top"><label class="control-label" for="textarea2">Content&nbsp;&nbsp;&nbsp;</label></td>
												<td><textarea class="input-xlarge textarea" name="desc" placeholder="Enter text ..." style="width: 570px; height: 200px"><?php
						
						
						
						echo $content2;
						
						
					?></textarea>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td><button type="submit" name="update2" class="btn btn-primary">Update Content</button>
                                          <button type="reset" class="btn">Cancel</button></td>
                                            </tr>
                                    </table>
									</form>
                                </div>
                            </div>				  
				  </p>
                </div>


              </div>
            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>		
        <!--/.fluid-container--> <link href="vendors/datepicker.css" rel="stylesheet" media="screen"> <link href="vendors/uniform.default.css" rel="stylesheet" media="screen"> <link href="vendors/chosen.min.css" rel="stylesheet" media="screen"> <link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen"> <script src="vendors/jquery-1.9.1.js"></script> <script src="bootstrap/js/bootstrap.min.js"></script> <script src="vendors/jquery.uniform.min.js"></script> <script src="vendors/chosen.jquery.min.js"></script> <script src="vendors/bootstrap-datepicker.js"></script> <script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script> <script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script> <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script> <script src="css/colorpicker.css"></script> <script src="js/bootstrap-colorpicker.js"></script> <script src="less/colorpicker.less"></script> <script src="assets/scripts.js"></script>
        <script>
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();
			$('.colorpicker').colorpicker();
			
			$('.colorpicker').colorpicker().on('changeColor', function(ev){
			bodyStyle.backgroundColor = ev.color.toHex();
			});
			

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
