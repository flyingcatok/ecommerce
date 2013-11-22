<?php
//Author: Feiyu Shi
//Date: 11/15/2013
//Last Edited: Feiyu Shi
//Date: 11/22/2013

// search function
error_reporting(E_ALL);
ini_set('display_errors', '1');

// connect to server
include "connect_local.php";
// process the search query
if(isset($_POST['category'])&&$_POST['category']=='Games'){
$sqlCommand = "SELECT *
				FROM Item
				WHERE Category = 'Games'";

$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));
$count = mysqli_num_rows($query);

if($count > 0){
		echo "<table border=1 width=500>";
		echo "<tr><td>Item</td>";
		echo "<td>Category</td>";
		echo "<td>Unit Price</td>";
		echo "<td>Discount Price</td></tr>";
		while($row = mysqli_fetch_array($query)){
	            $id = $row["IId"];
		    $name = $row["IName"];
		    $category = $row["Category"];
			$oprice = $row["IPrice"];
	 		$promoprice = $row["PromoPrice"];
			if(is_null($promoprice)){
				$promo = 0;
				}else{
				$promo = 1;
				$promoprice = number_format($promoprice, 2, '.', ',');
			} 
			echo ("<tr><td><a href=items/iid=$id.php>$name</a></td>");
			echo ("<td>$category</td>");
			echo ("<td>\$ $oprice</td>");
			if ($promo==1){
				echo "<td>\$ $promoprice</td></tr>";
			}elseif ($promo==0){
				echo "<td></td></tr>";
			}
            } // close while
        echo "</table>";
		} else {
			echo "<table>";
			echo "<tr><td>No item is in category games.</td></tr>";	
			echo "</table>";
		}
}

echo "<br />";
if(isset($_POST['category'])&&$_POST['category']=='Toys'){
$sqlCommand = "SELECT *
				FROM Item
				WHERE Category = 'Toys'";

$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));

$count = mysqli_num_rows($query);

if($count > 0){
		echo "<table border=1 width=500>";
		echo ("<tr><td>Item</td>");
		echo ("<td>Category</td>");
		echo ("<td>Unit Price</td>");
		echo ("<td>Discount Price</td></tr>");
		while($row = mysqli_fetch_array($query)){
	            $id = $row["IId"];
		    $name = $row["IName"];
		    $category = $row["Category"];
		    $oprice = $row["IPrice"];
	 		$promoprice = $row["PromoPrice"];
			if(is_null($promoprice)){
				$promo = 0;
				}else{
				$promo = 1;
				$promoprice = number_format($promoprice, 2, '.', ',');
			} 
			echo ("<tr><td><a href=items/iid=$id.php>$name</a></td>");
			echo ("<td>$category</td>");
			echo ("<td>\$ $oprice</td>");
			if ($promo==1){
				echo "<td>\$ $promoprice</td></tr>";
			}elseif ($promo==0){
				echo "<td></td></tr>";
			}
            } // close while
        echo "</table>";
		} else {
			echo "<table>";
			echo "<tr><td>No item is in category toys.</td></tr>";	
			echo "</table>";
		}
}

echo "<br />";
if(isset($_POST['category'])&&$_POST['category']=='all'){
$sqlCommand = "SELECT *
				FROM Item";

$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));

$count = mysqli_num_rows($query);

if($count > 0){
		echo "<table border=1 width=500>";
		echo ("<tr><td>Item</td>");
		echo ("<td>Category</td>");
		echo ("<td>Price</td>");
		echo ("<td>Discount Price</td></tr>");
		while($row = mysqli_fetch_array($query)){
	            $id = $row["IId"];
		    $name = $row["IName"];
		    $category = $row["Category"];
		    $oprice = $row["IPrice"];
	 		$promoprice = $row["PromoPrice"];
			if(is_null($promoprice)){
				$promo = 0;
				}else{
				$promo = 1;
				$promoprice = number_format($promoprice, 2, '.', ',');
			} 
			echo ("<tr><td><a href=items/iid=$id.php>$name</a></td>");
			echo ("<td>$category</td>");
			echo ("<td>\$ $oprice</td>");
			if ($promo==1){
				echo "<td>\$ $promoprice</td></tr>";
			}elseif ($promo==0){
				echo "<td></td></tr>";
			}
            } // close while
        echo "</table>";
		} else {
			echo "<table>";
			echo "<tr><td>No item is in category toys.</td></tr>";	
			echo "</table>";
		}
}

include "disconnect.php";
?>
