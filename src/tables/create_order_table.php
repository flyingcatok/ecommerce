<?php
//Author: Libby Ferland
//Date: 11/2/2013
//Last Edited: Feiyu Shi
//Date: 11/5/2013

//create order table

$create_order_table = "CREATE TABLE Orders
   (POrderID 	INT 		NOT NULL, PRIMARY KEY (POrderID),
    Status 	VARCHAR(10) 	NOT NULL  
    )";

if (mysqli_query($con, $create_order_table))
{
    echo "Table Orders created successfully<br>";
}
else 
{
    echo "Error creating table Orders: " . mysqli_error($con)."<br>";
}


?>
