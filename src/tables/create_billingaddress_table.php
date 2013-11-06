<?php
//Author: Feiyu Shi
//Date: 11/6/2013
//Last Edited: 
//Date: 

//create table
$create_billingaddress_table = "CREATE TABLE BillingAddress
    (CEmail 		VARCHAR(30) 	NOT NULL,
     CardNo 		BIGINT 			NOT NULL,
     Baddr1			VARCHAR(50)			NOT NULL,
     BCity			VARCHAR(50)			NOT NULL,
     BState			CHAR(2)			NOT NULL,
     PRIMARY KEY (CEmail, CardNo, Baddr1,BCity,BState),
 	 FOREIGN KEY (CEmail,CardNo) REFERENCES PaymentMethods(CEmail,CardNo),
 	 FOREIGN KEY (CEmail,Baddr1,BCity,BState) REFERENCES AddressBook(CEmail,AddrLine1, City, State) )";

//check to make sure table is there

if (mysqli_query($con, $create_billingaddress_table))
{
    echo "Table BillingAdress created successfully";
}
else 
{
    echo "Error creating table BillingAdress: " . mysqli_error($con);
}

?>

     