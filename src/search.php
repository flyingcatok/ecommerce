<?php
// search function
error_reporting(E_ALL);
ini_set('display_errors', '1');
$search_output = "";
// process the search query
if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
	$searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']);
	//$sqlCommand = "SELECT * FROM Item WHERE MATCH('IName') AGAINST ('$searchquery')";
	$sqlCommand = "SELECT * FROM Item WHERE IName LIKE '%$searchquery%' OR Category LIKE '%$searchquery%' OR Description LIKE '%$searchquery%'";
// connect to server
include "connect_local.php";
$query = mysqli_query($con,$sqlCommand) or die(mysqli_error($con));
include "disconnect.php";
$count = mysqli_num_rows($query);
if($count > 1){
		$search_output .= "<hr />$count results for <strong>$searchquery</strong><hr />";
		while($row = mysqli_fetch_array($query)){
	            $id = $row["IId"];
		    $name = $row["IName"];
		    $category = $row["Category"];
		    $descript = $row["Description"];
		    $quantity = $row["Quantity"];
		    $price = $row["IPrice"];
		    $search_output .= "Item ID: $id - $name <br /> 
		    Description: $descript <br />
		    Category: $category <br />
		    Quantity: $quantity<br /> 
		    Unit Price: $price <br /><br />";
                } // close while
	} else {
		$search_output = "<hr />0 results for <strong>$searchquery</strong><hr />";		
}
}
?>