<!-- Created: Libby Ferland 
Date: 11/9/2013
Last Edit: Libby Ferland
Edit Date: 11/12/2013 -->
<HTML>
<HEAD>
<TITLE> Customer Login </TITLE>
</HEAD>

<BODY>
<div id="goBack" style="background-color:#FFFFFF;clear:both;text-align:right;">
<a href="main.php">Go Back to Main Screen</a>
</div>

<div id="login" style="background-color:#FFFFFF;clear:both;text-align:center;">
<H2> Enter Login Information </H2>
</div>
<div id="loginInfo" style="background-color:#FFFFFF;clear:both;text-align:center;">
<form action="account_home.php" method= "POST">
Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="Email"><br>
Password: <input type="password" name="Password"><br>
<input type="submit" value="Login!" name="loginBtn">
</form>
</div>

<div id="newuser" style="background-color:#FFFFFF;clear:both;text-align:center;">
Don't have an account? <a href="customer_registration.php">Create Account</a>.
</div>

</BODY>
</HTML>