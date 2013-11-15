<?php
//Author: Feiyu Shi
//Date: 11/9/2013
//Last Edited: Feiyu Shi
//Date: 11/15/2013

// display attributes of the item
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors','1');
  
$item_output = "";
// process the query
$sqlCommand = "SELECT i.IId, i.IName, i.Category, i.Description, i.Quantity, i.IPrice
				FROM Item i
				WHERE i.IId = 201
				;";
				
// connect to server
include "../connect_local.php";
$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));

while($row = mysqli_fetch_array($query)){
	    $id = $row["IId"];
		$name = $row["IName"];
		$category = $row["Category"];
		$descript = $row["Description"];
		$quantity = $row["Quantity"];
		$price = $row["IPrice"];
		$item_output .= "Item ID: $id - $name <br /> 
		Category: $category <br />
		Description: $descript <br />
		Unit Price: \$ $price <br />
		Quantity: $quantity<br /><br />";
        } // close while

include "../disconnect.php";
?>


<HTML>
<HEAD>
<TITLE> CS 405G Project </TITLE>
</HEAD>
<BODY>

<div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
<H2> <a href="../main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
</div>

<br /><br />

<div id="container" style="width:1000px">

<div id="item pic" style="background-color:#FFFFFF;height:500px;width:500px;float:left;">
<img src="imgs/8125h60acML._SL1200_.jpg" alt="call of duty" style="width:auto; max-height:500px;">
</div>

<div id="content" style="background-color:#FFFFFF;height:300px;width:500px;float:right;">
<?php echo $item_output ?>
</div>

<div id="quantity dropdown" style="background-color:#FFFFFF;height:200px;width:500px;float:right;">
<form action="../add_item_to_basket.php" method = "post">
<label for="iquantity">Quantity:</label>
<select name="iquantity" id="iquantity">
  <option value="1" selected>1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>
<input type="hidden" name="IID" value="201">
<input type="submit" value="Add to Basket">
</form>
</div>

</div>

</BODY>
</HTML>