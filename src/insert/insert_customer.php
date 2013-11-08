<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_customer_1 = "INSERT INTO Customer (Email, Password, Lname, Fname, IsVIP) VALUES ('john.smith@gmail.com','123456','Smith','John', '1');";

if (mysqli_query($con, $add_customer_1)) 
 {
  echo "Values of Customer inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Customer: " . mysqli_error($con)."<br>";
  }
?>
