<?php
//Author: Feiyu Shi
//Date: 11/2/2013
//Last Edited: 
//Date:

// fill in the item table
$add_item_1 = "INSERT INTO Item (IId,IName,Category,Description,Quantity,IPrice,PromoPrice)
 VALUES (
 '111',
 'LEGO Minecraft (Original) 21102',
 'Toys',
 'Players can destroy various types of blocks in a three dimensional environment.',
 '10',
 '32.79',
 '29.51');";
 
 if (mysqli_query($con,$add_item_1)) // LEGO example
 {
  echo "Values of item inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to item: " . mysqli_error($con)."<br>";
  } 
  
$add_item_2 = "INSERT INTO Item (IId,IName,Category,Description,Quantity,IPrice)
 VALUES (
 '201',
 'Call of Duty: Ghosts - Xbox 360',
 'Games',
 'The franchise that has defined a generation of gaming is set to raise the bar once again with the all-new Call of Duty: Ghosts.',
 '100',
 '59.96');";
 
 if (mysqli_query($con,$add_item_2))
  {
  echo "Values of item inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to item: " . mysqli_error($con)."<br>";
  } 
  
?>