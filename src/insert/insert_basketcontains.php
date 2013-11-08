<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_basketcontains_1 = "INSERT INTO BasketContains (CEmail, BaskId, IId, BQuantity) VALUES ('john.smith@gmail.com','100001','111','2');";


if (mysqli_query($con, $add_basketcontains_1)) 
 {
  echo "Values of BasketContains inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to BasketContains: " . mysqli_error($con)."<br>";
  }
?>