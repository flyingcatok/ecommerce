<?php
//Author: Feiyu Shi
//Date: 11/8/2013
//Last Edited: Feiyu Shi
//Date: 11/15/2013

//include "search.php";
session_start();
if(isset($_SESSION['email'])) {
    $loggedin = true;
}
else {
    $loggedin = false;
}

if(isset($_SESSION['empID'])) {
    $empIsIn = true;
}
else {
    $empIsIn = false;
}
?>
<HTML>
<HEAD>
<TITLE> F&L Gift Store Home </TITLE>
</HEAD>
<BODY>
    
<!--div format testing-->
<!--<div id="login" class="line" style="background-color:#FFFFFF;clear:both;text-align:right;">  
<span class="right"><a href="customer_login.php">Login</a>
<a href="customer_registration.php">Register</a>
<a href="customer_basket.php">Basket</a></span>
    <span class="left"><a href="employee_login.php">Employee Login</a></span>
</div>-->

<div id="login_wrapper">
    <?php
        if ($empIsIn == false) {
            ?>
<div id="employee_login" style="float: left; background-color: #ffffff;">
    <a href="employee_login.php">Employee Login</a>
</div>
        <?php }
        else { ?>
    <div id="employee_options" style="float: left; background-color: #ffffff;">
        <a href="employee_home.php">Employee Control Panel</a>
        <a href="employee_logout.php">Log Out</a>
    </div>
        <?php }
        if ($loggedin == false) {
        ?>
<div id="customer_login" style="float: right; background-color: #ffffff;">
    <a href="customer_login.php">Login</a>
    <a href="customer_registration.php">Register</a>
</div>
    <?php }
    else {
        ?>
    <div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
    <?php }
    ?>
</div>


<div id="header" style="background-color:#FFFFFF;clear:both;text-align:center;">
<H1> <a href="main.php" style="text-decoration: none">F&L Gift Store</a></H1>
</div>

<div id="searchBox" style="background-color:#FFFFFF;clear:both;text-align:center;">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
<input name="searchquery" type="text" size = "60" maxlength = "80">
<input name = "myBtn" type = "submit" value = "GO!">
</form>
<?php include "search.php";?>
</div>
<br />
<div id="view by category" style="background-color:#FFFFFF;clear:both;text-align:left;">
<h3>View items by category</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
<input name="category" type="radio" value="all" checked>All<br />
<input name="category" type="radio" value="Games">Games<br />
<input name="category" type="radio" value="Toys">Toys
<br><input type="submit" value="view">
</form>
<?php include "view_item_by_category.php";?>
</div>

</BODY>
</HTML>