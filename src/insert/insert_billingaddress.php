<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_billingaddr_1 = "INSERT INTO BillingAddress (IsVisible, CEmail, CardNo, Baddr1, BCity, BState) VALUES ('1', 'john.smith@gmail.com','4128004598906574','434 Transylvania Ave','Lexington','KY');";
$add_billingaddr_2 = "INSERT INTO BillingAddress (IsVisible, CEmail, CardNo, Baddr1, BCity, BState) VALUES ('1', 'john.smith@gmail.com','379787674561223','189 Lake Lila Ln','Ann Arbor','MI');";


if (mysqli_query($con, $add_billingaddr_1)) 
 {
  echo "Values of BillingAddress inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to BillingAddress: " . mysqli_error($con)."<br>";
  } 
  
  if (mysqli_query($con, $add_billingaddr_2)) 
 {
  echo "Values of BillingAddress inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to BillingAddress: " . mysqli_error($con)."<br>";
  } 
?>
