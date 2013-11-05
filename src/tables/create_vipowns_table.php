//Author: Libby Ferland
//Date: 11/5/2013

<?php

//create table
$createString = "CREATE TABLE VipOwns(StoreID INT NOT NULL, 
    Email TEXT NOT NULL, 
    StoreName TEXT NOT NULL, 
    StoreRating FLOAT,
    FOREIGN KEY (StoreID) REFERENCES Ministore(StoreID),
    FOREIGN KEY (Email) REFERENCES Customer(Email) )";

 if (mysqli_query($con, $createString))
{
    echo "Table VipOwns created successfully";
}
else 
{
    echo "Error creating table VipOwns: " . mysqli_error($con);
}

//insert dummy value?

?>

    