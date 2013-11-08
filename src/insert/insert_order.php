<?php
//Author: Libby Ferland
//Date: 11/2/2013
//Last Edited: Feiyu Shi
//Date: 11/7/2013

//insert dummy value
$addOrder_1 = "INSERT INTO Orders (POrderID, Status) VALUES (12367753, 'Shipped');";


if (mysqli_query($con, $addOrder_1)) 
 {
  echo "Values of Orders inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Orders: " . mysqli_error($con)."<br>";
  }
?>