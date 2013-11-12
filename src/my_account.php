<?php

//Author: Libby Ferland
//Date: 11/11/2013
//Last Edit:
//Edit Date:


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
    
    
 ?>
<HTML>
    <TITLE> My Account </TITLE>
    <div id="account_header" style="background-color:#FFFFFF;clear:both;text-align:center;">
        <b style="font-size:50px">Welcome back, <?php echo $custFirst ?>! </b>    
    </div>
    <div id ="navigation" style ="background-color: #FFFFFF; clear:both;height:200px;width:300px;float:left">
        <b>Manage My Account</b><br>
        <a href ="customer_order_history.php">My Orders</a><br>
        <a href ="#payment">My Payment Info</a><br>
        <a href ="#address">My Address</a><br>
        <a href ="customer_basket.php">My Basket</a><br>
    </div>
    <div id ="orders" class ="toggle" style="display:none">
        <?php include "customer_orders.php" ?>
    </div>
    <div id ="payment" class ="toggle" style="display:none">
        <?php include "customer_payement.php" ?>
    </div>
    <div id ="address" class="toggle" style="display:none">
        <?php include "customer_address.php"?>
    </div>
</HTML>


    