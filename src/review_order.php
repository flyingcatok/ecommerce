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
        
        $findContents = "SELECT DISTINCT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate, i.PromoPrice
					FROM Customer c, Basket b, BasketContains bc, Item i
					WHERE b.CEmail = '$reviewerEmail' AND b.CEmail = bc.CEmail AND b.BasketId = bc.BaskId
							AND bc.IId = i.IId;";
        $findOAddress = "SELECT AddrIndex, AddrLine1, AddrLine2, City, State, Zip FROM AddressBook WHERE CEmail = '$reviewerEmail' AND IsVisible = 1";
        $findOPay = "SELECT p.CardNo, p.CHolderLastName, p.CHolderFirstName, p.CExpirDate, a.AddrLine1, a.AddrLine2, a.City, a.State, a.Zip, b.AddrIndex
                 FROM PaymentMethods p, AddressBook a, BillingAddress b WHERE p.CEmail = '$reviewerEmail' AND p.CardNo = b.CardNo AND p.IsVisible = 1 AND b.AddrIndex = a.AddrIndex;";
        
        include "connect_local.php";
        $getContents = mysqli_query($con, $findContents);
        $getOAddress = mysqli_query($con, $findOAddress);
        $getOPay = mysqli_query($con, $findOPay);
        
        include "disconnect.php";
        
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
        <H1>Review Your Order Information</H1>
        <div id ="contents" style ="background-color:#FFFFFF; clear:both; text-align:left">
            <H3>Your Order</H3>
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
        
        <form action ="place_order.php" method="POST">
        <div id ="shippingaddr" style ="background-color:#FFFFFF; clear:both; text-align:left">
            <H3> Select Shipping Address </H3>
            <?php
            $addresses = array();
            $i = 0;
            while( $arow = mysqli_fetch_array($getOAddress)) {
                $addresses[$i] = $arow;
                $i++;
            }
            $addrin = 1;
            $buttonin = 0;
            for ($j = 0; $j < ($i + 1); $j++) {
                if (isset($addresses[$j])) {
                ?>
            
               <!-- <input type = "hidden" name = "<?php $addrin ?>" value = "<?php $addresses[$j]?>" > -->
                <?php
                echo ("<table border = \"0\">");
                $addrInShip = $addresses[$j]["AddrIndex"];
                $lineOne = $addresses[$j]["AddrLine1"];
                $lineTwo = $addresses[$j]["AddrLine2"];
                $aCity = $addresses[$j]["City"];
                $aState = $addresses[$j]["State"];
                $aZip = $addresses[$j]["Zip"];
                echo ("Street Address: $lineOne<br>");
                echo ("Apartment/Suite Number: $lineTwo<br>");
                echo ("City: $aCity<br>");
                echo ("State: $aState<br>");
                echo ("Zip: $aZip<br>");
                echo ("</table>");
                echo("<br>");
                $addrin++;
                $thisAdd = array("a",$lineOne, $lineTwo, $aCity, $aState, $aZip, $addrInShip);
                $addSelect = implode(',', $thisAdd);
                ?>
                <input type="radio" name = "address_choice" value = "<?php echo $addSelect; ?>">Select this address<br> <br>
                <?php
                $buttonin++;
                }
            }
            
            /*$addrIndex = 1;
            $buttonIndex = 1;
            while($arow = mysqli_fetch_array($getOAddress)) { 
                ?>
                <input type="hidden" name="<?php $addrIndex ?>" value ="
<?php
                echo("Address $addrIndex");
                echo "<table border = \"0\">";
                $lineOne = $arow["AddrLine1"];
                $lineTwo = $arow["AddrLine2"];
                $aCity = $arow["City"];
                $aState = $arow["State"];
                $aZip = $arow["Zip"];
                echo ("$lineOne<br>");
                echo ("$lineTwo<br>");
                echo ("$aCity<br>");
                echo ("$aState<br>");
                echo ("$aZip<br>");
                echo("</table>");
                echo("<br>");
                $addrIndex++;
                ?> 
                "/>
                <input type ="radio" name =">Select<br>
                
                <?php $buttonIndex++;
               }
           ?> */
            ?>
                
        </div>
        <div id ="cards" style ="background-color:#FFFFFF; clear:both; text-align:left">
            <H3>Select Payment Method</H3>
            <?php
            $bills = array();
            $k = 0;
            while($brow = mysqli_fetch_array($getOPay)) {
                $bills[$k] = $brow;
                $k++;
            }
            
            $billerin = 1;
            $billbuttin = 0;
            for ($m = 0; $m < ($k + 1); $m++) {
                if (isset($bills[$m])) {
                    ?>
           <!-- <input type ="hidden" name ="<?php $billerin ?>" value="<?php $bills[$m] ?>" >  -->
            <?php 
            echo "<br>";
            echo ("<table border = \"0\">");
            $cardn = $bills[$m]["CardNo"];
            $cardLast = $bills[$m]["CHolderLastName"];
            $cardFirst = $bills[$m]["CHolderFirstName"];
            $expydate = $bills[$m]["CExpirDate"];
            $billLineOne = $bills[$m]["AddrLine1"];
            $billLineTwo = $bills[$m]["AddrLine2"];
            $bCity = $bills[$m]["City"];
            $bState = $bills[$m]["State"];
            $bZip = $bills[$m]["Zip"];
            $addrInBill = $bills[$m]["AddrIndex"];
            $cardn2 = "...-**" . substr($cardn, -4, 4);
            echo("Card Number: $cardn2<br>");
            echo("Expiration date: $expydate<br>");
            echo("Card Holder: $cardFirst ");
            echo("$cardLast<br>");
            echo("<br>");
            echo("Billing Address: <br> $billLineOne<br>");
            echo("$billLineTwo <br>");
            echo("Billing City:$bCity<br>");
            echo("Billing State: $bState<br>");
            echo ("Billing Zip: $bZip<br>");
            echo("</table>");
            echo("<br>");
            $billerin++;
            $thisCard = array("b", $cardn, $expydate, $cardFirst, $cardLast, $billLineOne, $billLineTwo, $bCity, $bState, $bZip, $addrInBill);
            $cardSelect = implode(',', $thisCard);
            ?>
            <input type="radio" name="bill_choice" value ="<?php echo $cardSelect ?>" > Select this method <br>
          
           <?php 
           $billbuttin++;   }
            }
            
            
           ?>
            <br> <br><br>
                <input type ="submit" value ="Order Now" name="orderReviewedBtn">
        </div>
            
            
    </BODY>
</HTML>