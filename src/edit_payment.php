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
    $payEditEmail = $_SESSION['email'];
}
else {
    echo "too bad";
}
//delete selected address
if(isset($_POST["delete-button"])) {
    if(isset($_POST["card_to_change"])) {
        $selectedCard = $_POST["card_to_change"];
        $deleteThisCard = explode(',', $selectedCard);
   
    }
    
    $deleteCardNum = $deleteThisCard[1];
    $hiddenCard = 0;
    
    $deleteCardString = "UPDATE PaymentMethods SET IsVisible = 0 WHERE CardNo = '$deleteCardNum';";
    $deleteBillAddrString = "UPDATE BillingAddress SET IsVisible = 0 WHERE CardNo = '$deleteCardNum';";
    include "connect_local.php";
    
   
    mysqli_query($con, $deleteBillAddrString);
    mysqli_query($con, $deleteCardString);
    
    include "disconnect.php";
    Header('Location: my_payment.php');
}

 else if(isset($_POST["edit-button"])) {
        if(isset($_POST["card_to_change"])) {
            $selectedCard = $_POST["card_to_change"];
            $changeThisCard = explode(',', $selectedCard);
        }
        
        $cardNoChange = $changeThisCard[1];
        $lNameChange = $changeThisCard[2];
        $fNameChange = $changeThisCard[3];
        $eDateChange = $changeThisCard[4];
        $bLine1Change = $changeThisCard[5];
        $bLine2Change = $changeThisCard[6];
        $bCityChange = $changeThisCard[7];
        $bStateChange = $changeThisCard[8];
        $bZipChange = $changeThisCard[9];
        
        
         ?>
<HTML>
	<TITLE> Edit Payment Information </TITLE>
    <div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
    <div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
	<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
	</div>
    <HEADER><H3>Edit Payment Information</H3></HEADER>
    <br>
    <div id="card-edit-form" style ="background-color:#FFFFFF; clear:both; text-align:left">
        <form action ="update_payment.php" method ="POST">
            Card Number: &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; <input type="text" name="ccNum" title="Please enter a valid 15 or 16 digit card number"
                                                                  minlength="15" maxlength="16" pattern="[3-6]{1}[0-9]+"value=" <?php echo $cardNoChange; ?>" ><br>
            Card Holder First Name: &nbsp; &nbsp; <input type ="text" name="fName" minlength = "2"
                                                  maxlength = "30" pattern="([A-Za-z]+|([A-Za-z]+['][A-Za-z]+)+)"value ="<?php echo $fNameChange; ?>" ><br>
            Card Holder Last Name: &nbsp;&nbsp;&nbsp;<input type ="text" name="lName" minlength = "2" 
                                                       maxlength = "30" pattern="([A-Za-z]+|([A-Za-z]+['][A-Za-z]+)+)" value="<?php echo $lNameChange; ?>" ><br>
            Expiration Date (mmyy): &nbsp; <input type ="text" name ="eDate" title="Please enter the card expiration date (4 numbers, mmyy)" 
                                                  minlength = "4" maxlength="4" pattern="([0][1-9]|[1][0-2])([1][3-9]|[2][0-5])"value ="<?php echo $eDateChange; ?>" > <br><br>
            Billing Street Address&nbsp;&nbsp; <input type ="text" name ="bLine1" value ="<?php echo $bLine1Change; ?>" ><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type =" text" name="bLine2" value =" <?php echo $bLine2Change ?>" > <br>
            Billing City: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name ="bCity" value ="<?php echo $bCityChange; ?>" ><br>
            Billing State: &nbsp;&nbsp;&nbsp;&nbsp; <select name="changebstate">
                <option value ="<?php echo $bStateChange; ?>" ><?php echo $bStateChange ?> </option>
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
            Billing Zip: &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name ="bZip" minlength = "5" maxlength="5" 
                                                           title ="Please enter a valid 5 digit zip code" pattern = "[0-9]+" value ="<?php echo $bZipChange; ?>" > <br><br>
            <input type ="hidden" name="old-card" value="<?php echo $selectedCard ?>" >
            <input type="submit" name="confirm-edit" value="Submit Changes">
        </form>
    </div>
</HTML>
<?php
    } ?>