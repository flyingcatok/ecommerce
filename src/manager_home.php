<?php
//Author: Feiyu Shi
//Date: 11/16/2013
//Last Edit:
//Edit Date:

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
    session_start();
    
    if(isset($_SESSION['empID'])) {
        $homeEID = $_SESSION['empID'];
        echo $homeEID;
    }
    
?>

<HTML>
    <HEAD>
    <TITLE> Manager Home </TITLE>
<!--     <meta http-equiv="refresh" content="60">  -->
    </HEAD>
    <div>
    <h2>Sales Statistics</h2>
    <p>as of<?php  $today = date('Y-m-d H:i:s'); echo " ".$today;?> </p>
    <hr />
    <p>View by date:</p>
    <br />
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
	<input name="Today" type="radio" value="Today">Today's sales history<br />
	<input name="LastWeek" type="radio" value="LastWeek">Last 7 days' sales history<br />
	<input name="LastMonth" type="radio" value="LastMonth">Last 30 days' sales history<br />
	<input name="LastYear" type="radio" value="LastYear">Last 365 days' sales history<br />

	<br><input type="submit" value="view">
	</form>
	<?php include "manager_statistics.php";?>
	<hr />
    </div>
    
</HTML>