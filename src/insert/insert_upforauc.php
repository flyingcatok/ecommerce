<?php
//Author: Feiyu Shi
//Date: 11/7/2013
//Last Edited: 
//Last Edit Date:

$add_upforauc_1 = "INSERT INTO UpForAuc(StoreID,AucID, IId,StartTime,EndTime) VALUES ('0001','1001','201','2013-11-8 00:00:00','2013-11-10 18:00:00')";


  if (mysqli_query($con, $add_upforauc_1)) 
 {
  echo "Values of UpForAuc inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to UpForAuc: " . mysqli_error($con)."<br>";
  }
?>