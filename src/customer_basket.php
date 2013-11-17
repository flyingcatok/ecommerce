<?php
//Author: Feiyu Shi
//Date: 11/9/2013
//Last Edited: Feiyu Shi
//Date: 11/16/2013

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
    if(isset($_SESSION['email'])) {
        $basketEmail = $_SESSION['email'];
        echo $basketEmail;
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

<!-- <table border="1"> -->
<?php
// display what's in the basket

// $basket_output = "";
// process the query
	$sqlCommand = "SELECT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate, i.PromoPrice
					FROM Customer c, Basket b, BasketContains bc, Item i
					WHERE b.CEmail = '$basketEmail' AND b.CEmail = bc.CEmail AND b.BasketId = bc.BaskId
							AND bc.IId = i.IId;";
// connect to server
include "connect_local.php";
$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));
$count = mysqli_num_rows($query);
include "disconnect.php";
// echo "<hr />$count items in your basket.<hr />";

if($count > 0){
		echo "<table border=1>";
		echo ("<tr><td>Item</td>");
		echo ("<td>Unit Price</td>");
		echo ("<td>Quantity</td>");
		echo ("<td> </td>");
		echo ("<td> </td></tr>");
		$subtotal = 0;
		while($row = mysqli_fetch_array($query)){
// 	    $id = $row["IId"];
// 		$shopdate = $row["ShopDate"];
		$itemName = $row["IName"];
		$iid = $row["IId"];
	// 	$price = $row["IPrice"];
		if(is_null($row["PromoPrice"])){
			$price = $row["IPrice"];}
			else{
			$price = $row["PromoPrice"];
			}
		$quantity = $row["BQuantity"];
		$subtotal = $subtotal + $price * $quantity;
		echo ("<tr><td><a href=items/iid=$iid.php>$itemName</a></td>");
		echo ("<td>\$ $price</td>");
		echo ("<td>$quantity</td>");
		echo ("<td><a href=\"edit_basket.php?id=$row[BQuantity]\">Edit</a></td>");
		echo ("<td><a href=\"delete_item_from_basket.php?id=$row[IId]\">Delete</a></td></tr>");
        } // close while
        echo "<tr><th colspan=5>Subtotal: \$ $subtotal</th></tr>";
        echo "</table>";
        ?>
<!--     </table> -->
    <div id ="order_button" style ="background-color:#FFFFFF; clear:both; height:200px;width:450; text-align: right;">
        <form action = "review_order.php" method ="POST">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
            <input type ="submit" value ="Place Order" name="basketOrderBtn" >
        </form>
    </div>
    <?php
	} else {
		echo "<table>";
		echo "<tr><td>Your basket is empty.</td></tr>";	
		echo "</table>";
}
?>

</div>

</BODY>
</HTML>