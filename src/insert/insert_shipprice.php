<?php
//Author: Feiyu Shi
//Date: 11/5/2013
//Last Edited: 
//Last Edit Date: 

// fill in the item table
 mysqli_query($con,
 "INSERT INTO ShipPrice
 VALUES (
 'Regular',
 '5.0')"); // regular shipment

 mysqli_query($con,
 "INSERT INTO ShipPrice
 VALUES (
 'Two-Day Express',
 '10.0')"); // two-day shipment

 mysqli_query($con,
 "INSERT INTO ShipPrice
 VALUES (
 'One-Day Overnight',
 '20.0')"); // regular shipment
  
?>