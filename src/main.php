<?php
//Author: Feiyu Shi
//Date: 11/8/2013
//Last Edited: Libby Ferland
//Date: 11/10/2013

include "search.php";
?>
<HTML>
<HEAD>
<TITLE> CS 405G Project </TITLE>
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
<div id="employee_login" style="float: left; background-color: #ffffff;">
    <a href="employee_login.php">Employee Login</a>
</div>
<div id="customer_login" style="float: right; background-color: #ffffff;">
    <a href="customer_login.php">Login</a>
    <a href="customer_registration.php">Register</a>
    <a href="customer_basket.php">Basket</a>
</div>
</div>


<div id="header" style="background-color:#FFFFFF;clear:both;text-align:center;">
<H1> F&L Gift Store </H1>
</div>

<div id="searchBox" style="background-color:#FFFFFF;clear:both;text-align:center;">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
Search <input name="searchquery" type="text" size = "60" maxlength = "80">
<input name = "myBtn" type = "submit" value = "GO!">
</form>
</div>

<div id="searchResult" style="background-color:#FFFFFF;clear:both;text-align:left;">
<?php echo $search_output;
//output results in text?>
</div>
</BODY>
</HTML>