<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_promote_1 = "INSERT INTO Promote (EId, IId, PromoteRate,PStartDate,PEndDate) VALUES ('24','111','0.1','2013-11-5 00:00:00','2013-11-12 00:00:00');";


  if (mysqli_query($con, $add_promote_1)) 
 {
  echo "Values of Promote inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Promote: " . mysqli_error($con)."<br>";
  }
?>