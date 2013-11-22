<?php
//Author: Feiyu Shi
//Date: 11/6/2013
//Last Edited: Libby Ferland
//Date: 11/20/2013
//Note: Removed foreign key dependency on AddressBook table; this allows deletion of customer addresses from database

//create order table

$create_shippedto_table = "CREATE TABLE ShippedTo
   (OrderID 	INT 		NOT NULL,
    CEmail 		VARCHAR(30) 		NOT NULL,
     SAddr1 		VARCHAR(50) 			NOT NULL,
     SAddr2             VARCHAR(50),            
     City 		VARCHAR(50) 			NOT NULL,
     State 		CHAR(2) 		NOT NULL,
     Zip                INT                     NOT NULL,
     PRIMARY KEY (OrderID, CEmail, SAddr1, City, State, Zip), 
 	 FOREIGN KEY (OrderID) REFERENCES Orders(POrderID),
 	 FOREIGN KEY (CEmail) REFERENCES Customer(Email)
    )";
//there is a potential defect here - SAddr2 may also be a key value
if (mysqli_query($con, $create_shippedto_table))
{
    echo "Table ShippedTo created successfully<br>";
}
else 
{
    echo "Error creating table ShippedTo: " . mysqli_error($con)."<br>";
}


?>
