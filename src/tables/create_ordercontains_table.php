<?php
//Author: Feiyu Shi
//Date: 11/4/2013
//Last Edited: Libby Ferland	
//Date: 11/5/2013

// create ordercontains table
$create_ordercontains_table = "
CREATE TABLE PurchaseOrderContains(
ContainsOrderID 		INT 	NOT NULL,
IId				INT		NOT NULL,
OQuantity       INT 	NOT NULL,
 PRIMARY KEY (ContainsOrderID, IId),
 FOREIGN KEY (ContainsOrderID) REFERENCES PurchaseOrder(POrderID),
 FOREIGN KEY (IId) REFERENCES Item(IId) )";
 
if (mysqli_query($con,$create_ordercontains_table))
{
	echo "Table PurchaseOrderContains created successfully<br>";
}
else
{
	echo "Error creating table PurchaseOrderContains: " . mysqli_error($con)."<br>";
} 
 
?>