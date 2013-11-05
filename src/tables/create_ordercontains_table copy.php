//Author: Libby Ferland
//Date: 11/5/2013

<?php

$createString = "CREATE TABLE OrderContains(IId INT NOT NULL, 
    InvoiceNo INT NOT NULL,
    Quantity INT NOT NULL,
    FOREIGN KEY (IId) REFERENCES Item(IId),
    FOREIGN KEY (InvoiceNo) REFERENCES Order(InvoiceNo) ";

 if (mysqli_query($con, $createString))
{
    echo "Table OrderContains created successfully";
}
else 
{
    echo "Error creating table OrderContains: " . mysqli_error($con);
}

//dummy value