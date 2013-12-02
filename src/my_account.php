<?php

//Author: Libby Ferland
//Date: 11/11/2013
//Last Edit: Feiyu Shi 
//Edit Date: 12/1/2013


    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
    session_start();
    
    //find customer ID (email) from login info
    if(isset($_SESSION['email'])) {
        $custEmail = $_SESSION['email'];
    }
    else {
        echo "too bad";
    }
 
    $addExists = "yes";
    $payExists = "yes";
    include "connect_local.php";
    
    //query tables to find customer information
    $findAccount = "SELECT * FROM Customer WHERE Email = '$custEmail'";
    $hasAddress = "SELECT COUNT(*) FROM AddressBook WHERE CEmail = '$custEmail';";
    $hasPayment = "SELECT COUNT(*) FROM PaymentMethods WHERE CEmail = '$custEmail' AND IsVisible = 1;";
    
    
    $getAccountInfo = mysqli_query($con, $findAccount);
    $getAddInfo = mysqli_query($con, $hasAddress);
    $getPayInfo = mysqli_query($con, $hasPayment);
    
    $accountResult = $getAccountInfo->fetch_row();
    
    $custLast = $accountResult[2];
    $custFirst = $accountResult[3];
    //$vipStatus = $accountResult[4];
    
    $numAdds = $getAddInfo->fetch_row();
    if ($numAdds[0] == 0) {
        $addExists = "no";
    }
    
    $numPays = $getPayInfo->fetch_row();
    if ($numPays[0] == 0) {
        $payExists = "no";
    }

   include "disconnect.php";
    
 ?>
<HTML>
    <TITLE> My Account </TITLE>
    <div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>

	<div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
	<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
	</div>

    <div id="account_header" style="background-color:#FFFFFF;clear:both;text-align:left;">
        <h3>Welcome back, <?php echo $custFirst ?>! </h3> 
        <?php 
        if($addExists == "no" && $payExists == "no") { ?>
        You haven't saved any addresses or payment information yet.
        <form action="new_address.php">
            <input type ="submit" value="Add a new shipping address">
        </form>
        <form action ="new_payment_method.php">
            <input type="submit" value="Add a new payment method">
        </form>
    </div>
        <div id ="no-navigation" style ="background-color: #FFFFFF; clear:both;height:300px;width:300px;float:left">
        <b>Manage My Account</b><br>
        <a href ="customer_order_history.php">My Orders</a><br>
        <a href ="main.php">Go Shopping!</a><br><br>
        </div>
  
    <?php } 
        else if ($addExists == "no" && $payExists=="yes") { ?>
        You haven't saved any addresses yet.  
        <form action="new_address.php">
            <input type ="submit" value="Add a new shipping address">
        </form>
    </div>
        <div id ="pay-navigation" style ="background-color: #FFFFFF; clear:both;height:300px;width:300px;float:left">
        <b>Manage My Account</b><br>
        <a href ="my_payment.php">My Payment Info</a><br>
        <a href ="customer_order_history.php">My Orders</a><br>
        <a href ="main.php">Go Shopping!</a><br><br>
 		</div>
    <?php }
        else if ($addExists == "yes" && $payExists=="no") { ?>
        You haven't saved any payment methods yet.
        <form action ="new_payment_method.php">
            <input type="submit" value="Add a new payment method">
        </form>
    </div>
        <div id ="add-navigation" style ="background-color: #FFFFFF; clear:both;height:300px;width:300px;float:left">
        <b>Manage My Account</b><br>
        <a href ="my_address.php">My Address</a><br> 
        <a href ="customer_order_history.php">My Orders</a><br>
        <a href ="main.php">Go Shopping!</a><br><br>
		</div>
        
        <?php }else if ($addExists == "yes" && $payExists=="yes"){?>
    </div>
        <div id ="no-navigation" style ="background-color: #FFFFFF; clear:both;height:300px;width:300px;float:left">
        <b>Manage My Account</b><br>
        <a href ="my_address.php">My Address</a><br> 
        <a href ="my_payment.php">My Payment Info</a><br>
        <a href ="customer_order_history.php">My Orders</a><br>
        <a href ="main.php">Go Shopping!</a><br><br>
        </div>
        
       <?php } ?>
    
</HTML>


    