<?php
//Author: Libby Ferland
//Date: 11/20/2013
//Last Edit:
//Edit Date:

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors','1');
session_start();
    
    //find customer ID (email) from login info
if(isset($_SESSION['email'])) {
    $addrEditEmail = $_SESSION['email'];
}
else {
    echo "too bad";
}
//delete selected address
if(isset($_POST["delete-button"])) {
    if(isset($_POST["address_to_change"])) {
        $selectedAddr = $_POST["address_to_change"];
        $deleteThisAddr = explode(',', $selectedAddr);
    }
    $lineOneDelete = $deleteThisAddr[1];
    $lineTwoDelete = $deleteThisAddr[2];
    $cityDelete = $deleteThisAddr[3];
    $stateDelete = $deleteThisAddr[4];
    $zipDelete = $deleteThisAddr[5];
    $indexDelete = $deleteThisAddr[6];
    $deleteAddrStr = "DELETE FROM AddressBook WHERE CEmail = '$addrEditEmail' AND AddrIndex = '$indexDelete';";
    include "connect_local.php";
    mysqli_query($con, $deleteAddrStr);
    include "disconnect.php";
    Header('Location: my_address.php');
    
    
        
    }
    
    else if(isset($_POST["edit-button"])) {
        if(isset($_POST["address_to_change"])) {
            $selectedAddr = $_POST["address_to_change"];
            $changeThisAddr = explode(',', $selectedAddr);
        }
        $lineOneChange = $changeThisAddr[1];
        $lineTwoChange = $changeThisAddr[2];
        $cityChange = $changeThisAddr[3];
        $stateChange = $changeThisAddr[4];
        $zipChange = $changeThisAddr[5];
        $indexChange = $changeThisAddr[6];
        ?>
<HTML>
<TITLE> Edit Address </TITLE>
    <div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
    <div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
	<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
	</div>
    <HEADER><H3>Edit Address</H3></HEADER>
	<br>
    <div id="address-edit-form" style ="background-color:#FFFFFF; clear:both; text-align:left">
        <form action ="update_address.php" method ="POST">
            Line One: &nbsp; &nbsp; <input type="text" name="lineOne" value=" <?php echo $lineOneChange; ?>" ><br>
            Line Two: &nbsp; &nbsp; <input type ="text" name="lineTwo" value ="<?php echo $lineTwoChange; ?>" ><br>
            City: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type ="text" name="city" value="<?php echo $cityChange; ?>" ><br>
            State: &nbsp;&nbsp;&nbsp;&nbsp; <input type ="text" name ="state" value ="<?php echo $stateChange; ?>" ><br>
            Zip: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name ="zip" value ="<?php echo $zipChange; ?>" ><br><br>
            <input type ="hidden" name="old-address" value="<?php echo $selectedAddr?>" >
            <input type="submit" name="confirm-edit" value="Submit Changes">
        </form>
    </div>
</HTML>
<?php
    } ?>


