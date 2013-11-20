<?php
//Author: Libby Ferland
//Date: 11/13/2013
//Last Edit: Feiyu Shi
//Edit Date: 11/19/2013

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
    session_start();
    
    if(isset($_SESSION['empID'])) {
        $homeEID = $_SESSION['empID'];
    }
    
    include "connect_local.php";
    
    $findEmployee = "SELECT * FROM Employee WHERE EId = '$homeEID'";
    
    $getEmployee = mysqli_query($con, $findEmployee);
    
    $employeeInfo = $getEmployee->fetch_row();
    
    $empFirst = $employeeInfo[3];
    $empPrivileges = $employeeInfo[4];
    
    include "disconnect.php";
?>

<HTML>
    <HEADER>
    <TITLE> Employee Home </TITLE>
    </HEADER>
    <div id="account_header" style="background-color:#FFFFFF;clear:both;text-align:left;">
        <h3>Welcome back, <?php echo $empFirst ?>! </h3>    
    </div>
    <div id ="navigation" style ="background-color: #FFFFFF; clear:both;height:300px;width:300px;float:left">
        <b>Employee Functions</b><br>
        <a href ="employee_order_processing.php">Process Pending Orders</a><br>
        <a href ="manage_inventory.php">Manage Inventory</a><br>
        <a href="main.php">Go To Store Main</a><br><br>
    <?php
        if ($empPrivileges == 1) {
    ?>
    	<b>Manager Functions</b><br>
        <a href="manager_home.php">Manager Control Panel</a><br>
    <?php       }
        ?>
    </div>
    
    <div id="logoff" style="background-color:#FFFFFF; clear:both;text-align:left">
        <a href ="employee_logout.php">Logout</a>
    </div>
    
</HTML>