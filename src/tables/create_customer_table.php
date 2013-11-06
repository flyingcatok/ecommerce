
<?php
//Author: Libby Ferland
//Date: 11/2/2013
//Last Edited: Feiyu Shi
//Date: 11/5/2013

//create table
$create_customer_table = "CREATE TABLE Customer
    (Email 		VARCHAR(30) 		NOT NULL, PRIMARY KEY(Email),
     Password 		TEXT 			NOT NULL,
     Fname 		TEXT 			NOT NULL,
     Lname 		TEXT 			NOT NULL,
     AddLine1 		TEXT 			NOT NULL,
     AddLine2 		TEXT,
     City 		TEXT 			NOT NULL,
     State 		CHAR(2) 		NOT NULL,
     Zip 		INT 			sNOT NULL,
     CardNo 		BIGINT 			NOT NULL,
     CExpirDate 	TEXT 			NOT NULL,
     CHolderName 	TEXT 			NOT NULL,
     BillingAddr1 	TEXT 			NOT NULL,
     BillingAddr2 	TEXT,
     BillingCity 	TEXT 			NOT NULL,
     BillingState 	CHAR(2) 		NOT NULL,
     BillingZip 	INT 			NOT NULL,
     IsVIP 		BIT 			NOT NULL)
     ENGINE = INNODB";

//check to make sure table is there

if (mysqli_query($con, $create_customer_table))
{
    echo "Table Customer created successfully";
}
else 
{
    echo "Error creating table Customer: " . mysqli_error($con);
}

?>

     