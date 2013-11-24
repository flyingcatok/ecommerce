<?php 
//Author: Libby Ferland
//Date: 11/12/2013
//Last Edited: Feiyu Shi	
//Edit Date: 11/23/2013

    if(isset($_POST["createAccBtn"])&&$fname_err==""&&$lname_err==""&&$email_err==""&&$pass_err==""&&$confirm_err=="") {
            $newCFirstName = $_POST["firstName"];
            $newCLastName = $_POST["lastName"];
            $newCEmail = $_POST["newEmail"];
            $newAccPass = $_POST["newPass"];
            $confirmedPass = $_POST["passConf"];
    //check and make sure account isn't already registered
    include "connect_local.php";
    $findDupAcct = "SELECT COUNT(*) FROM Customer WHERE Email = '$newCEmail'";
    
    $getDupAcct = mysqli_query($con, $findDupAcct);
    
    $dupAcctResult = $getDupAcct->fetch_row();
    if ($dupAcctResult[0] > 0) {
        echo "There is already an account associated with this email address.&nbsp&nbsp <a href=\"customer_login.php\">Log in now?</a>";
    }
    else {
    // create customer info
    $createNewAcct = "INSERT INTO Customer(Email, Password, LName, FName, IsVIP) VALUES('$newCEmail', '$newAccPass', '$newCLastName', '$newCFirstName', 0)";
    
    $acctquery = mysqli_query($con,$createNewAcct) or die(mysqli_error($con));
    // assign a basket id to this customer
    $assignbskid = "INSERT INTO Basket(CEmail) VALUES('$newCEmail')";
    $bskid = mysqli_query($con,$assignbskid) or die(mysqli_error($con));
    include "disconnect.php";
    echo "<br>Account creation successful!<br><br>Page will be directed to Login page in 3 seconds...";
//     echo "<a href=\"customer_login.php\">Log in now?</a>";
	echo "<meta http-equiv='refresh' content='3;url=customer_login.php'>";

    }

    }
?>