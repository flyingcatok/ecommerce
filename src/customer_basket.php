<?php
//Author: Feiyu Shi
//Date: 11/9/2013
//Last Edited: 
//Date:

error_reporting(E_ALL);
ini_set('display_errors', '1');
$basket_output = "";
// process the query
	$sqlCommand = "SELECT i.IId, i.IName, i.IPrice, bc. BQuantity, b.ShopDate
					FROM Customer c, Basket b, BasketContains bc, Item i
					WHERE c.Email = b.CEmail AND b.CEmail = bc.CEmail AND b.BasketId = bc.BaskId
							AND bc.IId = i.IId;";
// connect to server
include_once "connect_local.php";
$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));
include_once "disconnect.php";
$count = mysqli_num_rows($query);
if($count >= 1){
		$basket_output .= "<hr />$count items in your basket.<hr />";
		while($row = mysqli_fetch_array($query)){
	            $id = $row["IId"];
		    	$name = $row["IName"];
		    	$price = $row["IPrice"];
		    	$quantity = $row["BQuantity"];
		    	$shopdate = $row["ShopDate"];
		    	$basket_output .= "Item ID: $id - $name <br /> 
		    	Unit Price: \$ $price <br />
		    	Quantity: $quantity <br />
		    	Shoping Date: $shopdate <br /><br />";
                } // close while
	} else {
		$basket_output = "<hr />Your basket is empty.<hr />";		
}

?>

<HTML>
<HEAD>
<TITLE> CS 405G Project </TITLE>
</HEAD>
<BODY>

<div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
<H2> F&L Gift Store </H2>
</div>

<div id="basket logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
<H3> Your Shopping Basket </H3>
</div>

<div id="basket result" style="background-color:#FFFFFF;clear:both;text-align:left;">
<?php echo $basket_output;
//output results in text?>
</div>

</BODY>
</HTML>