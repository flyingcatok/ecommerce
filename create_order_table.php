//Author: Libby Ferland
//Date 11/2/2013

<?php

//create order table

$createString = "CREATE TABLE Order(InvoiceNo INT NOT NULL,
    Status TEXT NOT NULL,
    OrderDate DATE NOT NULL,
    ShipDate DATE,
    ShipMethod TEXT NOT NULL,
    ShipRate FLOAT NOT NULL,
    PRIMARY KEY(InvoiceNo) )";

if (mysqli_query($con, $createString))
{
    echo "Table Order created successfully";
}
else 
{
    echo "Error creating table Order: " . mysqli_error($con);
}

//insert dummy value
$addOrder = "INSERT INTO Order (InvoiceNo, Status, OrderDate, ShipDate, ShipMethod, ShipRate) VALUES (0001, 'Shipped', '2013-10-20', '2013-10-22',
    'Ground', '3.99')";

mysqli_query($con, $addOrder);

?>
