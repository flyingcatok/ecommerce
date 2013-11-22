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
        $bCityChange = $changeThisCard[6];
        $bStateChange = $changeThisCard[7];
        
        
         ?>
<HTML>
    <HEADER><H1>Edit Payment Information</H1></HEADER><br><br>
    <div id="card-edit-form" style ="background-color:#FFFFFF; clear:both; text-align:left">
        <form action ="update_payment.php" method ="POST">
            Card Number: &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; <input type="text" name="ccNum" value=" <?php echo $cardNoChange; ?>" ><br>
            Card Holder First Name: &nbsp; &nbsp; <input type ="text" name="fName" value ="<?php echo $fNameChange; ?>" ><br>
            Card Holder Last Name: &nbsp;&nbsp;&nbsp;<input type ="text" name="lName" value="<?php echo $lNameChange; ?>" ><br>
            Expiration Date (mmyy): &nbsp; <input type ="text" name ="eDate" value ="<?php echo $eDateChange; ?>" > <br><br>
            Billing Street Address&nbsp;&nbsp; <input type ="text" name ="bLine1" value ="<?php echo $bLine1Change; ?>" ><br>
            Billing City: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name ="bCity" value ="<?php echo $bCityChange; ?>" ><br>
            Billing State: &nbsp;&nbsp;&nbsp;&nbsp; <input type ="text" name="bState" value ="<?php echo $bStateChange; ?>" > <br><br>
            <input type ="hidden" name="old-card" value="<?php echo $selectedCard ?>" >
            <input type="submit" name="confirm-edit" value="Submit Changes">
        </form>
    </div>
</HTML>
<?php
    } ?>