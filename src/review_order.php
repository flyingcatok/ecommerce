<?php
//Author: Libby Ferland
//Date: 11/16/2013
//Last Edited: Feiyu Shi
//Date: 11/24/2013

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
    if(isset($_SESSION['email'])) {
        $reviewerEmail = $_SESSION['email'];
//         echo $reviewerEmail;
        
        $findContents = "SELECT DISTINCT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate, i.PromoPrice
					FROM Customer c, Basket b, BasketContains bc, Item i
					WHERE b.CEmail = '$reviewerEmail' AND b.CEmail = bc.CEmail AND b.BasketId = bc.BaskId
							AND bc.IId = i.IId;";
        $findOAddress = "SELECT AddrIndex, AddrLine1, AddrLine2, City, State, Zip FROM AddressBook WHERE CEmail = '$reviewerEmail' AND IsVisible = 1";
        $findOPay = "SELECT p.CardNo, p.CHolderLastName, p.CHolderFirstName, p.CExpirDate, a.AddrLine1, a.AddrLine2, a.City, a.State, a.Zip, b.AddrIndex
                 FROM PaymentMethods p, AddressBook a, BillingAddress b WHERE p.CEmail = '$reviewerEmail' AND p.CardNo = b.CardNo AND p.IsVisible = 1 AND b.AddrIndex = a.AddrIndex;";
        $findShipInfo = "SELECT ShipMethod, ShipRate FROM ShipPrice";
        
        include "connect_local.php";
        $getContents = mysqli_query($con, $findContents);
        $getOAddress = mysqli_query($con, $findOAddress);
        $getOPay = mysqli_query($con, $findOPay);
        $getShipInfo = mysqli_query($con, $findShipInfo);
        
        include "disconnect.php";
        
        $methods = array();
        $prices = array();
        $pIndex = 0;
        
        while ($hrow = mysqli_fetch_array($getShipInfo)) {
            $methods[$pIndex] = $hrow["ShipMethod"];
            $prices[$pIndex] = $hrow["ShipRate"];
            $pIndex++;
        }
       
    }

    
    ?>

<HTML>
    <HEAD> <TITLE> Review Your Order Information </TITLE></HEAD>
    <div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
    <div id="header" style="background-color:#FFFFFF;clear:both;text-align:left;">
	<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a></H2>
	</div>
    <BODY>
        <H3>Review Your Order Information</H3>
        <div id ="contents" style ="background-color:#FFFFFF; clear:both; text-align:left">
            <H4>Your Order</H4>
            <table border="1">
                <?php
		echo ("<tr><td>Item</td>");
		echo ("<td>Unit Price</td>");
		echo ("<td>Discount Price</td>");
		echo ("<td>Quantity</td></tr>");
		$subtotal = 0;
		while($row = mysqli_fetch_array($getContents)){
// 		$shopdate = $row["ShopDate"];
		$itemName = $row["IName"];
		$iid = $row["IId"];
		$quantity = $row["BQuantity"];
		$oprice = $row["IPrice"];
	 	$promoprice = $row["PromoPrice"];
		if(is_null($promoprice)){
			$promo = 0;
			$subtotal = $subtotal + $oprice * $quantity;
			$subtotal = number_format($subtotal, 2, '.', ',');
			}else{
			$promo = 1;
			$subtotal = $subtotal + $promoprice * $quantity;
			$subtotal = number_format($subtotal, 2, '.', ',');
			}
		$promoprice = number_format($promoprice, 2, '.', ',');
		echo ("<tr><td><a href=items/iid=$iid.php>$itemName</a></td>");
		echo ("<td>\$ $oprice</td>");
		if ($promo==1){
		echo "<td>\$ $promoprice</td>";
		}elseif ($promo==0){
		echo "<td></td>";
		}
		echo ("<td>$row[BQuantity]</td></tr>");
        } // close while
        echo "<tr><th colspan=5>Subtotal: \$ $subtotal</th></tr>";
        
        ?>
            </table>
            <br><br><br>

        </div>
        <H3> Select Shipping Method </H3>
        <form action="confirm_shipping.php" method ="POST">
            <select name="shipmethod">
            <option value="default">Select a shipping method</option>
            <option value="overnight">One Day Overnight - $20</option>
            <option value ="twoday">Two Day Express - $10</option>
            <option value="reg">Standard Ground - $5</option>
            </select>
            <input type="submit" value="Update Order">
        </form>

    </BODY>
</HTML>