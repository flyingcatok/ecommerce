<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_payment_1 = "INSERT INTO PaymentMethods (CEmail, CardNo, CHolderLastName, CHolderFirstName, CExpirDate,IsVisible) VALUES ('john.smith@gmail.com','4128004598906574','Smith','John','0415','1');";
$add_payment_2 = "INSERT INTO PaymentMethods (CEmail, CardNo, CHolderLastName, CHolderFirstName, CExpirDate,IsVisible) VALUES ('john.smith@gmail.com','379787674561223','Taylor','Marry','1214','1');";


if (mysqli_query($con, $add_payment_1)) 
 {
  echo "Values of PaymentMethods inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to PaymentMethods: " . mysqli_error($con)."<br>";
  }
  
  if (mysqli_query($con, $add_payment_2)) 
 {
  echo "Values of PaymentMethods inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to PaymentMethods: " . mysqli_error($con)."<br>";
  }
?>