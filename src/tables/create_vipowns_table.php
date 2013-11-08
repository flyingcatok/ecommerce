
<?php

//Author: Libby Ferland
//Date: 11/5/2013
//Last Edited: Feiyu Shi
//Date: 11/7/2013

//create table
$create_vipowns_table = "CREATE TABLE VipOwns(
	CEmail 	VARCHAR(30) 	NOT NULL, 
    StoreID 	INT 		NOT NULL,  
    FOREIGN KEY (StoreID) REFERENCES Ministore(StoreID),
    FOREIGN KEY (CEmail) REFERENCES Customer(Email) )";

 if (mysqli_query($con, $create_vipowns_table ))
{
    echo "Table VipOwns created successfully";
}
else 
{
    echo "Error creating table VipOwns: " . mysqli_error($con);
}

//insert dummy value?

?>

    