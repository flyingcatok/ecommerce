<?php

//Author: Libby Ferland
//Date: 11/10/2013
//Last Edit: Libby Ferland  
//Edit Date:11/13/2013
    
    include "connect_local.php";
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    session_start();
    $_SESSION['empID'] = $_POST["empID"];
    
    
        if(isset($_POST["empLogBtn"])) {
        if(isset($_POST["empID"])) {
            $empID = $_POST["empID"];
        }
        if(isset($_POST["empPass"])) {
            $epass = $_POST["empPass"];
        }
    }
    
    $findEmployee = "SELECT COUNT(*) FROM Employee WHERE EId='$empID' AND EPassword='$epass'";
    $getEmployeeInfo = mysqli_query($con, $findEmployee);
    
    $employeeInfoResult = $getEmployeeInfo->fetch_row();
    
    if($employeeInfoResult[0] ==1 ) {
        header('Location: employee_home.php');
    }
    else {
        echo "Invalid ID or password!";
    ?>
    <br><br><a href="employee_login.php">Return to Login</a>
    <?php }
    
    include "disconnect.php";
    
    ?>