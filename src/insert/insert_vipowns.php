<?php
//Author: Feiyu Shi
//Date: 11/7/2013
//Last Edited: 
//Last Edit Date:

$add_vipowns_1 = "INSERT INTO VipOwns(CEmail, StoreID) VALUES ('john.smith@gmail.com','0001')";


  if (mysqli_query($con, $add_vipowns_1)) 
 {
  echo "Values of VipOwns inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to VipOwns: " . mysqli_error($con)."<br>";
  }
?>