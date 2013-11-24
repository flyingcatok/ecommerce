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
        if (isset($_POST["newcard"]) && ($_POST["newcard"] != "")) {
            $newccNum = $_POST["newcard"];
        }
        else {
            $message = "You must enter a valid credit card number.";
        }
        if (isset($_POST["newedate"]) && ($_POST["newedate"] != "")) {
            $newEDate = $_POST["newedate"];
        }
        else {
            $message = "You must enter a valid expiration date.";
        }
        if (isset($_POST["newchfirst"]) && ($_POST["newchfirst"] != "")) {
            $newcFirst = $_POST["newchfirst"];
        }
        else {
            $message = "You must enter a valid card holder name.";
        }
        if (isset($_POST["newchlast"]) && ($_POST["newchlast"] != "") ) {
            $newcLast = $_POST["newchlast"];
        }
        else {
            $message = "You must enter a valid card holder name.";
        }
        if (isset($_POST["newbill1"]) && ($_POST["newbill1"] != "")) {
            $newBill1 = $_POST["newbill1"];
        }
        else {
            $message = "You must enter a valid billing address.";
        }
        if (isset($_POST["newbill2"])) {
            $newBill2 = $_POST["newbill2"];
        }
        if (isset($_POST["newbcity"]) && ($_POST["newbcity"] != "")) {
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
        if (isset($_POST["bzipc"]) &&($_POST["bzipc"] != "")) {
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
        $dupCardCheck = "SELECT COUNT(*) FROM PaymentMethods WHERE CEmail = '$newPayEmail' AND CardNo = '$newccNum' AND IsVisible = 1;"; 
    
        $newCardQuery = "INSERT INTO PaymentMethods(CEmail, CardNo, CHolderLastName, CHolderFirstName, CExpirDate, IsVisible) VALUES('$newPayEmail', '$newccNum', '$newcLast',
            '$newcFirst', '$newEDate', 1)";
        
        $checkBook = "SELECT COUNT(*) FROM AddressBook WHERE CEmail = '$newPayEmail' AND AddrLine1 = '$newBill1' AND AddrLine2 = '$newBill2' 
              AND City = '$newBCity' AND State = '$newBState' AND Zip = '$newBZip';";
        
        
        
       /* $newBAQuery = "INSERT INTO BillingAddress(IsVisible, CEmail, CardNo, Baddr1, BCity, BState) VALUES (1,'$newPayEmail', '$newccNum', '$newBill1',
                '$newBCity', '$newBState');"; */
        
        $isDupCard = mysqli_query($con, $dupCardCheck);
        $dupCard = $isDupCard->fetch_row();
        
        if($dupCard[0] != 0) {
            echo "This card is already associated with your account. <br>";
            echo "<a href=\"my_account.php\">Return to account home.</a>";
            include "disconnect.php";
        }
        else {
            mysqli_query($con, $newCardQuery);
            $foundIn = mysqli_query($con, $checkBook);
            if (!$foundIn) {
                echo "Error in checking address book: " . mysqli_error($con);
            }
            $myIn = $foundIn->fetch_row();
            if($myIn[0] != 0) {
                echo ("I found this many! $myIn[0] <br>");
              $getBookIn = "SELECT AddrIndex FROM AddressBook WHERE CEmail = '$newPayEmail' AND AddrLine1 = '$newBill1' AND AddrLine2 = '$newBill2' 
              AND City = '$newBCity' AND State = '$newBState' AND Zip = '$newBZip';";
              $bookedIn = mysqli_query($con, $getBookIn);
              if (!$bookedIn) {
                  echo "Error in finding index: " . mysqli_error($con);
              }
              while ($mrow = $bookedIn->fetch_row()) {
                  $theIn = $mrow[0];
              }
              $newBAEntry = "INSERT INTO BillingAddress(CEmail, CardNo, AddrIndex, IsVisible) VALUES('$newPayEmail', '$newccNum', '$theIn', 1);";
              mysqli_query($con, $newBAEntry); 
            }
            else {
               // echo "I came to the important else <br>";
                $newAddBEntry = "INSERT INTO AddressBook(CEmail, AddrLine1, AddrLine2, City, State, Zip, IsVisible) VALUES ('$newPayEmail', '$newBill1', '$newBill2', '$newBCity', '$newBState', '$newBZip', 1);";
                $newAddIn = "SELECT MAX(AddrIndex) AS Newest FROM AddressBook;";
                mysqli_query($con, $newAddBEntry);
                $lastIn = mysqli_query($con, $newAddIn);
                
                while($nrow = $lastIn->fetch_row() ) {
                    $thisIn = $nrow[0];
                }
                $newBAEntry = "INSERT INTO BillingAddress(CEmail, CardNo, AddrIndex, IsVisible) VALUES ('$newPayEmail', '$newccNum', '$thisIn', 1);";
                mysqli_query($con, $newBAEntry);
            }
            include "disconnect.php";
            Header('Location: my_payment.php');
        }
    }
    
    ?>