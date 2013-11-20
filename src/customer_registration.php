<HTML>
    <HEAD>
        <TITLE> Register Account </TITLE>
    </HEAD>
    
    <BODY>
        <div id="goBack" style="background-color:#FFFFFF;clear:both;text-align:right;">
        <a href="main.php">Go Back to Main Screen</a>
        </div>
        
        <div id ="registration_title" style ="background-color:#FFFFFF;clear:both;text-align:center;">
            <h2>Register New Account</h2><br><br>
        </div>
        
        <div id="customer_info" style="background-color:#FFFFFF;clear:both;text-align:center;">
            <form action="create_cust_account.php" method="POST">
                <font color="red">*</font>First Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="firstName"><br>
                <font color="red">*</font>Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="lastName"><br>
                <font color="red">*</font>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="newEmail"><br>
                <font color="red">*</font>Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="password" name="newPass"><br>
                <font color="red">*</font>Confirm Password: <input type="password" name="passConf"><br /><br />
                <input type="submit" value="Create!" name="createAccBtn">
            </form>
        </div>
        
        <div id="hint" style="background-color:#FFFFFF;clear:both;text-align:center;">
            (Red asterisk indicates required field!)<br />
        </div >
        <div id="login" style="background-color:#FFFFFF;clear:both;text-align:center;">
        Already have an account? <a href="customer_login.php">Log into your account</a>.
        </div>
    </BODY>
        
</HTML>