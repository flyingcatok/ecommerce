<?php
//Author: Feiyu Shi
//Date: 11/7/2013
//Last Edit: Feiyu Shi
//Date: 11/19/2013

$add_shippedto_1 = "INSERT INTO ShippedTo (OrderID, CEmail, SAddr1,City,State) VALUES ('12367753','john.smith@gmail.com','189 Lake Lila Ln','Ann Arbor','MI');";


  if (mysqli_query($con, $add_shippedto_1)) 
 {
  echo "Values of ShippedTo inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to ShippedTo: " . mysqli_error($con)."<br>";
  }
  
  $add_shippedto_2 = "INSERT INTO ShippedTo (OrderID, CEmail, SAddr1,City,State) VALUES ('12367755','john.smith@gmail.com','189 Lake Lila Ln','Ann Arbor','MI');";


  if (mysqli_query($con, $add_shippedto_2)) 
 {
  echo "Values of ShippedTo inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to ShippedTo: " . mysqli_error($con)."<br>";
  }

?>