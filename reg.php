<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Nora's Jewelry | Register</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
<script language=JavaScript>
function reload(form)
{
    var val=form.cat.options[form.cat.options.selectedIndex].value;
    var first_name=form.fname.value; 
    var last_name=form.lname.value; 
    var email=form.email.value; 
    var address=form.address.value; 
    var contact=form.contact.value; 
    self.location='register.php?cat=' + val + '&f=' + first_name + '&l=' + last_name + '&e=' + email + '&a=' + address + '&c=' + contact;
}
function reload3(form)
{
    var val=form.cat.options[form.cat.options.selectedIndex].value; 
    var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 
    var first_name=form.fname.value; 
    var last_name=form.lname.value; 
    var email=form.email.value; 
    var address=form.address.value; 
    var contact=form.contact.value; 
    self.location='register.php?cat=' + val + '&cat3=' + val2  + '&f=' + first_name + '&l=' + last_name + '&e=' + email + '&a=' + address + '&c=' + contact;
}
</script>
</head>

<body>
<?php
    error_reporting(0);
    require "include/config.php"; 
    $count=0;

    $quer2=mysql_query("SELECT DISTINCT category,cat_id FROM category order by category"); 

    $cat=$_GET['cat'];
    if(isset($cat) and strlen($cat) > 0){
        $quer=mysql_query("SELECT DISTINCT subcategory,subcat_id FROM subcategory where cat_id=$cat order by subcategory"); 

    }else{
        $quer=mysql_query("SELECT DISTINCT subcategory,subcat_id FROM subcategory cat_id=$cat order by subcategory");
         } 

    $cat3=$_GET['cat3']; 
    if(isset($cat3) and strlen($cat3) > 0){
        $quer3=mysql_query("SELECT DISTINCT subcat2 FROM subcategory2 where subcat_id=$cat3 and cat_id=$cat order by subcat2"); 
    }else{
        $quer3=mysql_query("SELECT DISTINCT subcat2 FROM subcategory2 where cat_id=$cat order by subcat2"); 
    } 
?>

