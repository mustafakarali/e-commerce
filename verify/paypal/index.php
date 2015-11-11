<html>
<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("input[name=checkout]").click();
    });
</script>
</head>
<body>
Redirecting to  PayPal...
<?php
include("../../include/dbcon.php");
session_start();

$first = $_SESSION['first'];
$last = $_SESSION['last'];
$item_quantity = $_SESSION['q'];
$l = $_SESSION['hoax'];

?> 
<form class="paypal" action="payments.php" method="post" id="paypal_form" target="_parent">    
	<input type="hidden" name="cmd" value="_xclick" /> 
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="lc" value="PHP" />
    <input type="hidden" name="currency_code" value="PHP" />
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
    <input type="hidden" name="first_name" value="<?php echo $first ?>"  />
    <input type="hidden" name="last_name" value="<?php echo $last ?>"  />
    <input type="hidden" name="payer_email" value="customer@example.com"  />
    <input type="hidden" name="item_number" value="<?php echo $item_quantity ?>" / >
    <input type="submit" id="submit" name="checkout" value="Continue"  style="visibility: hidden;" />
</form>
</body>
</html>

