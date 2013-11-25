<?php
//Author: Feiyu Shi
//Date: 11/16/2013
//Last Edit: Feiyu Shi
//Edit Date: 11/24/2013

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
    session_start();
    
    if(isset($_SESSION['empID'])) {
        $manaEID = $_SESSION['empID'];
//         echo $homeEID;
    
    include "connect_local.php";
    
    $findEmployee = "SELECT * FROM Employee WHERE EId = '$manaEID'";
    
    $getEmployee = mysqli_query($con, $findEmployee);
    
    $employeeInfo = $getEmployee->fetch_row();
    
    $empFirst = $employeeInfo[3];
    $empPrivileges = $employeeInfo[4];
    
    include "disconnect.php";
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
   <?php if(isset($_SESSION['empID'])&&$empPrivileges==1){?>
    <p>View by date:</p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
	<input name="period" type="radio" value="Today">Today's sales history<br />
	<input name="period" type="radio" value="LastWeek">Last 7 days' sales history<br />
	<input name="period" type="radio" value="LastMonth">Last 30 days' sales history<br />
	<input name="period" type="radio" value="LastYear">Last 365 days' sales history<br />

	<br><input type="submit" value="view">
	</form>
	<?php include "manager_statistics.php";?>
	<hr />
	<?php }?>
    </div>
    
    <div>
    <h2>Sales Promotion</h2>
    <p>Log in everyday to update the prices for promoted items</p>
    <p>as of<?php  $today = date_create("",timezone_open("America/New_York")); echo " ".date_format($today,"Y-m-d H:i:s");?> </p>
    <hr />
    <h4>Current Promotions:</h4>
    <?php if(isset($_SESSION['empID'])&&$empPrivileges==1){?>
    <div>
    <?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors','1');
    // connect to server
	include "connect_local.php";
	//update new promotion rate
	// if(isset($_POST['IID'])&&isset($_POST['promorate'])&& $_POST['promorate']!=""&&$_POST['promorate']>0&&$_POST['promorate']<100&&is_numeric($_POST['promorate'])){
// 		$promorate = $_POST['promorate']*0.01;
// 		$iid = $_POST['IID'];
// 		$sqlrate = "UPDATE Promote SET PromoteRate = $promorate WHERE IId = $iid";
// 		$rateupdate = mysqli_query($con,$sqlrate) or die(mysqli_error($con));
// 		//update the item promo price
// 		$sqlupdate = "UPDATE Item i, Promote p
// 					SET i.PromoPrice = i.IPrice * (1-$promorate)
// 					WHERE p.IId = i.IId AND p.IId = $iid AND p.PStartDate <= CURDATE()";
// 		$queryupdate = mysqli_query($con,$sqlupdate) or die(mysqli_error($con));
// 	}
	//extend a promotion
	// function checkDateTime($data) {
//     if (date('Y-m-d', strtotime($data)) == $data) {
//         return true;
//     } else {
//         return false;
//     	}
// 	}
// 	if(isset($_POST['extentionbutton'])&&isset($_POST['IID'])&&isset($_POST['extention'])&& $_POST['extention']!=""){
// 		$endingdate = $_POST['extention'];
// 		$iid = $_POST['IID'];
// 		$sqldate = "UPDATE Promote SET PEndDate = $endingdate WHERE IId = $iid";
// 		$dateupdate = mysqli_query($con,$sqldate) or die(mysqli_error($con));
// 	}
	// delete this promotion
	if(isset($_POST['IID'])&&isset($_POST['removepromo'])){
		$selectedid = mysqli_real_escape_string($con,$_POST['IID']);
		//update item price
		$sqlupdate3 = "UPDATE Item
					SET PromoPrice = NULL
					WHERE IId =$selectedid";
		$queryupdate3 = mysqli_query($con,$sqlupdate3) or die(mysqli_error($con));
		//delete promotion
		$sqldelete = "DELETE FROM Promote
					WHERE IId=$selectedid;";
		$deletequery = mysqli_query($con,$sqldelete) or die(mysqli_error($con));
			
	}

	// set the promotion price when the promotion start date is today or update promo rate when the 'set' is clicked and it's already on sale
	
	$sqlupdate = "UPDATE Item i, Promote p
					SET i.PromoPrice = i.IPrice * (1-p.PromoteRate)
					WHERE p.IId = i.IId AND p.PStartDate = CURDATE()";
	$queryupdate = mysqli_query($con,$sqlupdate) or die(mysqli_error($con));
	
	// delete the promotion that expired yestoday and update the item price
	$sqlupdate2 = "UPDATE Item
					SET PromoPrice = NULL
					WHERE IId IN (SELECT IId FROM Promote WHERE PEndDate < CURDATE());";
	$queryupdate2 = mysqli_query($con,$sqlupdate2) or die(mysqli_error($con));
	
	$sqldelete = "DELETE FROM Promote
 					WHERE PEndDate < CURDATE();";
	$querydelete = mysqli_query($con,$sqldelete) or die(mysqli_error($con));
	
	
	// display current promotion
	$sqlpromo = "SELECT p.IId, i.IName, i.IPrice, p.PromoteRate, i.PromoPrice AS CurrPrice, p.PStartDate, p.PEndDate
					FROM Promote p,Item i
					WHERE p.IId = i.IId AND p.PEndDate >= CURDATE()
					ORDER BY p.PStartDate";
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
		echo "<td>Ending Date</td>";
// 		echo "<td>Extend?</td>";
		echo "<td>Remove?</td></tr>";
		while($row = mysqli_fetch_array($querypromo)){
	        $id = $row["IId"];
	        $name = $row["IName"];
		    $price = $row["IPrice"];
		    $rate = $row["PromoteRate"]*100;
		    $currprice = $row["CurrPrice"];
		    if(!is_null($currprice)){
		    	$currprice = number_format($currprice, 2, '.', ',');
		    }
		    $startdate = $row["PStartDate"];
		    $enddate = $row["PEndDate"];
		    echo ("<tr><td>$id</td>");
			echo ("<td>$name</td>");
			echo ("<td>$price</td>");
			echo ("<td>$rate% off</td>");?>
			<!-- 
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
			<?php echo "<td><input type='text' name=promorate value = $rate size = '3'>% off" ?>
			<?php echo "<input type ='hidden' name=IID value = $id>";?>
			<input type="submit" value="set"></td>
			</form>
 -->
			<?php
			echo ("<td>$currprice</td>");
			echo ("<td>$startdate</td>");
			echo ("<td>$enddate</td>");?>
<!-- 			extension -->
<!-- 			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post"> -->
 			<?php //echo "<td><input type='datetime' name=extention value = $enddate size = '20'></td>" ?>
			<?php //echo "<input type ='hidden' name=IID value = $id>";?>
<!-- 			<td><input type="submit" name = "extentionbutton" value="extend"></td> -->
<!-- 			</form> -->
<!-- 			remove -->
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
			<td>
			<?php echo "<input type ='hidden' name=IID value = $id>";?>
			<input type="submit" name = "removepromo" value="remove">
			</td></tr>
			</form>
			<?php
            } // close while
        echo "</table>";
		} else {
			echo "<table>";
			echo "<tr><td>No Promotions.</td></tr>";	
			echo "</table>";
		}
    ?>
    </div>
    <h4>Promote an item:</h4>
    <div>
    <p>Search for an item to promote:</p>
    <div id="searchBox" style="background-color:#FFFFFF;clear:both;text-align:left;">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
	<input name="searchquery" type="text" size = "60" maxlength = "80">
	<input name = "myBtn" type = "submit" value = "GO!">
	</form>
	<?php 
	include "search_for_promotion.php";
	?>
	</div>

    </div>
    </div>
    <?php }?>
</HTML>