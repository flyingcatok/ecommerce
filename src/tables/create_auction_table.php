
<?php
//Author: Libby Ferland
//Date: 11/2/2013

//create table - but what about the final price value (composite?)
$createString = "CREATE TABLE Auction(AuctionID INT NOT NULL,
    StartPrice FLOAT NOT NULL,
    BidInterval FLOAT NOT NULL, PRIMARY KEY(AuctionID))";

    if (mysqli_query($con, $createString))
{
    echo "Table Auction created successfully";
}
else 
{
    echo "Error creating table Auction: " . mysqli_error($con);
}

//insert dummy value

$addAuction = "INSERT INTO Auction(AuctionID, StartPrice, BidInterval) VALUES (0001, 1.00, 0.50)";

mysqli_query($con, $addAuction);

?>