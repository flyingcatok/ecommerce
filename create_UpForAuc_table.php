//Author: Libby Ferland
//Date: 11/5/2013

<?php

$createString = "CREATE TABLE UpForAuc(AuctionID INT NOT NULL,
    IId INT NOT NULL,
    StartTime DATE NOT NULL,
    EndTime DATE NOT NULL)";

 if (mysqli_query($con, $createString))
{
    echo "Table UpForAuc created successfully";
}
else 
{
    echo "Error creating table UpForAuc: " . mysqli_error($con);
}

//will need dummy value

?>