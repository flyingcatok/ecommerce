<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_purchase_1 = "INSERT INTO Purchase (CEmail, InvoiceNo, PurchaseDate, PurchaseRating, REVIEW) VALUES ('john.smith@gmail.com','12367753','2013-11-7 21:25:24', '5','Great! I like it!');";


  if (mysqli_query($con, $add_purchase_1)) 
 {
  echo "Values of Purchase inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Purchase: " . mysqli_error($con)."<br>";
  }
?>