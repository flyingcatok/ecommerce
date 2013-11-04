<?php
//Author: Feiyu Shi
//Date: 11/4/2013
//Last Edited:
//Date:

// create basketcontains table
$create_basketcontains_table = "
CREATE TABLE BasketContains(
BasketId		INT					NOT NULL,
IId				INT					NOT NULL,
 PRIMARY KEY (BasketId, IId),
 FOREIGN KEY (BasketId) REFERENCES Basket(BasketId),
 FOREIGN KEY (IId) REFERENCES Item(IId) )";
 
if (mysqli_query($con,$create_basketcontains_table))
{
	echo "Table BasketContains created successfully<br>";
}
else
{
	echo "Error creating table BasketContains: " . mysqli_error($con)."<br>";
} 
 
?>