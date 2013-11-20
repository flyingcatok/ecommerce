<?php
//Author: Feiyu Shi
//Date: 11/19/2013
//Last Edited: 
//Date:

//create paidwith table

$create_paidwith_table = "CREATE TABLE PaidWith
   (OrderID 	INT 		NOT NULL,
    CEmail 		VARCHAR(30) 		NOT NULL,
     CardNo 		BIGINT 			NOT NULL,
     PRIMARY KEY (OrderID, CEmail, CardNo),
 	 FOREIGN KEY (OrderID) REFERENCES Orders(POrderID),
 	 FOREIGN KEY (CEmail, CardNo) REFERENCES PaymentMethods(CEmail, CardNo)
    )";

if (mysqli_query($con, $create_paidwith_table))
{
    echo "Table PaidWith created successfully<br>";
}
else 
{
    echo "Error creating table PaidWith: " . mysqli_error($con)."<br>";
}


?>
