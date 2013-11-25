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
    $deleteAddrStr = "UPDATE AddressBook SET IsVisible = 0 WHERE CEmail = '$addrEditEmail' AND AddrIndex = '$indexDelete';";
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
            Line One: &nbsp; &nbsp; <input type="text" name="lineOne" minlength="4" maxlength="50" value=" <?php echo $lineOneChange; ?>" ><br>
            Line Two: &nbsp; &nbsp; <input type ="text" name="lineTwo" maxlength="50" value ="<?php echo $lineTwoChange; ?>" ><br>
            City: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type ="text" name="city" maxlength= "50" value="<?php echo $cityChange; ?>" ><br>
            State: &nbsp;&nbsp;&nbsp;&nbsp; <select name="state">
                <option value ="<?php echo $stateChange; ?>" ><?php echo $stateChange ?> </option>
                <option value="AL">Alabama</option>
                <option value = "AK">Alaska</option>
                <option value= "AZ">Arizona</option>
                <option value= "AR">Arkansas</option>
                <option value="CA">California</option>
                <option value ="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value= "DE">Delaware</option>
                <option value="FL">Florida</option>
                <option value ="GA">Georgia</option>
                <option value ="HI">Hawaii</option>
                <option value ="ID">Idaho</option>
                <option value = "IL">Illinois</option>
                <option value ="IN">Indiana</option>
                <option value = "IO">Iowa</option>
                <option value ="KS">Kansas</option>
                <option value ="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value ="ME">Maine</option>
                <option value = "MD">Maryland</option>
                <option value = "MA">Massachusetts</option>
                <option value ="MI">Michigan</option>
                <option value ="MN">Minnesota</option>
                <option value ="MS">Mississippi</option>
                <option value ="MO">Missouri</option>
                <option value ="MT">Montana</option>
                <option value ="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value ="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>
            <br>
            Zip: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name ="zip" minlength = "5" maxlength="5" 
                                                           title ="Please enter a valid 5 digit zip code" pattern = "[0-9]+" value ="<?php echo $zipChange; ?>" ><br><br>
            <input type ="hidden" name="old-address" value="<?php echo $selectedAddr?>" >
            <input type="submit" name="confirm-edit" value="Submit Changes">
        </form>
    </div>
</HTML>
<?php
    } ?>


