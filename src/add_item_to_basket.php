<?php
//Author: Feiyu Shi
//Date: 11/12/2013
//Last Edited: Feiyu Shi
//Date: 11/13/2013

session_start();
    //find customer ID (email) from login info
    if(isset($_SESSION['email'])) {
        $Email201 = $_SESSION['email'];
        echo "$Email201";
    }
    else {
        echo "too bad";
    }
    
    if(isset($_POST["iquantity"])) {
            $iquan = $_POST["iquantity"];
        }
        if(isset($_POST["IID"])) {
            $id = $_POST["IID"];
        }

// queries
$sqlCommand1 = "SELECT i.IId
					FROM Customer c, Basket b, BasketContains bc, Item i
					WHERE b.CEmail = '$Email201' AND b.CEmail = bc.CEmail AND b.BasketId = bc.BaskId
							AND bc.IId = i.IId;";// get the iid of items in the basket

$sqlCommand2 = "SELECT BasketId
				FROM Basket
				WHERE CEmail = '$Email201';";//get the basket id of the customer

include "connect_local.php";
$query1 = mysqli_query($con,$sqlCommand1) or die(mysqli_error($con));
$query2 = mysqli_query($con,$sqlCommand2) or die(mysqli_error($con));

while($row = mysqli_fetch_array($query2)){
$basketid = $row["BasketId"];
}
$i=0;
while($row = mysqli_fetch_array($query1)){
$iidinbasket[$i] = $row["IId"];
$i++;
}
// check if the current item is in the basket
if(!in_array($id,$iidinbasket)){ //if not, insert
$sqlinsert = "INSERT INTO BasketContains(CEmail,BaskId,IId,BQuantity)VALUES('$Email201','$basketid','$id','$iquan');";
mysqli_query($con,$sqlinsert) or die(mysqli_error($con));
}
else{// if yes, update
$sqlupdate = "UPDATE BasketContains
				SET BQuantity = BQuantity + $iquan
				WHERE CEmail = '$Email201' AND BaskId = '$basketid' AND IId = '$id'";
mysqli_query($con,$sqlupdate) or die(mysqli_error($con));
}

include "disconnect.php";
// Header('Location: customer_basket.php');//redirected to the basket page
?>
<html>
<head>
<meta http-equiv="refresh" content="0;url=customer_basket.php"> 
</head>
</html>