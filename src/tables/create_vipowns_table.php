
<?php

//Author: Libby Ferland
//Date: 11/5/2013

//create table
$create_vipowns_table_string = "CREATE TABLE VipOwns(StoreID INT NOT NULL, 
    Email VARCHAR(100) NOT NULL, 
    StoreName VARCHAR(250) NOT NULL, 
    StoreRating FLOAT,
    FOREIGN KEY (StoreID) REFERENCES Ministore(StoreID),
    FOREIGN KEY (Email) REFERENCES Customer(Email) )";

 if (mysqli_query($con, $create_vipowns_table_string))
{
    echo "Table VipOwns created successfully";
}
else 
{
    echo "Error creating table VipOwns: " . mysqli_error($con);
}

//insert dummy value?

?>

    