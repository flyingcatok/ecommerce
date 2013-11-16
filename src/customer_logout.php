<?php
//Author: Libby Ferland
//Date: 11/12/2013
//Last Edited: Feiyu Shi
//Edit Date: 11/16/2013
    session_start();
    session_unset();
    session_destroy();
    if(isset($_SESSION['email'])) {
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