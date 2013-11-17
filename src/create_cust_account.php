<?php 
//Author: Libby Ferland
//Date: 11/12/2013
//Last Edited:
//Edit Date:

    if(isset($_POST["createAccBtn"])) {
        if(isset($_POST["firstName"])) {
            $newCFirstName = $_POST["firstName"];
        }
        if(isset($_POST["lastName"])) {
            $newCLastName = $_POST["lastName"];
                
        }
        if(isset($_POST["newEmail"])) {
            $newCEmail = $_POST["newEmail"];
        }
        if (isset($_POST["newPass"])) {
            $newAccPass = $_POST["newPass"];
        }
        
        if(isset($_POST["passConf"])) {
            $confirmedPass = $_POST["passConf"];
        }
    }
    
    if ($newAccPass != $confirmedPass) {
        echo "Password mismatch, please try again<br>";
        echo "<a href=\"customer_registration.php\">Go Back to Registration</a>";
    }
    
    //check and make sure account isn't already registered
    include "connect_local.php";
    $findDupAcct = "SELECT COUNT(*) FROM Customer WHERE Email = '$newCEmail'";
    
    $getDupAcct = mysqli_query($con, $findDupAcct);
    
    $dupAcctResult = $getDupAcct->fetch_row();
    if ($dupAcctResult[0] > 0) {
        echo "There is already an account associated with this email address.&nbsp&nbsp <a href=\"customer_login.php\">Log in now?</a>";
    }
    else {
    $createNewAcct = "INSERT INTO Customer(Email, Password, LName, FName, IsVIP) VALUES('$newCEmail', '$newAccPass', '$newCLastName', '$newCFirstName', 0)";
    
    $acctquery = mysqli_query($con,$createNewAcct) or die(mysqli_error($con));
    echo "Account creation successful!<br>";
    echo "<a href=\"customer_login.php\">Log in now?</a>";
    }
    
    include "disconnect.php";
?>
<html>
<head>
<meta http-equiv="refresh" content="0;url=customer_login.php"> 
</head>
</html>