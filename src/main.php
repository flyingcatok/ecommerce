<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$search_output = "";
// process the search query
if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
	$searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']);
	if($_POST['filter1'] == "Item"){
		//$sqlCommand = "SELECT * FROM Item WHERE MATCH('IName','Category','Description') AGAINST ('$searchquery')";
		$sqlCommand = "SELECT * FROM Item WHERE IName LIKE '%$searchquery%' OR Category LIKE '%$searchquery%' OR Description LIKE '%$searchquery%'";

	}
// connect to server
include_once "connect_local.php";
$query = mysql_query($sqlCommand) or die(mysql_error());
$count = mysql_num_rows($query);
if($count > 1){
		$search_output .= "<hr />$count results for <strong>$searchquery</strong><hr />";
		while($row = mysql_fetch_array($query)){
	            $id = $row["IId"];
		    $name = $row["IName"];
		    $descript = $row["Description"];
		    $quantity = $row["Quantity"];
		    $price = $row["IPrice"];
		    $search_output .= "Item ID: $id - $name <br /> Description $descript <br />Quantity: $quantity<br /> Price: $price <br /><br />";
                } // close while
	} else {
		$search_output = "<hr />0 results for <strong>$searchquery</strong><hr />";		
}
?>
<HTML>
<HEAD>
<TITLE> CS 405G Project </TITLE>
</HEAD>
<BODY>
<H1> F&L Gift Store </H1>
<br />
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
Search <input name="searchquery" type="text" size = "60" maxlength = "80">
Within:
<select name = "filter1">
<option value = "Item">Item</option>
</select>
<input name = "myBtn" type = "submit">
</form>
<div>
<?php echo $search_output;?>
</div>
</BODY>
</HTML>