<?php
//Author: Libby Ferland
//Date: 11/16/2013
//Last Edit:
//Edit Date:


error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
    if(isset($_SESSION['email'])) {
        $placerEmail = $_SESSION['email'];
        echo ("I found it <br>");
        echo $placerEmail;
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
   
    $shipAddrOne = $myAdd[1];
    $shipAddrTwo = $myAdd[2];
    $shipAddrCity = $myAdd[3];
    $shipAddrState = $myAdd[4];
    $shipAddrZip = $myAdd[5];
    
    //purchase  needs to contain payment method and shipping address
    $payNum = $myPay[1];
    $payExpy = $myPay[2];
    $payFirstName = $myPay[3];
    $payLastName = $myPay[4];
    $payAddrOne = $myPay[5];
    $payCity = $myPay[6];
    $payState = $myPay[7];
  
    //queries
    $orderConts = "SELECT DISTINCT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate
					FROM Customer c, Basket b, BasketContains bc, Item i
					WHERE b.CEmail = '$placerEmail' AND b.CEmail = bc.CEmail AND b.BasketId = bc.BaskId
							AND bc.IId = i.IId;";
    //create order first
    $create_new_order = "INSERT INTO Orders(POrderID, Status) VALUES ('314159', 'Pending');";
    $create_new_purchase = "INSERT INTO Purchase(CEmail, InvoiceNo, PurchaseDate, PurchaseRating, Review) VALUES ('$placerEmail', '314159', '2013-11-19 13:36:24', '4' 'It was OK');";
    $create_new_shipped_to = "INSERT INTO ShippedTo(OrderID, CEmail, SAddr1, City, State) VALUES('314159', '$placerEmail', '$shipAddrOne', '$shipAddrCity', '$shipAddrState');";
    
    include "connect_local.php";
    
    mysqli_query($con, $create_new_order);
    mysqli_query($con, $create_new_purchase);
    mysqli_query($con, $create_new_shipped_to);
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
        $create_new_order_contains = "INSERT INTO OrderContains(COrderID, IId, OQuantity) VALUES ('314159', '$itemids[$j]', '$itemqs[$j]');";
        mysqli_query($con, $create_new_order_contains);
    }
    
    include "disconnect.php";
    
    echo "Order placed!";
    //make orderID autoincrementing
    
    ?>