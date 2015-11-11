<?php
	session_start();
	include "includes/dbcon.php";
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {	
	$uploadDir = '../products/bracelets/'; 
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Administrator | Add New Item</title>
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
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
	<script src="../js/jqBootstrapValidation.js"></script>
	<script>
	  $(function () {
	  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
	</script>			
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
<?php include 'includes/sidebar.php'; ?>
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="dashboard.php">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
										<li>
	                                        <a href="catalogue.php">Catalogue</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Add New Item</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				


                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Add New Item</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form class="form-horizontal" name="image" method="POST" enctype="multipart/form-data" action="">
                                      <fieldset>
                                        <legend>Add New Item</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Item Name </label>
                                          <div class="controls">
                                            <input type="text" name="item" class="span6" placeholder="Item Name" value="<?php
						if(isset($_POST['submit'])){
							echo $_POST['item'];
						}else{
							echo "";
						}
					?>" required>
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['submit']))
							{
								$name = $_POST['item'];
                            	
								if(!preg_match('/^[A-Z][a-zA-Z -]+$/',$name))
								{
								echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid Format!</span>
                                          </div>
                                        </div>";
			
								}
							}
	 ?>
										  </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="fileInput">Image File</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" name="photo" id="fileInput" type="file" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" value="<?php
						if(isset($_POST['submit'])){
							echo $_POST['photo'];
						}else{
							echo "";
						}
					?>">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Pearl Type </label>
                                          <div class="controls">
                                            <input type="text" name="type" class="span6" placeholder="Pearl Type" value="<?php
						if(isset($_POST['submit'])){
							echo $_POST['type'];
						}else{
							echo "";
						}
					?>"required>
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['submit']))
							{
								$type = $_POST['type'];
                            	
								if(!preg_match('/^[A-Z][a-zA-Z -]+$/',$type))
								{
								echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid Format!</span>
                                          </div>
                                        </div>";
			
								}
							}
	 ?>
										  </div>
                                        </div>										
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Price </label>
                                          <div class="controls">
                                            <input type="number" min="1" name="price" class="span6" placeholder="Price" value="<?php
						if(isset($_POST['submit'])){
							echo $_POST['price'];
						}else{
							echo "";
						}
					?>">
                                          </div>
                                        </div>
										 <div class="control-group">
                                          <label class="control-label" for="textarea2">Description</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" name="desc" placeholder="Enter text ..." style="width: 570px; height: 200px"><?php
						if(isset($_POST['submit'])){
							echo $_POST['desc'];
						}else{
							echo "";
						}
					?></textarea>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Stock </label>
                                          <div class="controls">
                                            <input type="number" min="0" class="span6" name="stock" placeholder="Stock" value="<?php
						if(isset($_POST['submit'])){
							echo $_POST['stock'];
						}else{
							echo "";
						}
					?>">
                                          </div>
                                        </div>								
									

                                        <div class="form-actions">
                                          <button type="submit" name="submit" class="btn btn-primary">Add New Item</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
<?php
if(isset($_POST['submit']))
{
$item = $_POST['item'];
$type = $_POST['type'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$desc = $_POST['desc'];
		
		if(empty($item) || empty($type) || empty($price) || empty($desc) || empty($stock))
		{
			echo "";
		}
		
		else if(!preg_match('/^[A-Z][a-zA-Z -]+$/',$item))
		{
			echo "";
		}
		
		else if(!preg_match('/^[A-Z][a-zA-Z -]+$/',$type))
		{
			echo "";
		}
		
		else{
		$item = $_POST['item'];
		$type = $_POST['type'];
		$price = $_POST['price'];
		$stock = $_POST['stock'];
		$desc = $_POST['desc'];
		$fileName = $_FILES['photo']['name'];
		$tmpName = $_FILES['photo']['tmp_name'];
		$fileSize = $_FILES['photo']['size'];
		$fileType = $_FILES['photo']['type'];
		$filePath = $uploadDir . $fileName;
		$result = move_uploaded_file($tmpName, $filePath);
		if (!$result) {
		echo "Error uploading file";
		exit;
		}
		if(!get_magic_quotes_gpc())
		{
		$fileName = addslashes($fileName);
		$filePath = addslashes($filePath);
		}
		$no = 0;
		

		
		$query = "INSERT INTO tbl_bracelets (name,path,type,price,description,stock) 
		VALUES ('$item','$fileName','$type','$price','$desc','$stock')";
		mysql_query($query) or die(mysql_error());
		
		$select = "SELECT * FROM tbl_bracelets ORDER BY bracelets_no DESC LIMIT 0, 1";
		$result1 = mysql_query($select);
		
		while($row = mysql_fetch_array($result1))
		{
			$num = $row['bracelets_no'];
		}
		
		$item1 = "INSERT INTO tbl_item(category,id) VALUES ('bracelets','$num')";
		mysql_query($item1) or die(mysql_error());
		
		echo "<script>alert (\"New Item ($item) Successfully Added!\")</script>";
		
		}
}
?>

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