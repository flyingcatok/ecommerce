<?php 
//Author: Libby Ferland
//Date: 11/23/2013
//Last Edit: Feiyu Shi
//Edit Date: 11/23/2013

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
    session_start();
    
    //find customer ID (email) from login info
    if(isset($_SESSION['email'])) {
        $newPayEmail = $_SESSION['email'];
    }
    else {
        echo "too bad";
    }
    
    $getAddsQuery = "SELECT AddrIndex, AddrLine1, AddrLine2, City, State, Zip FROM AddressBook WHERE CEmail = '$newPayEmail' AND IsVisible = 1;";
    
    include "connect_local.php";
    $payAddResults = mysqli_query($con, $getAddsQuery);
    
    include "disconnect.php";
    
    $payLine1 = array();
    $payLine2 = array();
    $payCity = array();
    $payState = array();
    $payZip = array();
    $payIn = array();
    
    $c = 0;
    
    while ($rrow = mysqli_fetch_array($payAddResults)) {
      $payIn[$c] = $rrow["AddrIndex"];
      $payLine1[$c] = $rrow["AddrLine1"];
      $payLine2[$c] = $rrow["AddrLine2"];
      $payCity[$c] = $rrow["City"];
      $payState[$c] = $rrow["State"];
      $payZip[$c] = $rrow["Zip"];
      $c++;
    }
    
    $numPayAdds = $c;
?> 

<HTML>
	<div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
    <div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
	<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
	</div>
    <BODY>
    <div id ="new-pay-header" style ="background-color:#FFFFFF; clear:both; text-align:center">
    <HEADER><TITLE>New Payment Method</TITLE></HEADER>
    <H3>Enter a New Payment Method</H3>
    </div>
    <div id ="new-pay-form" style ="background-color:#FFFFFF; clear:both; text-align:center">
        <form action="add_payment.php" method="POST">
            <h4> Card Information</h4>
            Card Number: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" title="Please enter a valid 15 or 16 digit card number" 
                                            name="newcard" minlength="15" maxlength="16" pattern="[3-6]{1}[0-9]+"> <br>
            Expiration Date (mmyy): &nbsp; <input type ="text" name ="newedate" title="Please enter the card expiration date (4 numbers, mmyy)" 
                                                  minlength = "4" maxlength="4" pattern="([0][1-9]|[1][0-2])([1][3-9]|[2][0-5])"><br>
            Card Holder First Name: &nbsp; <input type="text" name ="newchfirst" minlength = "2"
                                                  maxlength = "30" pattern="([A-Za-z]+|([A-Za-z]+['][A-Za-z]+)+)"><br>
            Card Holder Last Name: &nbsp; &nbsp;<input type="text" name="newchlast" minlength = "2" 
                                                       maxlength = "30" pattern="([A-Za-z]+|([A-Za-z]+['][A-Za-z]+)+)"><br>
            <br>
            <h4> Select a Billing Address</h4>
            <?php 
            for ($e = 0; $e < $numPayAdds; $e++) {
            $thisPayAdd = array("f", $payLine1[$e], $payLine2[$e], $payCity[$e], $payState[$e], $payZip[$e], $payIn[$e]);
         /*   echo ("What is going on here? Here's line one: $thisPayAdd[1] <br>");
            echo("Here's line two: $thisPayAdd[2]<br>");
            echo ("Here's the city: $thisPayAdd[3]<br>");
            echo ("Here's the state: $thisPayAdd[4] <br> ");
            echo ("Here's the zip: $thisPayAdd[5] <br>");
            echo ("Here's the index: $thisPayAdd[6] <br>"); */
            $thisSelection = implode(',', $thisPayAdd);
            ?>
            <b>Address <?php echo $e+1; ?> </b><br><br>
            <?php echo $payLine1[$e]; ?> <br>
            <?php if ($payLine2[$e] != NULL) { echo $payLine2[$e]; } ?> <br>
            <?php echo $payCity[$e] ?>, <?php echo $payState[$e] ?> &nbsp; <?php echo $payZip[$e] ?> <br><br>
            <input type ="radio" name="pay-select-add" value ="<?php echo $thisSelection; ?>" > Select this address <br><br><br>
            <?php } ?>
            
            
            <b>Don't See Your Address? Enter a New One</b><br><br>
            Line 1: <input type="text" name="newbill1" minlength ="4" maxlength="50"><br>
            Line 2: <input type="text" name="newbill2" maxlength="50"><br>
            City: &nbsp;&nbsp;&nbsp;<input type="text" name="newbcity" maxlength="50"><br>
            
            
            State:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	<select name="newbstate">
                <option value ="Default">Select your state</option>
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
            Zip:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="bzipc" minlength = "5" maxlength="5" 
                                                           title ="Please enter a valid 5 digit zip code" pattern = "[0-9]+"> <br>
            <input type="submit" name="addPayBtn" value ="Add Payment Method">
        </form>
    </div> 
    
    </BODY>
</HTML>

