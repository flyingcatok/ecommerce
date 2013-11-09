<?php
//Author: Feiyu Shi
//Date: 11/9/2013
//Last Edited: 
//Date:

error_reporting(E_ALL);
ini_set('display_errors', '1');
$order_output = "";
// process the query
	$sqlCommand = "SELECT p.InvoiceNo, o.Status, p.PurchaseDate, i.IId, i.IName, i.IPrice, oc. OQuantity 
					FROM Customer c, Purchase p, Orders o, OrderContains oc, Item i
					WHERE c.Email = p.CEmail AND p.InvoiceNo = o.POrderID AND o.POrderID = oc.COrderID
							AND oc.IId = i.IId;";
// connect to server
include_once "connect_local.php";
$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));
include_once "disconnect.php";
$count = mysqli_num_rows($query);
if($count >= 1){
		$order_output .= "<hr />You have $count previous orders.<hr />";
		while($row = mysqli_fetch_array($query)){
				$invoiceno = $row["InvoiceNo"];
				$status = $row["Status"];
				$purchasedate = $row["PurchaseDate"];
	            $id = $row["IId"];
		    	$name = $row["IName"];
		    	$price = $row["IPrice"];
		    	$quantity = $row["OQuantity"];
		    	$order_output .= "Invoice No.: $invoiceno <br />
		    		Shipping Status: $status <br />
		    		Purchase Date: $purchasedate <br />
		    		Item ID: $id - $name <br /> 
		    		Unit Price: \$ $price <br />
		    		Quantity: $quantity<br /><br />";
                } // close while
	} else {
		$order_output = "<hr />Your didn't order anything.<hr />";		
}

?>

<HTML>
<HEAD>
<TITLE> CS 405G Project </TITLE>
</HEAD>
<BODY>

<div id="logo" style="font-color:#FFF234;clear:both;text-align:left;">
<H2> F&L Gift Store </H2>
</div>

<div id="order logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
<H3> Your Order History </H3>
</div>

<div id="order result" style="background-color:#FFFFFF;clear:both;text-align:left;">
<?php echo $order_output;
//output results in text, may display link
?>
</div>

</BODY>
</HTML>