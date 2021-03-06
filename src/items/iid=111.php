<?php
//Author: Feiyu Shi
//Date: 11/9/2013
//Last Edited: Feiyu Shi
//Date: 11/23/2013

// display attributes of the item
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors','1');
session_start();    
$item_output = "";
// process the query
	$sqlCommand = "SELECT i.IId, i.IName, i.Category, i.Description, i.Quantity, i.IPrice, i.PromoPrice
					FROM Item i
					WHERE i.IId = 111
					;";
// connect to server
include "../connect_local.php";
$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));
include "../disconnect.php";

while($row = mysqli_fetch_array($query)){
	    $id = $row["IId"];
		$name = $row["IName"];
		$category = $row["Category"];
		$descript = $row["Description"];
		$quantity = $row["Quantity"];
		$oprice = $row["IPrice"];
		$promoprice = $row["PromoPrice"];
		$item_output .= "Item ID: $id - $name <br /> 
		Category: $category <br />
		Description: $descript <br />
		Original Price: \$ $oprice <br />";
		if(!is_null($promoprice)){
			$promoprice = number_format($promoprice, 2, '.', ',');
			$item_output.= "Sales Price: \$ $promoprice <br />";
			}
		$item_output .= "	
		Quantity: $quantity<br /><br />";
        } // close while
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
<img src="imgs/51eYy1tSgnL._SX385_.jpg" alt="lego minecraft" style="width:auto; max-height:500px;">
</div>

<div id="content" style="background-color:#FFFFFF;height:300px;width:500px;float:right;">
<?php echo $item_output ?>
</div>

<div id="quantity dropdown" style="background-color:#FFFFFF;height:20px;width:500px;float:right;">
<?php if(isset($_SESSION['email'])){
echo "<form action='../add_item_to_basket.php' method = 'post'>";
echo "<label for='iquantity'>Quantity:</label>";
echo "<select name='iquantity' id='iquantity'>";
echo  "<option value='1' selected>1</option>";
echo  "<option value='2'>2</option>";
echo  "<option value='3'>3</option>";
echo  "<option value='4'>4</option>";
echo  "<option value='5'>5</option>";
echo "</select>";

echo "<input type='hidden' name='IID' value='111'>";
echo "<input type='submit' value='Add to Basket'>";

echo "</form>";
}
?>
</div>

<div id="customer review" style="background-color:#FFFFFF;width:500px;float:right;">
<h4>Customer Review:</h4>
<?php
// connect to server
include "../connect_local.php";
$sqlpurchase = "SELECT c.Fname, p.PurchaseRating, p.Review
				FROM Customer c, Purchase p 
				WHERE c.Email = p.CEmail;";
$querypur = mysqli_query($con,$sqlpurchase) or die(mysqli_error($con));
$count = mysqli_num_rows($querypur);
$reviewresult = "<hr />";
// $totalrating = 0;/
if($count > 0){
		$i = 0;
		while($row = mysqli_fetch_array($querypur)){
			$cusfname = $row["Fname"];
	        $rating[$i] = $row["PurchaseRating"];
	        $review = $row["Review"];
	        $reviewresult .= "$cusfname says:<br /> $review <br />rating: $rating[$i]<br /><hr />";
// 	        $totalrating = $totalrating + $rating[]
	        $i++;
            } // close while
		} else {
			echo "No one purchased this item.";	
		}
$averagerating = array_sum($rating) / count($rating);
$averagerating = number_format($averagerating, 2, '.', ',');
echo "Average Rating: ". $averagerating."<br />";
echo $reviewresult;
include "../disconnect.php";
?>
</div>


</div>

</BODY>
</HTML>