<?php
//Author: Libby Ferland
//Date: 11/13/2013
//Last Edited:
//Edit Date:
    session_start();
    session_unset();
    session_destroy();
    if(isset($_SESSION['empID'])) {
        echo "Error logging out!";
    }

    else {
            echo "Logout successful<br>";
        echo "<a href=\"main.php\">Go back to main</a>";
    }
    
    ?>
<html>
<head>
<meta http-equiv="refresh" content="0;url=main.php"> 
</head>
</html>