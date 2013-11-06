
<?php
//Author: Feiyu Shi
//Date: 11/5/2013
//Last Edited: 
//Last Edit Date: 

// create ship table
$create_shipment_table = "
CREATE TABLE Shipment
(ShipMethod 		VARCHAR(20) 	NOT NULL,
 ShipRate 		FLOAT 		NOT NULL,
 PRIMARY KEY (ShipMethod) )";
 
  if (mysqli_query($con,$create_shipment_table 
  {
  	echo "Table Shipment created successfully<br>";
  }
  else
  {
  	echo "Error creating table Shipment: " . mysqli_error($con)."<br>";
  } 

// fill in the item table
 mysqli_query($con,
 "INSERT INTO Shipment
 VALUES (
 'Regular',
 '5.0')"); // regular shipment

 mysqli_query($con,
 "INSERT INTO Shipment
 VALUES (
 'Two-Day Express',
 '10.0')"); // two-day shipment

 mysqli_query($con,
 "INSERT INTO Shipment
 VALUES (
 'One-Day Overnight',
 '20.0')"); // regular shipment
  
 ?>