<form method="post" name="f1" action="register.php">
<h3>Register an Account</h3>
    <table width="900"  border="0">
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>First Name:</td>
            <td>&nbsp;</td>
            <td><input type="text" name="fname" value="<?php
                        if(isset($_POST['submit'])){
                            echo $_POST['fname'];
                        }else if(isset($_REQUEST['cat'])){ 
                            echo $_REQUEST['f'];
                        }else{
                            echo "";
                        }
                ?>" required
                />
            </td>
            <td>    <?php
                            if(isset($_POST['submit'])){
                                $first = $_POST['fname'];
                                
                                if(!preg_match('/^[A-Za-z\s]+$/',$first)){
                                    echo "<script>alert (\"Cannot Contain Numbers or Special Characters!!\")</script>";
                                    $count++;
                                }
                            }
                    ?>
            </td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td>&nbsp;</td>
            <td><input type="text" name="lname" value="<?php
                        if(isset($_POST['submit'])){
                            echo $_POST['lname'];
                        }else if(isset($_REQUEST['cat'])){ 
                            echo $_REQUEST['l'];
                        }else{
                            echo "";
                        }
                    ?>" required/>
            </td>
            <td> <?php
                            if(isset($_POST['submit'])){
                                $last = $_POST['lname'];
                                
                               if(!preg_match('/^[A-Za-z\s]+$/',$last)){
                                    echo "<script>alert (\"Cannot Contain Numbers or Special Characters!!\")</script>";
                                    $count++;

                                }
                            }
                ?>
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>&nbsp;</td>
            <td><input type="text" name="email" value="<?php
                        if(isset($_POST['submit'])){
                            echo $_POST['email'];
                        }else if(isset($_REQUEST['cat'])){ 
                            echo $_REQUEST['e'];
                        }else{
                            echo "";
                        }
                ?>" required/>
            </td>
            <td><?php
                            if(isset($_POST['submit'])){

                                $email = $_POST['email'];
                                $query_search = "select * from tbl_members where email= '".$email."'";
                                $query_exec = mysql_query($query_search) or die(mysql_error());
                                $rows = mysql_num_rows($query_exec);
  
                                if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$email)){
                                    echo "<script>alert (\"Invalid Email Address!!\")</script>";
                                }else if($rows!=0){
                                    echo "<script>alert (\"Email Address is already taken!!\")</script>";
                                }
                            }
                ?>
                
            </td>
        </tr>
        
        <tr>
            <td>Billing Address:</td>
            <td>&nbsp;</td>
            <td><input type="text" name="address" value="<?php
                        if(isset($_POST['submit'])){
                            echo $_POST['address'];
                        }else if(isset($_REQUEST['cat'])){ 
                            echo $_REQUEST['a'];
                        }else{
                            echo "";
                        }
                ?>" required/></td>
            <td><?php 
                    if(isset($_POST['submit'])){
                        $address = $_POST['address'];
                            
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>Country:</td>
            <td>&nbsp;</td>
            <td><?php 
                echo "<select name='cat' onchange=\"reload(this.form)\"><option value=''>Select country</option>";
                while($noticia2 = mysql_fetch_array($quer2)) { 
                    if($noticia2['cat_id']==@$cat){echo "<option selected value='$noticia2[cat_id]'>$noticia2[category]</option>"."<BR>";
                    }else{
                        echo  "<option value='$noticia2[cat_id]'>$noticia2[category]</option>";
                    }
                }
                echo "</select>";
                ?>
            </td>
            <td>&nbsp;</td>
            <td>
                <?php 
                    if(isset($_POST['submit'])){
                        $address = $_POST['cat'];
                            if($address == null){
                                    echo "<script>alert (\"Required Field!!\")</script>";
                                    $count++;
                            }
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>Region/State:</td>
            <td>&nbsp;</td>
            <td><?php 
                echo "<select name='subcat' onchange=\"reload3(this.form)\"><option value=''>Select region/state</option>";
                while($noticia = mysql_fetch_array($quer)) { 
                    if($noticia['subcat_id']==@$cat3){
                        echo "<option selected value='$noticia[subcategory]'>$noticia[subcategory]</option>"."<BR>";
                    }else{
                        echo  "<option value='$noticia[subcat_id]'>$noticia[subcategory]</option>";
                    }
                }      
                echo "</select>";
                ?>
            </td>
            <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
         <tr>
            <td>City:</td>
            <td>&nbsp;</td>
            <td><?php 
                echo "<select name='subcat3' ><option value=''>Select city</option>";
                while($noticia = mysql_fetch_array($quer3)) { 
                    echo  "<option value='$noticia[subcat2]'>$noticia[subcat2]</option>";
                }
                echo "</select>";
                ?>
            </td>
            <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Mobile No: (For Philippines Only)</td>
            <td>&nbsp;</td>
            <td><input name="contact" type="text" value="<?php
                        if(isset($_POST['submit'])){
                            echo $_POST['contact'];
                        }else if(isset($_REQUEST['cat'])){ 
                            echo $_REQUEST['c'];
                        }else{
                            echo "";
                        }
                ?>"/></td>
            <td><?php
                        if(isset($_POST['submit'])){
                             $contact = $_POST['contact'];
                             $contact_length = strlen($contact);
                                
                                if($contact_length!=11 || !preg_match('/^[0-9\s]+$/',$contact) && $_POST['cat']==172){
                                    echo "<script>alert (\"Please provide a valid contact number!!\")</script>";
                                    $count++;
                                }
                        }
                ?>   
            </td>
        </td>&nbsp;</td>
        <tr>
            <td>Password:</td>
            <td>&nbsp;</td>
            <td><input type="password" name="pass1" value="" required/></td>
            <td><?php 
                    if(isset($_POST['submit'])){
                        $pword = $_POST['pass1'];
                            if(!preg_match("/^[0-9a-zA-Z_]{6,}$/", $pword)){
                                    echo "<script>alert (\"At least 6 characters!!\")</script>"; 
                                    $count++;
                            }
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>Confirm Password:</td>
            <td>&nbsp;</td>
            <td><input type="password" name="pass2" value="" required/></td>
            <td><?php 
                    if(isset($_POST['submit'])){
                        $pass1 = $_POST['pass1'];
                        $pass2 = $_POST['pass2'];
                        
                        if ($pass1 != $pass2){
                                    echo "<script>alert (\"Mismatch Password!!\")</script>"; 
                        }
                    }
                ?>      
            </td>
        </tr>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>By signing up, you agree to our <a href="#myTerms" data-toggle="modal">terms of use and conditions</a>.</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="submit" name="submit" class="btn btn-success">Register</button></td>
        </tr>
    </table>
</form>

<?php

if(isset($_POST['submit'])){
    if($count==0){

        $fname  = stripslashes(strip_tags(ucwords(strtolower($_POST['fname']))));
        $lname  = stripslashes(strip_tags(ucwords(strtolower($_POST['lname']))));
        $pass   = md5($_POST['pass1']);
        $add    = stripslashes(strip_tags($_POST['address']));
        $country= $_POST['cat'];
        $region = $_POST['subcat'];
        $city   = $_POST['subcat3'];
        $contact= '+63'.ltrim ($_POST['contact'],'0');
        $email  = strtolower($_POST['email']);
        $activation = md5(uniqid(rand(), true));

        $query=mysql_query("SELECT category FROM category WHERE cat_id='".$country."'");

        while($row = mysql_fetch_array($query)) { 
                    $country = $row['category'];
        } 

        $query=mysql_query("SELECT subcategory FROM subcategory WHERE subcat_id='".$region."'"); 

        while($row = mysql_fetch_array($query)) { 
                    $region = $row['subcategory'];
        } 

        $myQuery = mysql_query("INSERT INTO tbl_members(first_name, last_name, password, address, country, region, city, contact, email, activation_key, status) VALUES('$fname', '$lname', '$pass', '$add', '$country', '$region', '$city', '$contact', '$email', '$activation', 0)") or die(mysql_error());
            
        $to = $email;

        $subject = "Nora's Jewelry Account : Confirm registration ";

        $headers = "From: Nora's Jewelry\n";
        $headers .= "Reply-To: $email \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body>';
        $message .= 'Hi <b>'.ucfirst($fname).'!</b><br> Click the link below to activate your account<br><br>';
        $message .= "<a href=\"http://www.jetextsteeldetailers.com/ilike/tago/verify/verify_account.php?email=".$email."&key=".$activation."\">Activate Account </a>";
        $message .= "</body></html>";

        mail($to, $subject, $message, $headers);   
    }
}
?>
</body>
</html>