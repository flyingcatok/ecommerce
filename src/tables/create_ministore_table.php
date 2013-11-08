
<?php
//Author: Libby Ferland
//Date: 11/2/2013
//Last Edited: Feiyu Shi	
//Date: 11/4/2013

$create_ministore_table = "CREATE TABLE Ministore(
    StoreID 	INT 	NOT NULL, 
    StoreName 	TEXT 	NOT NULL, 
    PRIMARY KEY (StoreID))";

if (mysqli_query($con, $create_ministore_table))
{
    echo "Table Ministore created successfully";
}
else 
{
    echo "Error creating table Ministore: " . mysqli_error($con);
}


?>