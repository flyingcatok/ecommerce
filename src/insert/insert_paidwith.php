<?php
//Author: Feiyu Shi
//Date: 11/19/2013

$add_paidwith_1 = "INSERT INTO PaidWith (OrderID, CEmail,CardNo) VALUES ('12367753','john.smith@gmail.com','379787674561223');";


  if (mysqli_query($con, $add_paidwith_1)) 
 {
  echo "Values of PaidWith inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to PaidWith: " . mysqli_error($con)."<br>";
  }
?>