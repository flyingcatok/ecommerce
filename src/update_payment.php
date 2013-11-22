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
    
    if(isset($_POST["ccNum"]) && ($_POST["ccNum"] != $oldCard[1])) {
        $editCcNum = $_POST["ccNum"];
        $specialQuery[0] = "DELETE FROM BillingAddress WHERE CardNo = '$oldCard[1]';";
        $specialQuery[1] = "DELETE FROM PaymentMethods WHERE CardNo = '$oldCard[1]';";
        $specialQuery[2] = "INSERT INTO PaymentMethods(IsVisible, CEmail, CardNo, CHolderLastName, CHolderFirstName, CExpirDate) VALUES
                ('1', '$billCEmail', '$oldCard[1]', '$oldCard[2]', '$oldCard[3]', '$oldCard[4]');";
        $specialQuery[3] = "INSERT INTO BillingAddress(IsVisible, CEmail, CardNo, Baddr1, BCity, BState) VALUES
            ('1', '$billCEmail', '$oldCard[1]', '$oldCard[5]', '$oldCard[6]', '$oldCard[7]');";
       }
       if(isset($_POST["fName"]) && ($_POST["fName"] != $oldCard[3])) {
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
       if (isset($_POST["lName"]) && ($_POST["lName"] != $oldCard[2])) {
           $editLName = $_POST["lName"];
           if (isset($editCcNum)) {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CHolderLastName = '$editLName' WHERE CEmail = '$billCEmail' AND CardNo = '$editCcNum';";
           }
           else {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CHolderLastName = '$editLName' WHERE CEmail = '$billCEmail' AND CardNo = '$oldCard[1]';";
           }
           $numEdits++;
       }
       if (isset($_POST["eDate"]) && ($_POST["eDate"] != $oldCard[4])) {
           $editExpy = $_POST["eDate"];
           if (isset($editCcNum)) {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CExpirDate= '$editExpy' WHERE CEmail = '$billCEmail' AND CardNo = '$editCcNum';";
           }
           else {
               $myQueries[$numEdits] = "UPDATE PaymentMethods SET CExpirDate = '$editExpy' WHERE CEmail = '$billCEmail' AND CardNo = '$oldCard[1]';";
           }
           $numEdits++;
       }
       if (isset($_POST["bLine1"]) && ($_POST["bLine1"] != $oldCard[5])) {
           $editBLine1 = $_POST["bLine1"];
           if (isset($editCcNum)) {
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
       }
       
       include "disconnect.php";
       
}

Header('Location: my_payment.php');

?>