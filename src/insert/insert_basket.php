<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_basket_1 = "INSERT INTO Basket (CEmail, BasketId, ShopDate) VALUES ('john.smith@gmail.com','1','2013-11-7 22:45:44');";



if (mysqli_query($con, $add_basket_1)) 
 {
  echo "Values of Basket inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Basket: " . mysqli_error($con)."<br>";
  }
?>