<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_ordercontains_1 = "INSERT INTO OrderContains (COrderID, IId, OQuantity) VALUES ('12367753','201','1');";


if (mysqli_query($con, $add_ordercontains_1)) 
 {
  echo "Values of OrderContains inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to OrderContains: " . mysqli_error($con)."<br>";
  }
?>