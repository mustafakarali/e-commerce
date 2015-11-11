<?php
	$count2=0;
	error_reporting(0);
?>
<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Nora's Jewelry | Payment</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>

<body>
<form method="post" action="payment.php">
<h3>Confirm  Payment</h3>
    <table width="900"  border="0">
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>&nbsp;</td>
            <td><input type="text" name="email" value="<?php
                        if(isset($_POST['btnPayment'])){
                            echo $email;
                        }else{
                            echo "";
                        }
                ?>" required/>
            </td>
            <td><?php
                            if(isset($_POST['btnPayment'])){

                                $email = $_POST['email'];
                                $query_search = "select * from tbl_members where email= '".$email."'";
                                $query_exec = mysql_query($query_search) or die(mysql_error());
                                $rows = mysql_num_rows($query_exec);
  
                                if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$email)){
                                    echo "<br> <font color=\"#FF0000\">Invalid email address</font>";
                                    $count2++;
                                }else if($rows==0){
									$check= mysql_result(mysql_query("SELECT count(*) FROM tbl_members  WHERE email='$email'"),0);
                                   if(!$check) {
								   echo "<br> <font color=\"#FF0000\">Wrong email address</font>";
                                    $count2++;
									}
                                }
                            }
                ?>
                
            </td>
        </tr>
        
        <tr>
            <td>Transaction Number:</td>
            <td>&nbsp;</td>
            <td><input type="text" name="trans" value="<?php
                        if(isset($_POST['btnPayment'])){
                            echo $trans;
                        }else{
                            echo "";
                        }
                ?>" required/></td>
            <td><?php 
                    if(isset($_POST['btnPayment'])){
                        $trans = $_POST['trans'];
                        $email = $_POST['email'];
						$check= mysql_result(mysql_query("SELECT count(*) FROM tbl_order o, tbl_members m WHERE o.payment_code='$trans' AND m.email='$email'"),0);
                         if(!$check) {
								   echo "<br> <font color=\"#FF0000\">Wrong transaction code.</font>";
                                    $count2++;
							}
						
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>Receipt Number:</td>
            <td>&nbsp;</td>
            <td><input type="text" name="rcpt" value="<?php
                        if(isset($_POST['btnPayment'])){
                            echo $rcpt;
                        }else{
                            echo "";
                        }
                ?>" required/></td>
            </td>
            <td>&nbsp;</td>
            <td>
                <?php 
                    if(isset($_POST['btnPayment'])){
                        $rcpt = $_POST['rcpt'];
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="submit" name="btnPayment" class="btn btn-success">Submit</button></td>
        </tr>
    </table>
	<br><br><br><br><br><br><br>
</form>

<?php

if(isset($_POST['btnPayment'])){
    if($count2==0){
        $email  = strtolower($_POST['email']);
        $trans  = $_POST['trans'];
        $rcpt  = $_POST['rcpt'];

        mysql_query("UPDATE tbl_order SET receipt='$rcpt', status='Paid' WHERE payment_code='$trans'") or die(mysql_error());
		$email = '';
		$trans ='';
		$rcpt = '';
		echo 'Thak you! Please wait for our email to update you about your orders.';
	}
}
?>
</body>
</html>