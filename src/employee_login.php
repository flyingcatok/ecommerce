<HTML> 
    <HEAD>
        <TITLE>F & L Gift Store Employee Login</TITLE>
    </HEAD>
    <BODY>
        <div id="goBack" style="background-color:#FFFFFF;clear:both;text-align:right;">
        <a href="main.php">Go Back to Main Screen</a>
        </div>
        
        <div id="login" style="background-color:#FFFFFF;clear:both;text-align:center;">
        <H2> Enter Login Information </H2>
        </div>
        
        <div id="emp_loginform" style="background-color:#FFFFFF; clear:both; text-align:center;">
            <form action="emp_login_check.php" method="POST">
                Employee ID: <input type="text" name="empID"><br>
                Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="password" name="empPass"><br>
                <input type="submit" value="Login!" name="empLogBtn">
            </form>
        </div>
    </BODY>
</HTML>



