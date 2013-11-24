<?php 
//Author: Libby Ferland
//Date: 11/22/2013
//Last Edit:
//Edit Date:

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors','1');
session_start();
    
    //find customer ID (email) from login info
if(isset($_SESSION['email'])) {
    $billCEmail = $_SESSION['email'];
}
else {
    echo "too bad";
}

$myQueries = array();
$specialQuery = array();
$numEdits = 0;

if (isset($_POST["confirm-edit"])) {
    if (isset($_POST["old-card"])) {
        $pastCard = $_POST["old-card"];
        $oldCard = explode(',', $pastCard);
    }
    
    if(isset($_POST["ccNum"]) && ($_POST["ccNum"] != $oldCard[1]) && ($_POST["ccNum"] != "")) {
        $editCcNum = $_POST["ccNum"];
        $specialQuery[0] = "DELETE FROM BillingAddress WHERE CardNo = '$oldCard[1]';";
        $specialQuery[1] = "DELETE FROM PaymentMethods WHERE CardNo = '$oldCard[1]';";
        $specialQuery[2] = "INSERT INTO PaymentMethods(CEmail, CardNo, CHolderLastName, CHolderFirstName, CExpirDate, IsVisible) VALUES
                ('$billCEmail', '$editCcNum', '$oldCard[2]', '$oldCard[3]', '$oldCard[4]', '1');";
        $specialQuery[3] = "INSERT INTO BillingAddress (CEmail, CardNo, AddrIndex, IsVisible) VALUES
            ('$billCEmail', '$editCcNum', '$oldCard[10]', '1');";
       }
       if(isset($_POST["fName"]) && ($_POST["fName"] != $oldCard[3]) && ($_POST["fName"] != " ")) {
           $editFName = $_POST["fName"];
           if (isset($editCcNum)) {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CHolderFirstName = '$editFName' WHERE CEmail = '$billCEmail' AND CardNo = '$editCcNum';";
           }
           else {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CHolderFirstName = '$editFName' WHERE CEmail = '$billCEmail' AND CardNo = '$oldCard[1]';";
           }
           //$columnNames[$numEdits] = "AddrLine2";
           //$newValues[$numEdits] = $editLineTwo;
           $numEdits++;
       }
       if (isset($_POST["lName"]) && ($_POST["lName"] != $oldCard[2]) && ($_POST["lName"] != " ")) {
           $editLName = $_POST["lName"];
           if (isset($editCcNum)) {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CHolderLastName = '$editLName' WHERE CEmail = '$billCEmail' AND CardNo = '$editCcNum';";
           }
           else {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CHolderLastName = '$editLName' WHERE CEmail = '$billCEmail' AND CardNo = '$oldCard[1]';";
           }
           $numEdits++;
       }
       if (isset($_POST["eDate"]) && ($_POST["eDate"] != $oldCard[4]) && ($_POST["eDate"] != " ")) {
           $editExpy = $_POST["eDate"];
           if (isset($editCcNum)) {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CExpirDate= '$editExpy' WHERE CEmail = '$billCEmail' AND CardNo = '$editCcNum';";
           }
           else {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CExpirDate = '$editExpy' WHERE CEmail = '$billCEmail' AND CardNo = '$oldCard[1]';";
           }
           $numEdits++;
       }
       
       if (isset($_POST["bLine1"]) && ($_POST["bLine1"] != "")) {
           $editBLine1 = $_POST["bLine1"];
       }
        if (isset($_POST["bLine2"])) {
           $editBLine2 = $_POST["bLine2"];
       }
        if (isset($_POST["bCity"]) && ($_POST["bCity"] != "")) {
           $editBCity = $_POST["bCity"];
       }
        if (isset($_POST["changebstate"])) {
           $editBState = $_POST["changebstate"];
       }
       if (isset($_POST["bZip"]) && ($_POST["bZip"] != "")) {
           $editBZip = $_POST["bZip"];
       }
   
       $checkforAddr = "SELECT COUNT(*) FROM AddressBook WHERE CEmail = '$billCEmail' AND AddrLine1 = '$editBLine1' AND AddrLine2 = '$editBLine2' 
              AND City = '$editBCity' AND State = '$editBState' AND Zip = '$editBZip';";
       
       include "connect_local.php";
       
       if (isset($editCcNum)) {
           for ($d = 0; $d < 4; $d++) {
               mysqli_query($con, $specialQuery[$d]) or die ("Error with query $d" . mysqli_error($con));
           }
       }
       
       for ($f = 0; $f < $numEdits; $f++) {
           mysqli_query($con, $myQueries[$f]);
       }
       
       $inBook = mysqli_query($con, $checkforAddr);
       
       $isBooked = $inBook->fetch_row();
       
       if ($isBooked[0] == 0) {
           $makeNewAdd = "INSERT INTO AddressBook(CEmail, AddrLine1, AddrLine2, City, State, Zip) VALUES('$billCEmail', '$editBLine1', '$editBLine2', '$editBCity', '$editBState', '$editBZip');";
           mysqli_query($con, $makeNewAdd);
           $newAddIn = "SELECT MAX(AddrIndex) AS NewIndex FROM AddressBook;";
           $finder = mysqli_query($con, $newAddIn);
           while ($irow = $finder->fetch_row()) {
               $thisIndex = $irow[0];
           }
           if (isset($editCcNum)) {
               $updateBATable = "UPDATE BillingAddress SET AddrIndex = '$thisIndex' WHERE CardNo = '$editCcNum';  ";
           }
           else {
           $updateBATable = "UPDATE BillingAddress SET AddrIndex = '$thisIndex' WHERE CardNo = '$oldCard[1]';";
       }
       mysqli_query($con, $updateBATable);
       }
       else {
           $getMatchingIn = "SELECT AddrIndex FROM AddressBook WHERE CEmail = '$billCEmail' AND AddrLine1 = '$editBLine1' AND AddrLine2 = '$editBLine2' 
              AND City = '$editBCity' AND State = '$editBState' AND Zip = '$editBZip';";
           
           $existAddIn = mysqli_query($con, $getMatchingIn);
           
           while ($grow = $existAddIn->fetch_row()) {
               $thisAdd = $grow[0];
           }
           if (isset($editCcNum)) {
               $updateBATable = "UPDATE BillingAddress SET AddrIndex = '$thisAdd' WHERE CardNo = '$editCcNum';  ";
           }
           else {
              $updateBATable = "UPDATE BillingAddress SET AddrIndex = '$thisAdd' WHERE CardNo = '$oldCard[1]';";
           } 
          mysqli_query($con, $updateBATable);
       }
       
       
           /*if (isset($editCcNum)) {
               $myQueries[$numEdits] = "UPDATE BillingAddress SET Baddr1 = '$editBLine1' WHERE CEmail = '$billCEmail' AND CardNo = '$editCcNum';";
           }
           else {
               $myQueries[$numEdits] = "UPDATE BillingAddress SET Baddr1 = '$editBLine1' WHERE CEmail = '$billCEmail' AND CardNo = '$oldCard[1]';";
           }
           $numEdits++;
       }
       if (isset($_POST["bCity"]) && ($_POST["bCity"] != $oldCard[6])) {
           $editBCity = $_POST["bCity"];
           if (isset($editCcNum)) {
               $myQueries[$numEdits] = "UPDATE BillingAddress SET BCity = '$editBCity' WHERE CEmail = '$billCEmail' AND CardNo = '$editCcNum';";
           }
           else {
               $myQueries[$numEdits] = "UPDATE BillingAddress SET BCity = '$editBCity' WHERE CEmail = '$billCEmail' AND CardNo = '$oldCard[1]';";
           }
           $numEdits++;
       }
       if (isset($_POST["bState"]) && ($_POST["bState"] != $oldCard[7])) {
           $editBState = $_POST["bState"];
           if (isset($editCcNum)) {
               $myQueries[$numEdits] = "UPDATE BillingAddress SET BState = '$editBState' WHERE CEmail = '$billCEmail' AND CardNo = '$editCcNum';";
           }
           else {
               $myQueries[$numEdits] = "UPDATE BillingAddress SET BState = '$editBState' WHERE CEmail = '$billCEmail' AND CardNo = '$oldCard[1]';";
           }
           $numEdits++;
       }
       include "connect_local.php";
       
       if (isset($editCcNum)) {
           for ($d = 0; $d < 4; $d++) {
               mysqli_query($con, $specialQuery[$d]);
           }
       }
       
       for ($f = 0; $f < $numEdits; $f++) {
           mysqli_query($con, $myQueries[$f]);
       } */
       
       include "disconnect.php";
       
}

Header('Location: my_payment.php');

?>