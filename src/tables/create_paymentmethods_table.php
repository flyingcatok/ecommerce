<?php
//Author: Feiyu Shi
//Date: 11/6/2013
//Last Edited: 
//Date: 

//create table
$create_paymentmethods_table = "CREATE TABLE PaymentMethods
    (IsVisible            BIT             NOT NULL,
    CEmail 		VARCHAR(30) 	NOT NULL,
     CardNo 		BIGINT 			NOT NULL,
     CHolderLastName 	TEXT 			NOT NULL, 
     CHolderFirstName 	TEXT 			NOT NULL,
     CExpirDate 	TEXT 			NOT NULL,
     PRIMARY KEY (CEmail, CardNo),
 	 FOREIGN KEY (CEmail) REFERENCES Customer(Email))";

//check to make sure table is there

if (mysqli_query($con, $create_paymentmethods_table))
{
    echo "Table PaymentMethods created successfully<br>";
}
else 
{
    echo "Error creating table PaymentMethods: " . mysqli_error($con)."<br>";
}

?>

     