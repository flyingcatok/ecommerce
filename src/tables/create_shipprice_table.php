<?php
//Author: Feiyu Shi
//Date: 11/5/2013
//Last Edited: 
//Last Edit Date: 

// create ship table
$create_shipprice_table = "
CREATE TABLE ShipPrice
(ShipMethod 		VARCHAR(20) 	NOT NULL,
 ShipRate 		FLOAT 		NOT NULL,
 PRIMARY KEY (ShipMethod) )";
 
  if (mysqli_query($con,$create_shipprice_table ))
  {
  	echo "Table ShipPrice created successfully<br>";
  }
  else
  {
  	echo "Error creating table ShipPrice: " . mysqli_error($con)."<br>";
  } 


 ?>