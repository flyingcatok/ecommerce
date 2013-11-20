<?php
//Author: Feiyu Shi
//Date: 11/19/2013
//Last Edit: 
//Date: 

$add_shippedby_1 = "INSERT INTO ShippedBy (OrderID, ShipMethod) VALUES ('12367753','Two-Day Express');";


  if (mysqli_query($con, $add_shippedby_1)) 
 {
  echo "Values of ShippedBy inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to ShippedBy: " . mysqli_error($con)."<br>";
  }
  
$add_shippedby_2 = "INSERT INTO ShippedBy (OrderID, ShipMethod) VALUES ('12367755','Regular');";


  if (mysqli_query($con, $add_shippedby_2)) 
 {
  echo "Values of ShippedBy inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to ShippedBy: " . mysqli_error($con)."<br>";
  }

?>