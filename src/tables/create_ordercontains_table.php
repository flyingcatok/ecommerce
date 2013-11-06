<?php
//Author: Feiyu Shi
//Date: 11/4/2013
//Last Edited: Feiyu Shi	
//Date: 11/5/2013

// create ordercontains table
$create_ordercontains_table = "
CREATE TABLE OrderContains(
COrderID 		INT 	NOT NULL,
IId			INT	NOT NULL,
OQuantity       	INT 	NOT NULL,
 PRIMARY KEY (COrderID,IId),
 FOREIGN KEY (COrderID) REFERENCES Orders(POrderID),
 FOREIGN KEY (IId) REFERENCES Item(IId) )";
 
if (mysqli_query($con,$create_ordercontains_table))
{
	echo "Table OrderContains created successfully<br>";
}
else
{
	echo "Error creating table OrderContains: " . mysqli_error($con)."<br>";
} 
 
?>