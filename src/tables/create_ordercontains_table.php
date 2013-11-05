<?php
//Author: Feiyu Shi
//Date: 11/4/2013
//Last Edited:
//Date:

// create ordercontains table
$create_ordercontains_table = "
CREATE TABLE OrderContains(
InvoiceNo 		INT 	NOT NULL,
IId				INT		NOT NULL,
OQuantity                INT NOT NULL,
 PRIMARY KEY (InvoiceNo, IId),
 FOREIGN KEY (InvoiceNo) REFERENCES Order(InvoiceNo),
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