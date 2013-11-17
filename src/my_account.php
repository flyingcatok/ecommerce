<?php

//Author: Libby Ferland
//Date: 11/11/2013
//Last Edit: Feiyu Shi 
//Edit Date: 11/16/2013


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
 
    
    include "connect_local.php";
    
    //query tables to find customer information
    $findAccount = "SELECT * FROM Customer WHERE Email = '$custEmail'";
    
    $getAccountInfo = mysqli_query($con, $findAccount);
    
    $accountResult = $getAccountInfo->fetch_row();
    
    $custLast = $accountResult[2];
    $custFirst = $accountResult[3];
    $vipStatus = $accountResult[4];
    
    
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
    </div>
    <div id ="navigation" style ="background-color: #FFFFFF; clear:both;height:300px;width:300px;float:left">
        <b>Manage My Account</b><br>
        <a href ="customer_order_history.php">My Orders</a><br>
        <a href ="#payment">My Payment Info</a><br>
        <a href ="#address">My Address</a><br>
<!--         <a href ="customer_basket.php">My Basket</a><br> -->
        <a href ="main.php">Go Shopping!</a><br><br>
        <b>VIP</b><br>
    <?php
        if ($vipStatus == 1) {
    ?>
        <a href="vip_home.php">My Store</a><br>
    <?php       }
        ?>
    </div>
    
<!-- 
    <div id="logoff" style="background-color:#FFFFFF; clear:both;text-align:left">
        <a href ="customer_logout.php">Logout</a>
    </div>
 -->
    
</HTML>


    