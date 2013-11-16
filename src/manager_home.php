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
//         echo $homeEID;
    }
    
?>

<HTML>
    <HEAD>
    <TITLE> Manager Home </TITLE>
<!--     <meta http-equiv="refresh" content="60">  -->
    </HEAD>
    <div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="employee_home.php">Employee Home</a>
        <a href ="employee_logout.php">Logout</a>
    </div>
	<br />
	<br />
    <div id="stat">

    <h2>Sales Statistics</h2>
    <p>as of<?php  $today = date_create("",timezone_open("America/New_York")); echo " ".date_format($today,"Y-m-d H:i:s");?> </p>
    <hr />
    <p>View by date:</p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
	<input name="period" type="radio" value="Today" checked>Today's sales history<br />
	<input name="period" type="radio" value="LastWeek">Last 7 days' sales history<br />
	<input name="period" type="radio" value="LastMonth">Last 30 days' sales history<br />
	<input name="period" type="radio" value="LastYear">Last 365 days' sales history<br />

	<br><input type="submit" value="view">
	</form>
	<?php include "manager_statistics.php";?>
	<hr />
    </div>
    
    <div>
    <h2>Sales Promotion</h2>
    <p>as of<?php  $today = date_create("",timezone_open("America/New_York")); echo " ".date_format($today,"Y-m-d H:i:s");?> </p>
    <hr />
    <p>Current Promotions:</p>
    <?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
    // connect to server
	include "connect_local.php";
	$sqlpromo = "SELECT p.IId, i.IName, i.IPrice, p.PromoteRate, i.PromoPrice AS CurrPrice, p.PStartDate, p.PEndDate
					FROM Promote p,Item i
					WHERE p.IId = i.IId AND p.PEndDate >= CURDATE()";
	$querypromo = mysqli_query($con,$sqlpromo) or die(mysqli_error($con));
	$count = mysqli_num_rows($querypromo);
	if($count > 0){
		echo "<table border=1 width=1000>";
		echo "<tr><td>IID</td>";
		echo "<td>Item</td>";
		echo "<td>Unit Price</td>";
		echo "<td>Promotion Rate</td>";
		echo "<td>Current Price</td>";
		echo "<td>Starting Date</td>";
		echo "<td>Ending Date</td></tr>";
		while($row = mysqli_fetch_array($querypromo)){
	        $id = $row["IId"];
	        $name = $row["IName"];
		    $price = $row["IPrice"];
		    $rate = $row["PromoteRate"];
		    $currprice = $row["CurrPrice"];
		    $currprice = number_format($currprice, 2, '.', ',');
		    $startdate = $row["PStartDate"];
		    $enddate = $row["PEndDate"];
		    echo ("<tr><td>$id</td>");
			echo ("<td>$name</td>");
			echo ("<td>$price</td>");
			echo ("<td>$rate</td>");
			echo ("<td>$currprice</td>");
			echo ("<td>$startdate</td>");
			echo ("<td>$enddate</td></tr>");
            } // close while
        echo "</table>";
		} else {
			echo "<table>";
			echo "<tr><td>No Promotions.</td></tr>";	
			echo "</table>";
		}
    ?>
    <p>Give a Promotion:</p>
    </div>
    
</HTML>