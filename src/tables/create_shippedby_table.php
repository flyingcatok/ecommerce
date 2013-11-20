<?php
//Author: Feiyu Shi
//Date: 11/19/2013
//Last Edited: 
//Date:

//create order table

$create_shippedby_table = "CREATE TABLE ShippedBy
   (OrderID 	INT 		NOT NULL,
    ShipMethod 		VARCHAR(20) 	NOT NULL,
     PRIMARY KEY (OrderID, ShipMethod),
 	 FOREIGN KEY (OrderID) REFERENCES Orders(POrderID),
 	 FOREIGN KEY (ShipMethod) REFERENCES ShipPrice(ShipMethod)
    )";

if (mysqli_query($con, $create_shippedby_table))
{
    echo "Table ShippedBy created successfully<br>";
}
else 
{
    echo "Error creating table ShippedBy: " . mysqli_error($con)."<br>";
}


?>
