<?php 
//Author: Libby Ferland
//Date: 11/23/2013
//Last Edit:
//Edit Date:

 error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
    session_start();
    
    //find customer ID (email) from login info
    if(isset($_SESSION['email'])) {
        $newPayEmail = $_SESSION['email'];
    }
    else {
        echo "too bad";
    }
    
    if (isset($_POST["addPayBtn"])) {
        if (isset($_POST["newcard"]) && ($_POST["newcard"] != 0)) {
            $newccNum = $_POST["newcard"];
        }
        else {
            $message = "You must enter a valid credit card number.";
        }
        if (isset($_POST["newedate"]) && ($_POST["newedate"] != 0)) {
            $newEDate = $_POST["newedate"];
        }
        else {
            $message = "You must enter a valid expiration date.";
        }
        if (isset($_POST["newchfirst"]) && ($_POST["newchfirst"] != " ")) {
            $newcFirst = $_POST["newchfirst"];
        }
        else {
            $message = "You must enter a valid card holder name.";
        }
        if (isset($_POST["newchlast"]) && ($_POST["newchlast"] != " ") ) {
            $newcLast = $_POST["newchlast"];
        }
        else {
            $message = "You must enter a valid card holder name.";
        }
        if (isset($_POST["newbill1"]) && ($_POST["newbill1"] != " ")) {
            $newBill1 = $_POST["newbill1"];
        }
        else {
            $message = "You must enter a valid billing address.";
        }
        if (isset($_POST["newbill2"]) && ($_POST["newbill2"]) != " ") {
            $newBill2 = $_POST["newbill2"];
        }
        if (isset($_POST["newbcity"]) && ($_POST["newbcity"] != " ")) {
            $newBCity = $_POST["newbcity"];
        }
        else {
            $message = "You must enter a valid billing address.";
        }
        if (isset($_POST["newbstate"]) && ($_POST["newbstate"] != "Default")) {
            $newBState = $_POST["newbstate"];
        }
        else {
            $message = "You must enter a valid billing address.";
        }
        if (isset($_POST["bzipc"]) &&($_POST["bzipc"] != " ")) {
            $newBZip = $_POST["bzipc"];
        }
        else {
            $message = "You must enter a valid billing address.";
        }
    }
    
    if (isset($message)) {
        echo $message;
        echo "<br>";
        echo "<a href = \"new_payment_method.php\">Please enter your information again.</a>";
    }
    else {
        include "connect_local.php";
        $dupCardCheck = "SELECT COUNT(*) FROM PaymentMethods WHERE CEmail = '$newPayEmail' AND CardNo = '$newccNum';"; 
    
        $newCardQuery = "INSERT INTO PaymentMethods(IsVisible, CEmail, CardNo, CHolderLastName, CHolderFirstName, CExpirDate) VALUES(1, '$newPayEmail', '$newccNum', '$newcLast',
            '$newcFirst', '$newEDate')";
        $newBAQuery = "INSERT INTO BillingAddress(IsVisible, CEmail, CardNo, Baddr1, BCity, BState) VALUES (1,'$newPayEmail', '$newccNum', '$newBill1',
                '$newBCity', '$newBState');";
        
        $isDupCard = mysqli_query($con, $dupCardCheck);
        $dupCard = $isDupCard->fetch_row();
        
        if($dupCard[0] != 0) {
            echo "This card is already associated with your account. <br>";
            echo "<a href=\"my_account.php\">Return to account home.</a>";
            include "disconnect.php";
        }
        else {
            mysqli_query($con, $newCardQuery);
            mysqli_query($con, $newBAQuery);
            include "disconnect.php";
            Header('Location: my_payment.php');
        }
    }
    
    ?>