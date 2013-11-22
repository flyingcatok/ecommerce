<?php
//Author: Libby Ferland
//Date: 11/20/2013
//Last Edit:
//Edit Date:

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors','1');
session_start();
    
    //find customer ID (email) from login info
if(isset($_SESSION['email'])) {
    $addrCEmail = $_SESSION['email'];
}
else {
    echo "too bad";
}

//$columnNames = array();
//$newValues = array();
$myQueries = array();
$numEdits = 0;
if (isset($_POST["confirm-edit"])) {
    if (isset($_POST["old-address"])) {
        $pastAddr = $_POST["old-address"];
        $oldAddr = explode(',', $pastAddr);
    }
    if(isset($_POST["lineOne"]) && ($_POST["lineOne"] != $oldAddr[1])) {
        $editLineOne = $_POST["lineOne"];
        $myQueries[$numEdits] = "UPDATE AddressBook SET AddrLine1 = '$editLineOne' WHERE CEmail = '$addrCEmail' AND AddrIndex = '$oldAddr[6]';";
       // $columnNames[$numEdits] = "AddrLine1";
        //$newValues[$numEdits] = $editLineOne;
        $numEdits++;
       }
       if(isset($_POST["lineTwo"]) && ($_POST["lineTwo"] != $oldAddr[2])) {
           $editLineTwo = $_POST["lineTwo"];
           $myQueries[$numEdits] = "UPDATE AddressBook SET AddrLine2 = '$editLineTwo' WHERE CEmail = '$addrCEmail' AND AddrIndex = '$oldAddr[6]';";
           //$columnNames[$numEdits] = "AddrLine2";
           //$newValues[$numEdits] = $editLineTwo;
           $numEdits++;
       }
       if (isset($_POST["city"]) && ($_POST["city"] != $oldAddr[3])) {
           $editCity = $_POST["city"];
           $myQueries[$numEdits] = "UPDATE AddressBook SET City = '$editCity' WHERE CEmail = '$addrCEmail' AND AddrIndex = '$oldAddr[6]'; ";
          // $columnNames[$numEdits] = "City";
          // $newValues[$numEdits] = $editCity;
           $numEdits++;
       }
       if (isset($_POST["state"]) && ($_POST["state"] != $oldAddr[4])) {
           $editState = $_POST["state"];
           $myQueries[$numEdits] = "UPDATE AddressBook SET State = '$editState' WHERE CEmail = '$addrCEmail' AND AddrIndex = '$oldAddr[6]';";
          // $columnNames[$numEdits] = "State";
          // $newValues[$numEdits] = $editState;
           $numEdits++;
       }
       if (isset($_POST["zip"]) && ($_POST["zip"] != $oldAddr[5])) {
           $editZip = $_POST["zip"];
           $myQueries[$numEdits] = "UPDATE AddressBook SET Zip = '$editZip' WHERE CEmail = '$addrCEmail' AND AddrIndex = '$oldAddr[6]';";
           //$columnNames[$numEdits] = "Zip";
           //$newValues[$numEdits] = $editZip;
           $numEdits++;
       }
       
       include "connect_local.php";
       
       for ($k = 0; $k < $numEdits; $k++) {
           mysqli_query($con, $myQueries[$k]);
       }
       
       include "disconnect.php";
       
}

Header('Location: my_address.php');

?>