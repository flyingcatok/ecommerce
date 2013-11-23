<!-- 
Author: Libby Ferland
Date: 11/2013
Last Edit: Feiyu Shi
Date: 11/23/2013
 -->
<HTML>
    <HEAD>
        <TITLE> Register Account </TITLE>
    </HEAD>
    <style>
	.error {color: #FF0000;}
	</style>
    <BODY>
        <div id="goBack" style="background-color:#FFFFFF;clear:both;text-align:right;">
        <a href="main.php">Go Back to Main Screen</a>
        </div>
        
        <div id ="registration_title" style ="background-color:#FFFFFF;clear:both;text-align:center;">
            <h2>Register New Account</h2><br><br>
        </div>
        <?php
        $fname_err = "";
        $lname_err = "";
        $email_err = "";
        $pass_err = "";
        $confirm_err = "";
        // validate entries
        if(isset($_POST["createAccBtn"])) {
        if(isset($_POST["firstName"])&&$_POST["firstName"]!="") {
            $newCFirstName = $_POST["firstName"];
            // check if name only contains letters and whitespace
     		if (!preg_match("/^[a-zA-Z ]*$/",$newCFirstName))
       		{
       		$fname_err = "Only letters and white space allowed"; 
       		}
        }else{
        	$fname_err = "First Name is required";
        	}
        if(isset($_POST["lastName"])&&$_POST["lastName"]!="") {
            $newCLastName = $_POST["lastName"];
            if (!preg_match("/^[a-zA-Z ]*$/",$newCLastName))
       		{
       		$lname_err = "Only letters and white space allowed"; 
       		}
        }else{
        	$lname_err = "Last Name is required";
        	}
        if(isset($_POST["newEmail"])&&$_POST["newEmail"]!="") {
            $newCEmail = $_POST["newEmail"];
            // check if e-mail address syntax is valid
     		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$newCEmail))
       		{
       		$email_err = "Invalid email format"; 
       		}
        }else{
        	$email_err = "Email is required";
        	}
        if (isset($_POST["newPass"])&&$_POST["newPass"]!="") {
            $newAccPass = $_POST["newPass"];
            if( strlen($newAccPass) < 4 ) {
				$pass_err .= "Password too short! ";
			}
			if( !preg_match("#[0-9]+#", $newAccPass) ) {
				$pass_err .= "Password must include at least one number! ";
			}
			if( !preg_match("#[a-z]+#", $newAccPass) ) {
				$pass_err .= "Password must include at least one letter! ";
			}
        }else{
        	$pass_err = "Password is required";
        	}
        
        if(isset($_POST["passConf"])&&$_POST["passConf"]!="") {
            $confirmedPass = $_POST["passConf"];
            if ($newAccPass != $confirmedPass) {
        		$confirm_err = "Password mismatch, please try again<br>";
//         		echo "<a href=\"customer_registration.php\">Go Back to Registration</a>";
    		}
        }else{
        	$confirm_err = "Type your password again";
        	}
    }
        
        ?>
        <div id="customer_info" style="background-color:#FFFFFF;clear:both;text-align:center;">
<!--             <form action="create_cust_account.php" method="POST"> -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <font color="red">*</font>First Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="firstName">
                <span class="error"> <?php echo $fname_err;?></span>
                <br><br>
                <font color="red">*</font>Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="lastName">
                <span class="error"> <?php echo $lname_err;?></span>
                <br><br>
                <font color="red">*</font>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="email" name="newEmail">
                <span class="error"><?php echo $email_err;?></span>
                <br><br>
                <font color="red">*</font>Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="password" name="newPass">
                <span class="error"> <?php echo $pass_err;?></span>
                <br><br>
                <font color="red">*</font>Confirm Password: <input type="password" name="passConf">
                <span class="error"> <?php echo $confirm_err;?></span>
                <br><br>
                <input type="submit" value="Create!" name="createAccBtn">
            </form>
            <?php include "create_cust_account.php";?>
        </div>
        
        <div id="hint" style="background-color:#FFFFFF;clear:both;text-align:center;">
            (Red asterisk indicates required field!)<br /><br/>
            <dl>
			<dt>Password requirement:</dt>
			<dd>- total length is at least 4 characters</dd>
			<dd>- at least one character is a letter or a number</dd>
			</dl>
			<br>
        </div >
        <div id="login" style="background-color:#FFFFFF;clear:both;text-align:center;">
        Already have an account? <a href="customer_login.php">Log into your account</a>.
        </div>
    </BODY>
        
</HTML>