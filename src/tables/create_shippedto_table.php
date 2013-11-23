<?php
//Author: Feiyu Shi
//Date: 11/6/2013
//Last Edited: Libby Ferland
//Date: 11/20/2013


//create order table

$create_shippedto_table = "CREATE TABLE ShippedTo
   (OrderID 	INT 		NOT NULL,
    CEmail 		VARCHAR(30) 		NOT NULL,
    AddrIndex	INT			NOT NULL,
     PRIMARY KEY (OrderID, CEmail, AddrIndex), 
 	 FOREIGN KEY (OrderID) REFERENCES Orders(POrderID),
 	 FOREIGN KEY (CEmail,AddrIndex) REFERENCES AddressBook(CEmail,AddrIndex)
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
