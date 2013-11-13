<?php
//Author: Feiyu Shi
//Date: 11/9/2013
//Last Edited: Feiyu Shi
//Date: 11/12/2013

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
    if(isset($_SESSION['email'])) {
        $basketEmail = $_SESSION['email'];
        echo $basketEmail;
    }
    
// search function
include "search.php";
?>

<HTML>
<HEAD>
<TITLE> CS 405G Project </TITLE>
<!-- <META HTTP-EQUIV="refresh" CONTENT="15"> -->
</HEAD>
<BODY>

<div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
</div>

<div id="searchBox" style="background-color:#FFFFFF;clear:both;text-align:left;">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
Search <input name="searchquery" type="text" size = "60" maxlength = "80">
<input name = "myBtn" type = "submit" value = "GO!">
</form>
</div>

<div id="search result" style="background-color:#FFFFFF;clear:both;text-align:left;">
<?php echo $search_output;
//output results in text?>
</div>

<div id="basket logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
<H3> Your Shopping Basket </H3>
</div>

<div id="basket result" style="background-color:#FFFFFF;clear:both;text-align:left;">

<table border="1">
<?php
// display what's in the basket

// $basket_output = "";
// process the query
	$sqlCommand = "SELECT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate
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
		echo ("<tr><td>Item</td>");
		echo ("<td>Unit Price</td>");
		echo ("<td>Quantity</td>");
		echo ("<td> </td></tr>");
		
		while($row = mysqli_fetch_array($query)){
		$itemName = $row["IName"];
		$iid = $row["IId"];
		echo ("<tr><td><a href=items/iid=$iid.php>$itemName</a></td>");
		echo ("<td>\$ $row[IPrice]</td>");
		echo ("<td>$row[BQuantity]</td>");
		echo ("<td><a href=\"edit_basket.php?id=$row[BQuantity]\">Edit Quantity</a></td></tr>");
// 	            $id = $row["IId"];
// 		    	$name = $row["IName"];
// 		    	$price = $row["IPrice"];
// 		    	$quantity = $row["BQuantity"];
// 		    	$shopdate = $row["ShopDate"];
// 		    	$basket_output .= "Item ID: $id - $name <br /> 
// 		    	Unit Price: \$ $price <br />
// 		    	Quantity: $quantity <br />
// 		    	Shoping Date: $shopdate <br /><br />";
                } // close while
	} else {
		echo "<tr><td>Your basket is empty.</td></tr>";	
}
?>
</table>

</div>

</BODY>
</HTML>