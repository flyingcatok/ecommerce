<?php
//Author: Libby Ferland
//Date: 11/12/2013
//Last Edited:
//Edit Date:
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