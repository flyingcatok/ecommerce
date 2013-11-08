<?php
//Author: Feiyu Shi
//Date: 11/2/2013
//Last Edited: Feiyu Shi
//Date: 11/5/2013

// create item table
$create_item_table = "
CREATE TABLE Item 
(IId			INT				NOT NULL,
 IName			TEXT				NOT NULL,
 Category		TEXT				NOT NULL,
 Description		TEXT,		
 Quantity		INT				NOT NULL,
 IPrice			FLOAT				NOT NULL,
 PRIMARY KEY (IId) )";
 
   if (mysqli_query($con,$create_item_table))
  {
  echo "Table Item created successfully<br>";
  }
  else
  {
  echo "Error creating table Item: " . mysqli_error($con)."<br>";
  } 
 
 
 ?>