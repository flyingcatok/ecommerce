<?php
//Author: Libby Ferland
//Date: 11/13/2013
//Last Edit: Libby Ferland
//Edit Date: 11/20/2013

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
    session_start();
    
    //find customer ID (email) from login info
    if(isset($_SESSION['email'])) {
        $addrEmail = $_SESSION['email'];
    }
    else {
        echo "too bad";
    }
    $checkAddr = "SELECT COUNT(*) FROM AddressBook WHERE CEmail = '$addrEmail'";
    $findShippingAddr = "SELECT * FROM AddressBook WHERE CEmail = '$addrEmail'";
    
    include "connect_local.php";
    
    $isAddressPresent = mysqli_query($con, $checkAddr);
    
    if($isAddressPresent->fetch_row() == 0) {
        echo "You have not entered a shipping address.<br>";
        echo "Please enter an address <a href=\"add_address.php\">here.</a>";
        include "disconnect.php";
    }
    else {
        $getShippingAddr = mysqli_query($con, $findShippingAddr);

        $lineOne = array();
        $lineTwo = array();
        $city = array();
        $state = array();
        $zip = array();
        $aIndex = array();

        $i = 0;
        while ($myAddr = mysqli_fetch_array($getShippingAddr)) {
            $aIndex[$i] = $myAddr["AddrIndex"];
            $lineOne[$i] = $myAddr["AddrLine1"];
            $lineTwo[$i] = $myAddr["AddrLine2"];
            $city[$i] = $myAddr["City"];
            $state[$i] = $myAddr["State"];
            $zip[$i] = $myAddr["Zip"];
            $i++;
        }
    
    
    include "disconnect.php";
    
    $numAddr = $i;
   ?>

<HTML>
    <HEADER><H1>My Shipping Information</H1></HEADER>
    <div id="addresses" style ="background-color:#FFFFFF; clear:both; text-align:left" > 
  <?php
    for ($j = 0; $j < $numAddr; $j++) {
        $thisAddr = array("c", $lineOne[$j], $lineTwo[$j], $city[$j], $state[$j], $zip[$j], $aIndex[$j]);
        $thisAddrString = implode(',', $thisAddr);
       ?>
       <form action ="edit_address.php" method="POST"> 
        Street Address: <?php echo $lineOne[$j] ?> <br> <?php echo $lineTwo[$j] ?> <br>
        City: <?php echo $city[$j] ?> <br>
        State: <?php echo $state[$j] ?> <br>
        Zip: <?php echo $zip[$j] ?> <br><br>
        <input type="hidden" name="address_to_change" value="<?php echo $thisAddrString ?>" >
        <input type ="submit" value = "Edit" name = "edit-button">
        &nbsp;&nbsp;&nbsp;
        <input type ="submit" value ="Delete" name="delete-button">
        <br><br>
        </form>
        <?php } ?>
        </div>
        
</HTML>
    <?php } ?>