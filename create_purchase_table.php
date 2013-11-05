//Author: Libby Ferland
//Date: 11/5/2013

<?php

$createString = "CREATE TABLE Purchase(Email TEXT NOT NULL,
    InvoiceNo INT NOT NULL,
    PurchaseRating INT,
    REVIEW TEXT,
    FOREIGN KEY (Email) REFERENCES Customer(Email),
    FOREIGN KEY (InvoiceNo) REFERENCES Order(InvoiceNo) ) ";

 if (mysqli_query($con, $createString))
{
    echo "Table Purchase created successfully";
}
else 
{
    echo "Error creating table Purchase: " . mysqli_error($con);
}

//dummy value

?>