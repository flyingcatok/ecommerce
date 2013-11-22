<?php
//Author: Feiyu Shi
//Date: 11/6/2013
//Last Edited: 
//Date: 

//create table
$create_addressbook_table = "CREATE TABLE AddressBook
    (AddrIndex          INT                     NOT NULL AUTO_INCREMENT,
    CEmail 		VARCHAR(30) 		NOT NULL,
     AddrLine1 		VARCHAR(50) 			NOT NULL,
     AddrLine2 		VARCHAR(50),
     City 		VARCHAR(50) 			NOT NULL,
     State 		CHAR(2) 		NOT NULL,
     Zip 		INT 			NOT NULL, 
     PRIMARY KEY (AddrIndex, CEmail, AddrLine1, City, State),
 	 FOREIGN KEY (CEmail) REFERENCES Customer(Email))";

//check to make sure table is there

if (mysqli_query($con, $create_addressbook_table))
{
    echo "Table AddressBook created successfully<br>";
}
else 
{
    echo "Error creating table AddressBook: " . mysqli_error($con)."<br>";
}

?>

     