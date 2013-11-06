<?php
//Author: Feiyu Shi
//Date: 11/4/2013
//Last Edited: Feiyu Shi
//Date: 11/5/2013

// create basketcontains table
$create_basketcontains_table = "
CREATE TABLE BasketContains(
 CEmail		VARCHAR(30)		NOT NULL,
 BaskId		INT			NOT NULL,
 IId		INT			NOT NULL,
 BQuantity   	INT                 	NOT NULL,
 PRIMARY KEY (CEmail, BaskId, IId),
 FOREIGN KEY (CEmail) REFERENCES Customer(Email),
 FOREIGN KEY (BaskId) REFERENCES Basket(BasketId),
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