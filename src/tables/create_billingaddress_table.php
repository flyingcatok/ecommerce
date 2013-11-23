<?php
//Author: Feiyu Shi
//Date: 11/6/2013
//Last Edited: Libby Ferland
//Date: 11/20/2013
//Note: Removed foreign key dependency on AddressBook table (unable to delete customer addresses otherwise)

//create table
$create_billingaddress_table = "CREATE TABLE BillingAddress 
    (CEmail 		VARCHAR(30) 	NOT NULL,
     CardNo 		BIGINT 			NOT NULL,
     AddrIndex		INT				NOT NULL,
     IsVisible      BOOLEAN             NOT NULL,
     PRIMARY KEY (CEmail, CardNo, AddrIndex),
 	 FOREIGN KEY (CEmail,CardNo) REFERENCES PaymentMethods(CEmail,CardNo),
 	 FOREIGN KEY (CEmail,AddrIndex) REFERENCES AddressBook(CEmail,AddrIndex) );";

//check to make sure table is there

if (mysqli_query($con, $create_billingaddress_table))
{
    echo "Table BillingAdress created successfully<br>";
}
else 
{
    echo "Error creating table BillingAdress: " . mysqli_error($con)."<br>";
}

?>

     