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
        $newAddrEmail = $_SESSION['email'];
    }
    else {
        echo "too bad";
    }
    
    
    if(isset($_POST["addAddBtn"])) {
        if(isset($_POST["newl1"])) {
            $newLineOne = $_POST["newl1"];
        }
        else {
            $message = "You must enter a street address.";
        }
        if (isset($_POST["newl2"])) {
            $newLineTwo = $_POST["newl2"]; 
        }
        else {
            $newLineTwo = " ";
        }
        if (isset($_POST["newcity"])) {
            $newCity = $_POST["newcity"];
        }
        else {
            $message = "You must enter a city.";
        }
        if (isset($_POST["newstate"]) && ($_POST["newstate"] != "Default")) {
            $newState = $_POST["newstate"];
        }
        else {
            $message = "You must select a state.";
        }
        if (isset($_POST["zipc"]) && ($_POST["zipc"] != 0)) {
            $newZip = $_POST["zipc"];
        }
        else {
            $message = "You must select a zip code.";
        }
    }
    if (isset($message)) {
        echo $message;
        echo "<br>";
        echo "<a href = \"new_address.php\">Please enter your information again.</a>";
    }
    else {
        include "connect_local.php";
        $dupAddCheck = "SELECT COUNT(*) FROM AddressBook WHERE CEmail = '$newAddrEmail' AND AddrLine1 = '$newLineOne' AND AddrLine2 = '$newLineTwo' AND
            City = '$newCity' AND State = '$newState' AND Zip = '$newZip'";
        $newAddQuery = "INSERT INTO AddressBook(CEmail, AddrLine1, AddrLine2, City, State, Zip) VALUES('$newAddrEmail', '$newLineOne', '$newLineTwo',
            '$newCity', '$newState', '$newZip')";
        
        $isDupAdd = mysqli_query($con, $dupAddCheck);
        $dupAdd = $isDupAdd->fetch_row();
        
        if($dupAdd[0] != 0) {
            echo "This address is already associated with your account. <br>";
            echo "<a href=\"my_account.php\">Return to account home.</a>";
            include "disconnect.php";
        }
        else {
            mysqli_query($con, $newAddQuery);
            include "disconnect.php";
            Header('Location: my_address.php');
        }
    }
    
    ?>