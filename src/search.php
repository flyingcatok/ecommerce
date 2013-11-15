<html>
<table border="1">
<?php
// search function
error_reporting(E_ALL);
ini_set('display_errors', '1');

// connect to server
include "connect_local.php";
// process the search query
if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
	//$searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']);
	$searchquery = mysqli_real_escape_string($con,$_POST['searchquery']);
	$keys = explode(" ",$searchquery);//support multiple key words search
	$sqlCommand = "SELECT * FROM Item WHERE `IName` LIKE '%$searchquery%' OR `Category` LIKE '%$searchquery%' OR `Description` LIKE '%$searchquery%' ";
	foreach($keys as $k){
    $sqlCommand .= " OR `IName` LIKE '%$k%' OR `Category` LIKE '%$k%' OR `Description` LIKE '%$k%' ";
}

$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));
include "disconnect.php";
$count = mysqli_num_rows($query);
if($count > 0){
		echo ("<tr><td>Item</td>");
		echo ("<td>Category</td>");
		echo ("<td>Price</td></tr>");
		while($row = mysqli_fetch_array($query)){
	            $id = $row["IId"];
		    $name = $row["IName"];
		    $category = $row["Category"];
// 		    $descript = $row["Description"];
// 		    $quantity = $row["Quantity"];
		    $price = $row["IPrice"];
// 		    $search_output .= "Item ID: $id - $name <br /> 
// 		    Description: $descript <br />
// 		    Category: $category <br />
// 		    Quantity: $quantity<br /> 
// 		    Unit Price: $price <br /><br />";
			echo ("<tr><td><a href=items/iid=$id.php>$name</a></td>");
			echo ("<td>$category</td>");
			echo ("<td>\$ $price</td></tr>");
			
                } // close while
	} else {
		echo "<tr><td>No item fits your search.</td></tr>";	
}
}
?>
</table>
</html>