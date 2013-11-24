<?php
//Author: Libby Ferland
//Date: 11/16/2013
//Last Edit: Libby Ferland
//Edit Date:11/20/2013


error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
    if(isset($_SESSION['email'])) {
        $placerEmail = $_SESSION['email'];
    }
    else {
        echo "There are bigger problems <br>";
    }
    
    if(isset($_POST["orderReviewedBtn"])) {
        if (isset($_POST["address_choice"])) {
            
            $orderAddr = $_POST["address_choice"];
            $myAdd = explode(',', $orderAddr);
            
        }
        else {
            echo ("Error processing order: You must select a shipping address.<br>");
        }
        
        if (isset($_POST["bill_choice"])) {
            $orderBill = $_POST["bill_choice"];
            $myPay = explode(',', $orderBill);
        }
        else {
            echo("Error processing order: You must select a payment method. <br>");
        }
    }
    
    //break up arrays - display information to customer after table insertion successful
   if (isset($myAdd) && isset($myPay)) {
    $shipAddrOne = $myAdd[1];
    $shipAddrTwo = $myAdd[2];
    $shipAddrCity = $myAdd[3];
    $shipAddrState = $myAdd[4];
    $shipAddrZip = $myAdd[5];
    $shipAddrIn = $myAdd[6];
    
    //purchase  needs to contain payment method and shipping address
    $payNum = $myPay[1];
    $payExpy = $myPay[2];
    $payFirstName = $myPay[3];
    $payLastName = $myPay[4];
    $payAddrOne = $myPay[5];
    $payAddrTwo = $myPay[6];
    $payCity = $myPay[7];
    $payState = $myPay[8];
    $payZip = $myPay[9];
    $payAddrIn = $myPay[10];
    
    if (isset($_POST["method"])) {
        $sMethod = $_POST["method"];
    }
    else {
        echo "Could not find a shipping method. <br>";
    }
  
    
    //queries
    include "connect_local.php";
    $orderConts = "SELECT DISTINCT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate
					FROM Customer c, Basket b, BasketContains bc, Item i
					WHERE b.CEmail = '$placerEmail' AND b.CEmail = bc.CEmail AND b.BasketId = bc.BaskId
							AND bc.IId = i.IId;";
    //create order first - need to find last order id so the ids remain unique
    $find_last_id = "SELECT MAX(POrderID) AS LastOrder FROM Orders;";
    $lastOrder = mysqli_query($con,$find_last_id);
    while ($row = $lastOrder->fetch_row()) {
        $lastID = $row[0];
    }
    $newID = $lastID + 1;
    $create_new_order = "INSERT INTO Orders(POrderID, Status) VALUES ('$newID', 'Pending');";
    $create_new_purchase = "INSERT INTO Purchase(CEmail, InvoiceNo, PurchaseDate, PurchaseRating, Review) VALUES ('$placerEmail', '$newID', NOW(), '4', 'It was OK');";
    $create_new_shipped_to = "INSERT INTO ShippedTo(OrderID, CEmail, AddrIndex) VALUES('$newID', '$placerEmail', '$shipAddrIn');";
    $create_new_paid_with = "INSERT INTO PaidWith(OrderID, CEmail, CardNo) VALUES('$newID', '$placerEmail', '$payNum');";
    $create_new_ShippedBy = "INSERT INTO ShippedBy(OrderID, ShipMethod) VALUES ('$newID', '$sMethod');";
    
    
    
    mysqli_query($con, $create_new_order);
    mysqli_query($con, $create_new_purchase);
    mysqli_query($con, $create_new_shipped_to);
    mysqli_query($con, $create_new_paid_with);
    mysqli_query($con, $create_new_ShippedBy);
    $orderContents = mysqli_query($con, $orderConts);
    
    $itemids = array();
    $itemqs = array();
    $idin = 0;
    while ($irow = mysqli_fetch_array($orderContents)) {
        $itemids[$idin] = $irow["IId"];
        $itemqs[$idin] = $irow["BQuantity"];
        $idin++;
    }
    
    for($j = 0; $j < ($idin); $j++) {
        $create_new_order_contains = "INSERT INTO OrderContains(COrderID, IId, OQuantity) VALUES ('$newID', '$itemids[$j]', '$itemqs[$j]');";
        mysqli_query($con, $create_new_order_contains);
    }
    
    include "disconnect.php";
    $goHere = "order_confirmation.php?myONum=$newID";
    Header('Location:' .$goHere);
   }
   else {
       echo "Error processing order.  Please review your information and try again. <br>";
   }
    //make orderID autoincrementing
    
    ?>