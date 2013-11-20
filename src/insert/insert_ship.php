<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_ship_1 = "INSERT INTO Ship (EId, OrderID,ShipDate) VALUES ('33','12367753','2013-11-8 11:32:56');";


  if (mysqli_query($con, $add_ship_1)) 
 {
  echo "Values of Ship inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Ship: " . mysqli_error($con)."<br>";
  }
?>