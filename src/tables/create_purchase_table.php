

<?php
//Author: Libby Ferland
//Date: 11/5/2013
//Last Edit: Libby Ferland
//Last Edit Date: 11/5/2013

$create_purchase_table_string = "CREATE TABLE Purchase(
	CEmail 		VARCHAR(50) 	NOT NULL,
    InvoiceNo 	INT 			NOT NULL,
    PurchaseRating INT,
    REVIEW TEXT,
    PRIMARY KEY(CEmail,InvoiceNo),
    FOREIGN KEY (CEmail) REFERENCES Customer(Email),
    FOREIGN KEY (InvoiceNo) REFERENCES PurchaseOrder(POrderID) ) ";

 if (mysqli_query($con, $create_purchase_table_string))
{
    echo "Table Purchase created successfully";
}
else 
{
    echo "Error creating table Purchase: " . mysqli_error($con);
}

//dummy value

?>