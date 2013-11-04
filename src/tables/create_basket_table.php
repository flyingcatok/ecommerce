<?php
//Author: Feiyu Shi
//Date: 11/2/2013
//Last Edited: Feiyu Shi
//Date: 11/4/2013

// create basket table, merged with shopwith table
$create_basket_table = "
CREATE TABLE Basket 
(CEmail			VARCHAR(50)			NOT NULL,
BasketId		INT					NOT NULL,
ShopDate		DATE				NOT NULL,
 PRIMARY KEY (CEmail, BasketId),
 FOREIGN KEY (CEmail) REFERENCES Customer(Email) )";
 
if (mysqli_query($con,$create_basket_table))
{
	echo "Table Basket created successfully<br>";
}
else
{
	echo "Error creating table Basket: " . mysqli_error($con)."<br>";
} 
 
?>