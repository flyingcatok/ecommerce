<?php
//Author: Feiyu Shi
//Date: 11/9/2013
//Last Edited: Feiyu Shi
//Date: 11/15/2013

// display what's in the order table
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
    if(isset($_SESSION['email'])) {
        $historicEmail = $_SESSION['email'];
        echo $historicEmail;
    }
?>

<HTML>
<HEAD>
<TITLE> Order History </TITLE>
</HEAD>
<BODY>

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
if($count > 0){
		
		while($row = mysqli_fetch_array($query0)){
				echo "<table border=1>";
				echo ("<tr><td>Invoice No</td>");
				echo ("<td>Status</td>");
				echo ("<td>Purchase Date</td></tr>");
				$invoiceno = $row["InvoiceNo"];
				$status = $row["Status"];
				$purchasedate = $row["PurchaseDate"];
				$subtotal = 0;
				echo ("<tr><td>$invoiceno</td>");
				echo ("<td>$status</td>");
				echo ("<td>$purchasedate</td></tr>");
				// query items in this order
				$sqlCommand = "SELECT i.IId, i.IName, i.IPrice, oc. OQuantity, i.PromoPrice 
					FROM  OrderContains oc, Item i
					WHERE oc.COrderID = $invoiceno AND oc.IId = i.IId;";

				$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));

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