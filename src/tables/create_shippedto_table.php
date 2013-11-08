<?php
//Author: Feiyu Shi
//Date: 11/6/2013
//Last Edited: 
//Date:

//create order table

$create_shippedto_table = "CREATE TABLE ShippedTo
   (OrderID 	INT 		NOT NULL,
    CEmail 		VARCHAR(30) 		NOT NULL,
     SAddr1 		VARCHAR(50) 			NOT NULL,
     City 		VARCHAR(50) 			NOT NULL,
     State 		CHAR(2) 		NOT NULL,
     PRIMARY KEY (OrderID, CEmail, SAddr1, City, State),
 	 FOREIGN KEY (OrderID) REFERENCES Orders(POrderID),
 	 FOREIGN KEY (CEmail, SAddr1, City, State) REFERENCES AddressBook(CEmail, AddrLine1, City, State)
    )";

if (mysqli_query($con, $create_shippedto_table))
{
    echo "Table ShippedTo created successfully";
}
else 
{
    echo "Error creating table ShippedTo: " . mysqli_error($con);
}


?>
