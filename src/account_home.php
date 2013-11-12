<?php
 //Author: Libby Ferland
//Date: 11/9/2013
//Last Edited: Libby Ferland
//Last Edit Date: 11/9/2013
    
    include "connect_local.php";
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    session_start();
    $_SESSION['email'] = $_POST["Email"];
    
    //get variables from text input
    
    if(isset($_POST["loginBtn"])) {
        if(isset($_POST["Email"])) {
            $email = $_POST["Email"];
        }
        if(isset($_POST["Password"])) {
            $pass = $_POST["Password"];
        }
    }
    
   // $email = $_POST['Email'];
   // $pass = $_POST['Password'];
    //$login = $_GET['loginBtn'];
    
        //query string and database connection
        $findCustomer = "SELECT COUNT(*) FROM Customer WHERE Email='$email' AND Password='$pass'";
        
        
        $getCustomerInfo = mysqli_query($con, $findCustomer);
        $customerInfoResult = $getCustomerInfo->fetch_row();
        
    
       // $resultCustomerInfo = mysqli_result($getCustomerInfo, 0);
    
        if ($customerInfoResult[0] ==1) {
            Header('Location: my_account.php');
        }
        else {
            
            ?>
<HTML>
    Invalid email or password. <br>
    <br><br><a href="customer_login.php">Return to login page</a><br>
    <a href="customer_registration.php">Create new account</a><br>
</HTML>
            <!--echo "Invalid email or password";
            //echo "<HTML>";
            //echo "<br><br><a href=\"customer_login.php\">Return to login page</a><br>";
            //echo "<a href=\"customer_registration.php\">Create new account</a><br>"; -->
    
    <?php }
        
        include "disconnect.php";
    
    
?>