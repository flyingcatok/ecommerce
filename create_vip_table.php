//Author: Libby Ferland
//Date: 11/2/2013

<?php

$createString = "CREATE TABLE Ministore(StoreID INT NOT NULL, 
    StoreName TEXT NOT NULL, PRIMARY KEY (StoreID))";

if (mysqli_query($con, $createString))
{
    echo "Table Ministore created successfully";
}
else 
{
    echo "Error creating table Ministore: " . mysqli_error($con);
}

//insert dummy value

$addStore = "INSERT INTO Ministore(StoreID, StoreName) VALUES (0001, 'Toyland')";

mysqli_query($con, $addStore);

?>