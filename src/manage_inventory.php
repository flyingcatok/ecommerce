<?php
//Author: Feiyu Shi
//Date: 11/16/2013
//Last Edit: Feiyu Shi
//Edit Date: 11/25/2013

if(isset($_SESSION['empID'])) {
        $invEID = $_SESSION['empID'];
    }
?>

<HTML>
    <HEAD>
    <TITLE> Inventory </TITLE>
<!--     <meta http-equiv="refresh" content="60">  -->
    </HEAD>
    <div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="employee_home.php">Employee Home</a>
        <a href ="employee_logout.php">Logout</a>
    </div>
	<br />
	<br />
	<div>
	<h2>Current Inventory</h2>
	<p>as of<?php  $today = date_create("",timezone_open("America/New_York")); echo " ".date_format($today,"Y-m-d H:i:s");?> </p>
    <hr />
    <?php
    // connect to server
	include "connect_local.php";
	if(isset($_POST['quantity'])&& $_POST['quantity']!=""&&$_POST['quantity']>=0&&is_numeric($_POST['quantity'])){
	$updatedquan = mysqli_real_escape_string($con,$_POST['quantity']);
	$selectedid = mysqli_real_escape_string($con,$_POST['IID']);
	$sqlupdate = "UPDATE Item
					SET Quantity = $updatedquan
					WHERE IId = $selectedid";
	$updatequery = mysqli_query($con,$sqlupdate) or die(mysqli_error($con));	
	}
	// display all items
	$sqlquery = "SELECT * FROM Item ORDER BY IId;";
	$query = mysqli_query($con,$sqlquery) or die(mysqli_error($con));
	$count = mysqli_num_rows($query);
	if($count > 0){
		echo "<table border=1>";
		echo "<tr><td>IId</td>";
		echo "<td>Item</td>";
		echo "<td>Category</td>";
		echo "<td>Unit Price</td>";
		echo "<td>Promotion?</td>";
		echo "<td>Discount Price</td>";
		echo "<td>Quantity</td>";
		echo "<td>Update Quantity</td></tr>";
		while($row = mysqli_fetch_array($query)){
		$iid = $row["IId"];
		$itemName = $row["IName"];
		$oprice = $row["IPrice"];
		$category = $row['Category'];
		$promoprice = $row["PromoPrice"];
		if(is_null($promoprice)){
			$promo = 0;
			}else{
			$promo = 1;
			}	
		$promoprice = number_format($promoprice, 2, '.', ',');
		$quantity = $row["Quantity"];
		echo "<tr><td>$iid</td>";
		echo "<td><a href=items/iid=$iid.php>$itemName</a></td>";
		echo "<td>$category</td>";
		echo "<td>\$ $oprice</td>";
		if ($promo==1){
		echo "<td>Yes</td>";
		echo "<td>\$ $promoprice</td>";
		}elseif ($promo==0){
		echo "<td>No</td>";
		echo "<td></td>";
		}
// 		echo "<td>$quantity</td>";
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
		<?php echo "<td><input type='text' name=quantity value = $quantity size = '5'> </td>" ?>
		<?php echo "<input type ='hidden' name=IID value = $iid>";?>
		<td><input type="submit" value="update">
		</td></tr>
		</form>
		
		<?php
		if ($quantity < 10){
			echo "<font color='red'>WARNING: Please Stock Item ID = $iid IMMEDIATELY!</font>"."<br>";
		}
		if ($quantity >=10 && $quantity <50){
			echo "<font color='#0101DF'>WARNING: Please Stock Item ID = $iid.</font>"."<br>";
		}
        } // close while
        echo "</table>";
        // if ($quantity == 0){
// 			echo "WARNING: Please Stock Item ID = $iid";
// 		}
	} else {
		echo "<table>";
		echo "<tr><td>Your inventory is empty.</td></tr>";	
		echo "</table>";
}
	include "disconnect.php";
    ?>
	</div>
</HTML>