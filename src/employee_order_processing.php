<?php
//Author: Feiyu Shi
//Date: 11/19/2013
//Last Edit: Feiyu Shi
//Edit Date: 11/22/2013
 session_start();
if(isset($_SESSION['empID'])) {
        $processEID = $_SESSION['empID'];
    }
?>

<HTML>
    <HEAD>
    <TITLE> Order Processing </TITLE>
<!--     <meta http-equiv="refresh" content="60">  -->
    </HEAD>
    <div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="employee_home.php">Employee Home</a>
        <a href ="employee_logout.php">Logout</a>
    </div>
	<br />
	<br />
	<div>
	<h2>Pending Orders</h2>
	<p>as of<?php  $today = date_create("",timezone_open("America/New_York")); echo " ".date_format($today,"Y-m-d H:i:s");?> </p>
    <hr />
    <?php
    // connect to server
	include "connect_local.php";
	
	// display all pending orders
	$sqlpending = "SELECT o.POrderID, p.PurchaseDate, ab.AddrLine1, ab.AddrLine2,ab.City,ab.State,ab.Zip, sb.ShipMethod
					FROM Orders o, Purchase p, ShippedTo st, AddressBook ab, ShippedBy sb
					WHERE o.POrderID = p.InvoiceNo AND o.Status = 'Pending' AND st.OrderID = o.POrderID AND st.CEmail = ab.CEmail
							AND st.SAddr1 = ab.AddrLine1 AND st.City = ab.City AND st.State = ab.State AND sb.OrderID = o.POrderID
					ORDER BY p.PurchaseDate;";
	$query = mysqli_query($con,$sqlpending) or die(mysqli_error($con));
	$count = mysqli_num_rows($query);
// 	echo $count;
if($count > 0){

	while($row = mysqli_fetch_array($query)){
		echo "<table border=1>";
		echo "<tr><td>Invoice No.</td>";
		echo "<td>Purchase Date</td>";
		echo "<td>Shipping Address</td>";
		echo "<td>Shipping Method</td></tr>";
		$invoiceno = $row["POrderID"];
		$purchasedate = $row["PurchaseDate"];
		$ln1 = $row["AddrLine1"];
		$ln2 = $row['AddrLine2'];
		$city = $row['City'];
		$state = $row['State'];
		$zip = $row['Zip'];
		$method = $row['ShipMethod'];
		$subtotal = 0;
		echo "<tr><td>$invoiceno</td>";
		echo "<td>$purchasedate</td>";
		echo "<td>$ln1"."<br>$ln2"."<br>$city"."<br>$state  $zip</td>";
		echo "<td>$method</td></tr>";
		// process items in this order
		$sqlitem = "SELECT i.IId, i.IName, i.IPrice, oc.OQuantity, i.PromoPrice
					FROM OrderContains oc, Item i
					WHERE oc.COrderID = $invoiceno AND oc.IId = i.IId;";
		$query2 = mysqli_query($con,$sqlitem) or die(mysqli_error($con));
		
		echo "<tr><td colspan='2'>Item</td>";
		echo "<td>Price</td>";
		echo "<td>Quantity</td></tr>";
		while($row = mysqli_fetch_array($query2)){
	        	$id = $row["IId"];
	            $oquantity = $row["OQuantity"];
	            $name = $row["IName"];
		    	if(is_null($row["PromoPrice"])){
					$price = $row["IPrice"];}
				else{
					$price = $row["PromoPrice"];
				}
				$price = number_format($price, 2, '.', ',');
		    	$subtotal = $subtotal;
				//check inventory of this item
				$sqlitems = "SELECT Quantity
							FROM Item
							WHERE IId = $id";
				$query3 = mysqli_query($con,$sqlitems) or die(mysqli_error($con));
				while($row = mysqli_fetch_array($query3)){
					$invent = $row['Quantity'];
					}
				if ($oquantity > $invent){
					$shortage = 1;
					echo "<tr><td colspan=4>WARNING: Please Stock Item ID = $id!</td></tr>";
				}else{
					$shortage = 0;
					$subtotal = $subtotal + $price * $oquantity;
					echo ("<tr><td colspan='2'>$name</td>");
					echo ("<td>\$ $price</td>");
					echo ("<td>$oquantity</td></tr>");
					
					if(isset($_SESSION['empID'])&&isset($_POST['OrderID'])&&isset($_POST['Shipped'])&&isset($_POST['Shortage'])&&$_POST['Shortage']==0){
						//update inventory
						$sqlinvent = "UPDATE Item
										SET Quantity = $invent - $oquantity
										WHERE IId = $id";
						$update2 = mysqli_query($con,$sqlinvent) or die(mysqli_error($con));
					}
				}
        } // close while 
        echo "<tr><td colspan=4>Subtotal: \$ $subtotal</td></tr>";?>
          
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
        <?php echo "<input type ='hidden' name=OrderID value = $invoiceno>";?>
        <?php echo "<input type ='hidden' name=Shortage value = $shortage>";?>
        <?php echo "<tr><th colspan=4><input type='submit' name='Shipped' value='Ship Order'></th></tr>";?>
		</form>      		
        <?php
		echo "</table>";
        echo "<br />";	
		}
}else {
		echo "<table>";
		echo "<tr><td>No Pending Orders.</td></tr>";	
		echo "</table>";}
		
		if(isset($_SESSION['empID'])&&isset($_POST['OrderID'])&&isset($_POST['Shipped'])&&isset($_POST['Shortage'])&&$_POST['Shortage']==0){
			$orderid = $_POST['OrderID'];
			//update order status
			$sqlstatus = "UPDATE Orders
							SET Status = 'Shipped'
							WHERE POrderID = $orderid;";
			$update = mysqli_query($con,$sqlstatus) or die(mysqli_error($con));
			
			// update ship table and timestamp it
			$sqlship = "INSERT INTO Ship(EId, OrderID, ShipDate)
						VALUES ('$processEID', '$orderid', TIMESTAMP(NOW()));";
			$insert = mysqli_query($con,$sqlship) or die(mysqli_error($con));
			echo "<hr/>"."Shiped!";
		}
	include "disconnect.php";
	echo "<hr />";
    ?>
</HTML>