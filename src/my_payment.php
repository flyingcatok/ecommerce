<?php
//Author: Libby Ferland
//Date: 11/22/2013
//Last Edit:
//Edit date:

   error_reporting(E_ALL);
   ini_set('display_errors', '1');
   ini_set('display_startup_errors','1');
   session_start();
    
    //find customer ID (email) from login info
    if(isset($_SESSION['email'])) {
        $billEmail = $_SESSION['email'];
    }
    else {
        echo "too bad";
    }
    $visibleCard = 1;
    $checkPayment = "SELECT COUNT(*) FROM PaymentMethods WHERE IsVisible = '$visibleCard' AND CEmail = '$billEmail';";
    $findPayment = "SELECT p.CardNo, p.CHolderLastName, p.CHolderFirstName, p.CExpirDate, b.Baddr1, b.BCity, b.BState
                     FROM PaymentMethods p, BillingAddress b WHERE p.IsVisible = '$visibleCard' AND b.IsVisible = '$visibleCard'
                     AND p.CEmail = '$billEmail' AND b.CEmail = '$billEmail' AND p.CardNo = b.CardNo;";
    
    include "connect_local.php";
    
    $isCardPresent = mysqli_query($con, $checkPayment);
    
    if ($isCardPresent->fetch_row() == 0) {
        echo ("You have not entered any payment information. <br>");
        echo ("Please enter a payment method <a href=\"add_card.php\">here</a><br>");
        include "disconnect.php";
    }
    else {
        $getPayment = mysqli_query($con, $findPayment);
        include "disconnect.php";
        $ccNums = array();
        $lNames = array();
        $fNames = array();
        $expyDates = array();
        $bALine1 = array();
        $bACity = array();
        $bAState = array();
        
        $a = 0;
        
        while ($trow = mysqli_fetch_array($getPayment)) {
            $ccNums[$a] = $trow["CardNo"];
            $lNames[$a] = $trow["CHolderLastName"];
            $fNames[$a] = $trow["CHolderFirstName"];
            $expyDates[$a] = $trow["CExpirDate"];
            $bALine1[$a] = $trow["Baddr1"];
            $bACity[$a] = $trow["BCity"];
            $bAState[$a] = $trow["BState"];
            $a++;
        }
        $numCards = $a;
          ?>

<HTML>
	<TITLE> My Payment Methods </TITLE>
    <div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
    <div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
	<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
	</div>
    <HEADER><H3>My Payment Information</H3></HEADER>
    <div id="cards" style ="background-color:#FFFFFF; clear:both; text-align:left" > 
  <?php
    for ($b = 0; $b < $numCards; $b++) {
        $thisCard = array("p",$ccNums[$b], $lNames[$b], $fNames[$b], $expyDates[$b], $bALine1[$b], $bACity[$b], $bAState[$b]);
        $thisCardString = implode(',', $thisCard);
        $displayCard = "...-**" . substr($ccNums[$b], -4, 4);
       ?>
       <form action ="edit_payment.php" method="POST"> 
           Card Number: <?php echo $displayCard ?> <br>
           Card Holder: <?php echo $fNames[$b] ?>  <?php echo $lNames[$b]?> <br>
           Expiration Date: <?php echo $expyDates[$b] ?> <br>
           <br>
           Billing Address <br>
           Street: <?php echo $bALine1[$b] ?> <br>
           City, State: <?php echo $bACity[$b] ?>, <?php echo $bAState[$b] ?> <br>
           <br>
        <input type="hidden" name="card_to_change" value="<?php echo $thisCardString ?>" >
        <input type ="submit" value = "Edit" name = "edit-button">
        &nbsp;&nbsp;&nbsp;
        <input type ="submit" value ="Delete" name="delete-button">
        <br><br>
        </form>
        <?php } ?>
        </div>
        
</HTML>
    <?php } ?>
        
    
    