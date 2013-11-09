<?php
//Author: Libby Ferland
//Date: 11/5/2013
//Last Edit: Feiyu Shi
//Last Edit Date: 11/5/2013

$create_purchase_table = "CREATE TABLE Purchase(
    CEmail 		VARCHAR(30) 	NOT NULL,
    InvoiceNo 		INT 		NOT NULL,
    PurchaseDate	TIMESTAMP	NOT NULL,
    PurchaseRating 	INT, 
    REVIEW 		TEXT,
    PRIMARY KEY(CEmail,InvoiceNo),
    FOREIGN KEY (CEmail) REFERENCES Customer(Email),
    FOREIGN KEY (InvoiceNo) REFERENCES Orders(POrderID) ) ";

 if (mysqli_query($con, $create_purchase_table))
{
    echo "Table Purchase created successfully<br>";
}
else 
{
    echo "Error creating table Purchase: " . mysqli_error($con)."<br>";
}

//dummy value

?>