<?php
//Author: Feiyu Shi
//Date: 11/2/2013
//Last Edited: Feiyu Shi
//Date: 11/5/2013

// create basket table, merged with shopwith table
$create_basket_table = "
CREATE TABLE Basket 
(BasketId		INT				NOT NULL AUTO_INCREMENT,
 CEmail			VARCHAR(30)			NOT NULL,
 ShopDate		TIMESTAMP,
 PRIMARY KEY (BasketId,CEmail),
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