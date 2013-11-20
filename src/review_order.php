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
        
        $findContents = "SELECT DISTINCT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate
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
                Address <?php $addrin ?> <br>
                <?php
                echo ("<table border = \"0\">");
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
                $thisAdd = array("a",$lineOne, $lineTwo, $aCity, $aState, $aZip);
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
            Payment method <?php $billerin ?><br>
            <?php 
            echo ("<table border = \"0\">");
            $cardn = $bills[$m]["CardNo"];
            $cardLast = $bills[$m]["CHolderLastName"];
            $cardFirst = $bills[$m]["CHolderFirstName"];
            $expydate = $bills[$m]["CExpirDate"];
            $billLineOne = $bills[$m]["Baddr1"];
            $bCity = $bills[$m]["BCity"];
            $bState = $bills[$m]["BState"];
            echo("Card Number: $cardn<br>");
            echo("Expiration date: $expydate<br>");
            echo("Card Holder: $cardFirst ");
            echo("$cardLast<br>");
            echo("Billing Address: $billLineOne<br>");
            echo("Billing City:$bCity<br>");
            echo("Billing State: $bState<br>");
            echo("</table>");
            echo("<br>");
            $billerin++;
            $thisCard = array("b", $cardn, $expydate, $cardFirst, $cardLast, $billLineOne, $bCity, $bState);
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