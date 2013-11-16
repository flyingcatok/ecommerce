<?php
//Author: Libby Ferland
//Date: 11/16/2013
//Last Edited: 
//Date: 

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
    if(isset($_SESSION['email'])) {
        $reviewerEmail = $_SESSION['email'];
        echo $reviewerEmail;
        
        $findContents = "SELECT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate
					FROM Customer c, Basket b, BasketContains bc, Item i
					WHERE b.CEmail = '$reviewerEmail' AND b.CEmail = bc.CEmail AND b.BasketId = bc.BaskId
							AND bc.IId = i.IId;";
        $findOAddress = "SELECT AddrLine1, AddrLine2, City, State, Zip FROM AddressBook WHERE CEmail = '$reviewerEmail'";
        $findOPay = "SELECT p.CardNo, p.CHolderLastName, p.CHolderFirstName, p.CExpirDate, b.Baddr1, b.BCity, b.BState
                 FROM PaymentMethods p, BillingAddress b WHERE p.CEmail = '$reviewerEmail' AND p.CardNo = b.CardNo";
        
        include "connect_local.php";
        $getContents = mysqli_query($con, $findContents);
        $getOAddress = mysqli_query($con, $findOAddress);
        $getOPay = mysqli_query($con, $findOPay);
        
        include "disconnect.php";
  
    }
    
    ?>

<HTML>
    <HEAD> <TITLE> Review Your Order Information </TITLE></HEAD>
    <BODY>
        <H1>Review Your Order Information</H1>
        <div id ="contents" style ="background-color:#FFFFFF; clear:both; text-align:left">
            <H3>Your Order</H3>
            <table border="1">
                <?php
		echo ("<tr><td>Item</td>");
		echo ("<td>Unit Price</td>");
		echo ("<td>Quantity</td>");
		$subtotal = 0;
		while($row = mysqli_fetch_array($getContents)){
// 	    $id = $row["IId"];
// 		$shopdate = $row["ShopDate"];
		$itemName = $row["IName"];
		$iid = $row["IId"];
		$price = $row["IPrice"];
		$quantity = $row["BQuantity"];
		$subtotal = $subtotal + $price * $quantity;
		echo ("<tr><td><a href=items/iid=$iid.php>$itemName</a></td>");
		echo ("<td>\$ $row[IPrice]</td>");
		echo ("<td>$row[BQuantity]</td>");
        } // close while
        echo "<tr><th colspan=5>Subtotal: \$ $subtotal</th></tr>";
        ?>
                
            </table>
            <br><br><br>
        </div>
        
        <div id ="shippingaddr" style ="background-color:#FFFFFF; clear:both; text-align:left">
            <H3> Select Shipping Address </H3>
            <?php
            $addrIndex = 1;
            while($arow = mysqli_fetch_array($getOAddress)) {
                echo("Address $addrIndex");
                echo "<table border = \"0\">";
                $lineOne = $arow["AddrLine1"];
                $lineTwo = $arow["AddrLine2"];
                $aCity = $arow["City"];
                $aState = $arow["State"];
                $aZip = $arow["Zip"];
                echo ("<tr><td>$lineOne</td>/<tr>");
                echo ("<tr><td>$lineTwo</td></tr>");
                echo ("<tr><td>$aCity</tr></td>");
                echo ("<tr><td>$aState</tr></td>");
                echo ("<tr><td>$aZip</tr></td>");
                echo("</table>");
                echo("<br><br>");
                $addrIndex++;
            }
           ?>
        </div>
        <div id ="cards" style ="background-color:#FFFFFF; clear:both; text-align:left">
            <H3>Select Payment Method</H3>
            <?php
            while($crow = mysqli_fetch_array($getOPay)) {
                echo "<table border = \"0\">";
                $cardNo = $crow["CardNo"];
                $cardLName = $crow["CHolderLastName"];
                $cardFName = $crow["CHolderFirstName"];
                $expDate = $crow["CExpirDate"];
                $addOne = $crow["Baddr1"];
                $bCity = $crow["BCity"];
                $bState = $crow["BState"];
                echo ("<tr><td>$cardNo</td>/<tr>");
                echo ("<tr><td>$cardFName . $cardLName </td>/<tr>");
                echo ("<tr><td>$expDate</td>/<tr>");
                echo ("<tr><td>$addOne</td>/<tr>");
                echo ("<tr><td>$bCity</td>/<tr>");
                echo ("<tr><td>$bState</td>/<tr>");
                echo("</table>");
                echo("<br><br>");
            }
            ?>
        </div>
        
        <div id ="place-order" style ="background-color:#FFFFFF;clear:both;text-align:left">
            <form action ="place_order.php" method ="POST">
                <input type ="submit" value ="Order Now" name="orderReviewedBtn">
            </form>
        </div>
            
            
    </BODY>
</HTML>