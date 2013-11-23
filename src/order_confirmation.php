<?php
//Author: Libby Ferland
//Date: 11/20/2013
//Last Edit:
//Edit Date:

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
if(isset($_SESSION['email'])) {
    $confEmail = $_SESSION['email'];
    echo $confEmail;
}
else {
    echo "There are bigger problems <br>";
}

if(isset($_GET["myONum"])) {
    $confONum = $_GET["myONum"];
}
else {
    echo "Could not find an order ID <br>";
}

//query new tables to echo info back to user
$findMyName = "SELECT Lname, Fname FROM Customer WHERE Email = '$confEmail'";
$findNewContents = "SELECT c.IId, c.OQuantity, i.IName FROM OrderContains c, Item i WHERE c.COrderID = '$confONum' AND c.IId = i.IId;";
$findWhereSent = "SELECT AddrIndex FROM ShippedTo WHERE OrderID = '$confONum' AND CEmail = '$confEmail'; ";
$findHowPaid = "SELECT p.CardNo, m.CExpirDate FROM PaidWith p, PaymentMethods m WHERE p.OrderID = '$confONum' AND p.CEmail = '$confEmail' AND p.CardNo = m.CardNo;";
$returnBasket = "TRUNCATE TABLE BasketContains;";

include "connect_local.php";

$myName = mysqli_query($con, $findMyName);
$newContents = mysqli_query($con, $findNewContents);
$whereSent = mysqli_query($con, $findWhereSent);
$howPaid = mysqli_query($con, $findHowPaid);
$emptyBasket = mysqli_query($con, $returnBasket); //This truncate command empties the basket after the order is confirmed as processed

$aIndex = $whereSent->fetch_row();

$getSAddr = "SELECT * FROM AddressBook WHERE AddrIndex = '$aIndex[0]';";
$shippedHere = mysqli_query($con, $getSAddr);

include "disconnect.php";

?>

<HTML>
	<div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
    <div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
	<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
	</div>
    <HEAD><TITLE>Thank you for your order!</TITLE></HEAD>
    
    
    <H3>Your order number is <?php echo $confONum ?>.  Please retain this number for your records.</H3>
    <br><br>
    <div id="order-info" style ="background-color:#FFFFFF; clear:both; text-align:left " >
        <b>Your Order</b><br><br>
    Order number: <?php echo $confONum ?> <br>
    <br>
    <?php
    while ($nrow = mysqli_fetch_array($myName)) {
        $oLName = $nrow["Lname"];
        $oFName = $nrow["Fname"];
    }
    echo ("Shipped to:<br> <b> $oFName  $oLName</b> <br><br>");
    
    $qrow = $shippedHere->fetch_row();
        $sentLineOne = $qrow[2];
        $sentLineTwo = $qrow[3];
        $sentCity = $qrow[4];
        $sentState = $qrow[5];
        $sentZip = $qrow[6];
    
    echo ("$sentLineOne <br>");
    echo("$sentLineTwo <br>");
    echo ("$sentCity <br>");
    echo ("$sentState <br>");
    echo ("$sentZip <br>");
    
    echo("<br><br>");
    
    echo ("Payment Method <br>");
    
    while ($prow = mysqli_fetch_array($howPaid)) {
        $pCard = $prow["CardNo"];
        $pExp = $prow["CExpirDate"];
    }
    $pCard2 = "...-**" . substr($pCard, -4, 4);
    echo("Card number $pCard2 <br>");
    echo("Expiration date $pExp <br>");
    
    echo("<br><br>");
    
    echo("Order Contents <br>");
    
    while ($orow = mysqli_fetch_array($newContents)) {
        $itemNum = $orow["IId"];
        $itemQuant = $orow["OQuantity"];
        $itemName = $orow["IName"];
        
        echo("Item ID: $itemNum");
        echo(" Name: $itemName");
        echo(" Quantity: $itemQuant <br>");
    }
    ?>
    </div>
    <br>
    Your order is pending!
    
</HTML>
    
    
