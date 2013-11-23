<?php
//Author: Feiyu Shi
//Date: 11/9/2013
//Last Edited: Feiyu Shi
//Date: 11/23/2013

// display what's in the order table
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
    if(isset($_SESSION['email'])) {
        $historicEmail = $_SESSION['email'];
//         echo $historicEmail;
    }
?>

<HTML>
<HEAD>
<TITLE> Order History </TITLE>
</HEAD>
<BODY>

<div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
<div id="logo" style="font-color:#FFF234;clear:both;text-align:left;">
<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
</div>

<div id="searchBox" style="background-color:#FFFFFF;clear:both;text-align:left;">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
Search <input name="searchquery" type="text" size = "60" maxlength = "80">
<input name = "myBtn" type = "submit" value = "GO!">
</form>
<?php include "search.php";?>
</div>

<div id="order logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
<H3> Your Order History </H3>

<?php
// connect to server
include_once "connect_local.php";
// process the query
$sqlCommand0 = "SELECT p.InvoiceNo, o.Status, p.PurchaseDate
					FROM Customer c, Purchase p, Orders o
					WHERE c.Email = '$historicEmail' AND c.Email = p.CEmail AND p.InvoiceNo = o.POrderID
					ORDER BY p.PurchaseDate;";
							
	
$query0 = mysqli_query($con,$sqlCommand0) or die(mysqli_error($con));

$count = mysqli_num_rows($query0);
echo $count;
if($count > 0){

		while($row = mysqli_fetch_array($query0)){
				echo "<table border=1>";
				$invoiceno = $row["InvoiceNo"];
				$status = $row["Status"];
				$purchasedate = $row["PurchaseDate"];
// 				$shipdate = $row["ShipDate"];
				$subtotal = 0;
				if($status =='Pending'){
					echo ("<tr><td colspan=3>Invoice No: $invoiceno</td></tr>");
					echo ("<td colspan=3>Purchase Date: $purchasedate</td></tr>");
					echo ("<td colspan=3>Status: $status</td></tr>");
					}elseif($status == "Shipped"){
					$sqlshipdate = "SELECT ShipDate
									FROM Ship
									WHERE OrderID = $invoiceno";
					$date = mysqli_query($con,$sqlshipdate) or die(mysqli_error($con));
					$row2 = mysqli_fetch_array($date);
					$shipdate = $row2["ShipDate"];
					echo ("<tr><td colspan=3>Invoice No: $invoiceno</td></tr>");
					echo ("<td colspan=3>Purchase Date: $purchasedate</td></tr>");
					echo ("<td colspan=3>Status: $status</td></tr>");
					echo "<td colspan=3>Shipping Date: $shipdate</td></tr>";
					}
				// query items in this order
				$sqlCommand = "SELECT i.IId, i.IName, i.IPrice, oc.OQuantity, i.PromoPrice 
					FROM  OrderContains oc, Item i
					WHERE oc.COrderID = $invoiceno AND oc.IId = i.IId;";

				$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));
				echo "<tr><td colspan=3></td></tr>";
				echo "<tr><td>Item</td>";
				echo "<td>Price</td>";
				echo "<td>Quantity</td></tr>";
				while($row = mysqli_fetch_array($query)){
	            		$id = $row["IId"];
		    			$name = $row["IName"];
		    			if(is_null($row["PromoPrice"])){
							$price = $row["IPrice"];}
						else{
							$price = $row["PromoPrice"];
						}
						$price = number_format($price, 2, '.', ',');
		    			$quantity = $row["OQuantity"];
						echo ("<tr><td><a href=items/iid=$id.php>$name</a></td>");
						echo ("<td>\$ $price</td>");
						echo ("<td>$quantity</td></tr>");
						$subtotal = $subtotal + $price * $quantity;
                		} // close while
				echo "<tr><th colspan=3>Subtotal: \$ $subtotal</th></tr>";
                echo "</table>";
                echo "<br />";
				}
		

	} else {
		echo "<table>";
		echo "<tr><td>You didn't purchase anything.</td></tr>";	
		echo "</table>";
}
include_once "disconnect.php";
?>

</div>

</BODY>
</HTML>