<?php
//Author: Feiyu Shi
//Date: 11/9/2013
//Last Edited: Feiyu Shi
//Date: 11/25/2013

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
    if(isset($_SESSION['email'])) {
        $basketEmail = $_SESSION['email'];
//         echo $basketEmail;
    }
    
?>

<HTML>
<HEAD>
<TITLE> Customer Basket </TITLE>
<!-- <META HTTP-EQUIV="refresh" CONTENT="15"> -->
</HEAD>
<BODY>

<div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
    
<div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
</div>

<div id="searchBox" style="background-color:#FFFFFF;clear:both;text-align:left;">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
Search <input name="searchquery" type="text" size = "60" maxlength = "80">
<input name = "myBtn" type = "submit" value = "GO!">
</form>
<?php include "search.php"; ?>
</div>

<div id="basket logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
<H3> Your Shopping Basket </H3>
</div>

<div id="basket result" style="background-color:#FFFFFF;clear:both;text-align:left;">


<?php

// connect to server
include "connect_local.php";
//check inventory,print out of stock info
if(isset($_POST['quantity'])&& $_POST['quantity']!=""&&$_POST['quantity']>0&&is_numeric($_POST['quantity'])){
	$updatedquan = mysqli_real_escape_string($con,$_POST['quantity']);
	$selectedid = mysqli_real_escape_string($con,$_POST['IID']);
	$sqlinvent = "SELECT Quantity
					FROM Item
					WHERE IId = $selectedid";
	$queryinvent = mysqli_query($con,$sqlinvent) or die(mysqli_error($con));
	while($row = mysqli_fetch_array($queryinvent)){
		$invent = $row['Quantity'];
	}
	if ($updatedquan>$invent)
	{
		echo "<hr/>"."<font color='red'>Out of Stock.</font>"."<br/>";
	}
}
// check if the quantity is updated
if(isset($_POST['quantity'])&& $_POST['quantity']!=""&&$_POST['quantity']>0&&$_POST['quantity']<=$invent&&is_numeric($_POST['quantity'])){
	$updatedquan = mysqli_real_escape_string($con,$_POST['quantity']);
	$selectedid = mysqli_real_escape_string($con,$_POST['IID']);
	$sqlupdate = "UPDATE BasketContains
					SET BQuantity = $updatedquan
					WHERE IId = $selectedid";
	$updatequery = mysqli_query($con,$sqlupdate) or die(mysqli_error($con));	
	}
// if the new quantity is 0, delete this item
if(isset($_POST['quantity'])&& $_POST['quantity']!=""&&$_POST['quantity']==0&&is_numeric($_POST['quantity'])){
	$selectedid = mysqli_real_escape_string($con,$_POST['IID']);
	$sqldelete = "DELETE FROM BasketContains
					WHERE IId=$selectedid;";
	$deletequery = mysqli_query($con,$sqldelete) or die(mysqli_error($con));		
	}
// delete this item
if(isset($_POST['remove'])){
	$selectedid = mysqli_real_escape_string($con,$_POST['IID']);
	$sqldelete = "DELETE FROM BasketContains
					WHERE IId=$selectedid;";
	$deletequery = mysqli_query($con,$sqldelete) or die(mysqli_error($con));	
	}

	
// process the query
$sqlCommand = "SELECT DISTINCT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate, i.PromoPrice
				FROM Customer c, Basket b, BasketContains bc, Item i
				WHERE b.CEmail = '$basketEmail' AND b.CEmail = bc.CEmail AND b.BasketId = bc.BaskId
						AND bc.IId = i.IId;";

$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));
$count = mysqli_num_rows($query);


if($count > 0){
		echo "<table border=1>";
		echo ("<tr><td>Item</td>");
		echo ("<td>Unit Price</td>");
		echo ("<td>Discount Price</td>");
		echo ("<td>Quantity</td>");
		echo ("<td>Update Quantity</td>");
		echo ("<td>Remove?</td></tr>");
		$subtotal = 0;
		while($row = mysqli_fetch_array($query)){
		$iid = $row["IId"];
// 		$shopdate = $row["ShopDate"];
		$itemName = $row["IName"];
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
// 		echo ("<td>$quantity</td>");
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
		<?php echo "<td><input type='text' name=quantity value = $quantity size = '5'> </td>" ?>
		<?php echo "<input type ='hidden' name=IID value = $iid>";?>
		<td><input type="submit" value="update"></td>
		</form>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
		<td>
		<?php echo "<input type ='hidden' name=IID value = $iid>";?>
		<input type="submit" name = "remove" value="remove">
		</td></tr>
		</form>
		<?php
        } // close while
        echo "<tr><th colspan=6>Subtotal: \$ $subtotal</th></tr>";
        echo "</table>";
        ?>
    	<div id ="order_button" style ="background-color:#FFFFFF; clear:both; text-align: left;">
        <form action = "review_order.php" method ="POST">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
            <input type ="submit" value ="Place Order" name="basketOrderBtn" >
        </form>
    </div>
    <?php
	} else {
		echo "<table>";
		echo "<tr><td>Your basket is empty.</td></tr>";	
		echo "</table>";
}
include "disconnect.php";
?>

</div>

</BODY>
</HTML>