<?php
//Author: Feiyu Shi
//Date: 11/19/2013
//Last Edited: 
//Date: 


 error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
//     session_start();
    
    if(isset($_SESSION['empID'])) {
        $proEID = $_SESSION['empID'];
    }

// connect to server
include "connect_local.php";
// process the search query
if(isset($_POST['IId'])&& isset($_POST['promotionrate'])&& isset($_POST['promostart'])&& isset($_POST['promoend'])){
// check if current employee is a manager
$sqlquery = "SELECT IsManager
				FROM Employee
				WHERE EId = $proEID";
$query1 = mysqli_query($con,$sqlquery) or die(mysqli_error($con));

while($row = mysqli_fetch_array($query1)){
	$manager = $row["IsManager"];
	}
	
if ($manager == 1){
	$iid = $_POST['IId'];
	$promorate = $_POST['promotionrate']*0.01;
	$promoend = $_POST['promoend'];
	$promostart = $_POST['promostart'];
	$sqlinsert = "INSERT INTO Promote (EId,IId,PromoteRate,PStartDate, PEndDate)
					VALUES ('$proEID','$iid','$promorate','$promostart','$promoend');";
	// $sqlupdate = "UPDATE Item
// 					SET PromoPrice = IPrice*(1-$promorate)
// 					WHERE IId=$iid;";
	// $sqlupdate = "UPDATE Item i, Promote p
// 					SET i.PromoPrice = i.IPrice * (1-p.PromoteRate)
// 					WHERE i.IId = $iid AND p.IId = i.IId AND p.PStartDate = TIMESTAMP(CURDATE(),'00:00:00')";
	$query2 = mysqli_query($con,$sqlinsert) or die(mysqli_error($con));
// 	$query3 =mysqli_query($con,$sqlupdate) or die(mysqli_error($con));
	echo "You successfully promote an item!";
	}else
	{
	echo "You are not a manager. You can't promote an item.";
	}
}
include "disconnect.php";
?>