<?php
//Author: Libby Ferland
//Date: 11/22/2013
//Last Edit: Feiyu Shi
//Edit date: 11/24/2013

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
    $findPayment = "SELECT p.CardNo, p.CHolderLastName, p.CHolderFirstName, p.CExpirDate, a.AddrLine1, a.AddrLine2, a.City, a.State, a.Zip, b.AddrIndex
                     FROM PaymentMethods p, BillingAddress b, AddressBook a WHERE p.IsVisible = 1 AND b.IsVisible = 1
                     AND p.CEmail = '$billEmail' AND b.CEmail = '$billEmail' AND p.CardNo = b.CardNo AND b.AddrIndex = a.AddrIndex;";
    
    include "connect_local.php";
    
    $isCardPresent = mysqli_query($con, $checkPayment);
    
    if ($isCardPresent->fetch_row() == 0) {
        echo ("You have not entered any payment information. <br>");
        echo ("Please enter a payment method <a href=\"add_card.php\">here</a><br>");
        include "disconnect.php";
    }
    else {
        $getPayment = mysqli_query($con, $findPayment);
        if (!$getPayment) {
            echo "Error!" . mysqli_error($con) . "<br>";
        }
        include "disconnect.php";
        $ccNums = array();
        $lNames = array();
        $fNames = array();
        $expyDates = array();
        $bALine1 = array();
        $bALine2 = array();
        $bACity = array();
        $bAState = array();
        $bAZip = array();
        $bAIndex = array();
        
        $a = 0;
        
        while ($trow = mysqli_fetch_array($getPayment)) {
            $ccNums[$a] = $trow["CardNo"];
            $lNames[$a] = $trow["CHolderLastName"];
            $fNames[$a] = $trow["CHolderFirstName"];
            $expyDates[$a] = $trow["CExpirDate"];
            $bALine1[$a] = $trow["AddrLine1"];
            $bALine2[$a] = $trow["AddrLine2"];
            $bACity[$a] = $trow["City"];
            $bAState[$a] = $trow["State"];
            $bAZip[$a] = $trow["Zip"];
            $bAIndex[$a] = $trow["AddrIndex"];
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
        $thisCard = array("p",$ccNums[$b], $lNames[$b], $fNames[$b], $expyDates[$b], $bALine1[$b], $bALine2[$b], $bACity[$b], $bAState[$b], $bAZip[$b], $bAIndex[$b]);
        $thisCardString = implode(',', $thisCard);
        $displayCard = "...-**" . substr($ccNums[$b], -4, 4);
       ?>
       <form action ="edit_payment.php" method="POST"> 
       <table>
       	   <tr><td colspan="2"><h4>Card # <?php echo $b+1;?>:</h4></td></tr>
           <tr><td>Number:</td><td> <?php echo $displayCard ?> </td><tr>
           <tr><td>Card Holder: </td><td><?php echo $fNames[$b] ?>&nbsp;<?php echo $lNames[$b]?></td><tr>
           <tr><td>Exp. Date:</td><td> <?php echo $expyDates[$b] ?> </td><tr>
           <tr><td><br></td><td> <br></td><tr>
           <tr><td><h4>Billing Address:</h4> </td><td> <br></td><tr>
           <tr><td>Street:</td><td> <?php echo $bALine1[$b] ?> <br> <?php echo $bALine2[$b] ?></td><tr>
           <tr><td>City, State, Zip: </td><td><?php echo $bACity[$b] ?>, <?php echo $bAState[$b] ?> <br> <?php echo $bAZip[$b] ?> </td><tr>
           <tr><td><br></td><td><br></td></tr>
        <tr><td><input type="hidden" name="card_to_change" value="<?php echo $thisCardString ?>" >
        <input type ="submit" value = "Edit" name = "edit-button"></td>
<!--         &nbsp;&nbsp;&nbsp; -->
        <td><input type ="submit" value ="Delete" name="delete-button"></td></tr>
        </table>
        <br><br>
        </form>
        <?php } ?>
        <form action="new_payment_method.php">
            <input type="submit" value="Add New Payment Method">
        </form>
        
         <br><br><br>
        <a href="my_account.php">Return to account home.</a>
        </div>
        
</HTML>
    <?php } ?>
        
    
    