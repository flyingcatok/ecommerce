<?php
//Author: Feiyu Shi
//Date: 11/16/2013
//Last Edited: 
//Date:

error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');

    // connect to server
include "connect_local.php";
$today = date('Y-m-d');

$last7days = date("Y/m/d", mktime(0,0,0,date("m"),date("d")-7,date("Y")));
$last30days = date("Y/m/d",mktime(0,0,0,date("m")-1,date("d"),date("Y")));
$lastyear = date("Y/m/d",mktime(0,0,0,date("m"),date("d"),date("Y")-1));

// process the search query
if(isset($_POST['Today'])){

$sqltoday = "SELECT i.IId, i.IName, sales.total, (i.IPrice*sales.total) AS subtotal
			FROM (SELECT oc.IId, sum(oc.OQuantity) AS total
					FROM Purchase p, Orders o, OrderContains oc
					WHERE PurchaseDate = $today AND p.InvoiceNo = o.POrderID AND o.POrderID = oc.COrderID
					GROUP BY oc.IId) AS sales, Item i
			WHERE sales.IId = i.IId";
$querytoday = mysqli_query($con,$sqltoday) or die(mysqli_error($con));
$count = mysqli_num_rows($querytoday);
if($count > 0){
		echo "<table border=1 width=500>";
		echo "<tr><td>IID</td>";
		echo "<td>Item</td>";
		echo "<td>Quantity Sold</td>";
		echo "<td>Subtotal</td></tr>";
		$revenue = 0;
		while($row = mysqli_fetch_array($querytoday)){
	        $id = $row["IId"];
	        $name = $row["IName"];
		    $quantity = $row["total"];
		    $subtotal = $row["subtotal"];
		    $subtotal = number_format($subtotal, 2, '.', ',');
		    $revenue = $revenue + $subtotal;
		    echo ("<tr><td>$id</td>");
			echo ("<td>$name</td>");
			echo ("<td>$quantity</td>");
			echo ("<td>\$ $subtotal</td></tr>");
            } // close while
            echo "<tr><th colspan=4>Revenue: \$ $revenue</th></tr>";
        echo "</table>";
		} else {
			echo "<table>";
			echo "<tr><td>No item was sold today.</td></tr>";	
			echo "</table>";
		}

}

elseif(isset($_POST['LastWeek'])){

$sqlweek = "SELECT i.IId, i.IName, sales.total, (i.IPrice*sales.total) AS subtotal
			FROM (SELECT oc.IId, sum(oc.OQuantity) AS total
					FROM Purchase p, Orders o, OrderContains oc
					WHERE PurchaseDate >= $last7days AND p.InvoiceNo = o.POrderID AND o.POrderID = oc.COrderID
					GROUP BY oc.IId) AS sales, Item i
			WHERE sales.IId = i.IId";
$queryweek = mysqli_query($con,$sqlweek) or die(mysqli_error($con));
$count = mysqli_num_rows($queryweek);
if($count > 0){
		echo "<table border=1 width=500>";
		echo "<tr><td>IID</td>";
		echo "<td>Item</td>";
		echo "<td>Quantity Sold</td>";
		echo "<td>Subtotal</td></tr>";
		$revenue = 0;
		while($row = mysqli_fetch_array($queryweek)){
	        $id = $row["IId"];
	        $name = $row["IName"];
		    $quantity = $row["total"];
		    $subtotal = $row["subtotal"];
		    $subtotal = number_format($subtotal, 2, '.', ',');
		    $revenue = $revenue + $subtotal;
		    echo ("<tr><td>$id</td>");
			echo ("<td>$name</td>");
			echo ("<td>$quantity</td>");
			echo ("<td>\$ $subtotal</td></tr>");
            } // close while
            echo "<tr><th colspan=4>Revenue: \$ $revenue</th></tr>";
        echo "</table>";
		} else {
			echo "<table>";
			echo "<tr><td>No item was sold in the last 7 days.</td></tr>";	
			echo "</table>";
		}
		
}

elseif(isset($_POST['LastMonth'])){

$sqlmonth = "SELECT i.IId, i.IName, sales.total, (i.IPrice*sales.total) AS subtotal
			FROM (SELECT oc.IId, sum(oc.OQuantity) AS total
					FROM Purchase p, Orders o, OrderContains oc
					WHERE PurchaseDate >= $last30days AND p.InvoiceNo = o.POrderID AND o.POrderID = oc.COrderID
					GROUP BY oc.IId) AS sales, Item i
			WHERE sales.IId = i.IId";
$querymonth = mysqli_query($con,$sqlmonth) or die(mysqli_error($con));
$count = mysqli_num_rows($querymonth);
if($count > 0){
		echo "<table border=1 width=500>";
		echo "<tr><td>IID</td>";
		echo "<td>Item</td>";
		echo "<td>Quantity Sold</td>";
		echo "<td>Subtotal</td></tr>";
		$revenue = 0;
		while($row = mysqli_fetch_array($querymonth)){
	        $id = $row["IId"];
	        $name = $row["IName"];
		    $quantity = $row["total"];
		    $subtotal = $row["subtotal"];
		    $subtotal = number_format($subtotal, 2, '.', ',');
		    $revenue = $revenue + $subtotal;
		    echo ("<tr><td>$id</td>");
			echo ("<td>$name</td>");
			echo ("<td>$quantity</td>");
			echo ("<td>\$ $subtotal</td></tr>");
            } // close while
            echo "<tr><th colspan=4>Revenue: \$ $revenue</th></tr>";
        echo "</table>";
		} else {
			echo "<table>";
			echo "<tr><td>No item was sold in the last 30 days.</td></tr>";	
			echo "</table>";
		}
}

elseif(isset($_POST['LastYear'])){

$sqlyear = "SELECT i.IId, i.IName, sales.total, (i.IPrice*sales.total) AS subtotal
			FROM (SELECT oc.IId, sum(oc.OQuantity) AS total
					FROM Purchase p, Orders o, OrderContains oc
					WHERE PurchaseDate >= $lastyear AND p.InvoiceNo = o.POrderID AND o.POrderID = oc.COrderID
					GROUP BY oc.IId) AS sales, Item i
			WHERE sales.IId = i.IId";
$queryyear = mysqli_query($con,$sqlyear) or die(mysqli_error($con));
$count = mysqli_num_rows($queryyear);
if($count > 0){
		echo "<table border=1 width=500>";
		echo "<tr><td>IID</td>";
		echo "<td>Item</td>";
		echo "<td>Quantity Sold</td>";
		echo "<td>Subtotal</td></tr>";
		$revenue = 0;
		while($row = mysqli_fetch_array($queryyear)){
	        $id = $row["IId"];
	        $name = $row["IName"];
		    $quantity = $row["total"];
		    $subtotal = $row["subtotal"];
		    $subtotal = number_format($subtotal, 2, '.', ',');
		    $revenue = $revenue + $subtotal;
		    echo ("<tr><td>$id</td>");
			echo ("<td>$name</td>");
			echo ("<td>$quantity</td>");
			echo ("<td>\$ $subtotal</td></tr>");
            } // close while
            echo "<tr><th colspan=4>Revenue: \$ $revenue</th></tr>";
        echo "</table>";
		} else {
			echo "<table>";
			echo "<tr><td>No item was sold in the last 365 days.</td></tr>";	
			echo "</table>";
		}
}    
    include "disconnect.php";
?>