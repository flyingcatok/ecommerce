<?php
//Author: Libby Ferland
//Date: 11/2/2013
//Last Edited: Feiyu Shi
//Date: 11/5/2013

//create order table

$create_order_table = "CREATE TABLE PurchaseOrder
   (POrderID 	INT 		NOT NULL, PRIMARY KEY (POrderID),
    Status 	VARCHAR(10) 	NOT NULL,  
    )
    ENGINE=INNODB";

if (mysqli_query($con, $create_order_table))
{
    echo "Table Order created successfully";
}
else 
{
    echo "Error creating table Order: " . mysqli_error($con);
}

//insert dummy value
$addOrder = "INSERT INTO Order (InvoiceNo, Status, OrderDate, ShipDate, ShipMethod, ShipRate) VALUES (0001, 'Shipped', '2013-10-20', '2013-10-22',
    'Ground', '3.99');";

//mysqli_query($con, $addOrder);

?>
