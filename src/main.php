<?php
//Author: Feiyu Shi
//Date: 11/8/2013
//Last Edited: 
//Date:

include "search.php";
?>
<HTML>
<HEAD>
<TITLE> CS 405G Project </TITLE>
</HEAD>
<BODY>
<div id="login" style="background-color:#FFFFFF;clear:both;text-align:right;">  
<a href="customer_login.php">Login</a>
<a href="customer_registration.php">Register</a>
<a href="customer_basket.php">Basket</a>
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