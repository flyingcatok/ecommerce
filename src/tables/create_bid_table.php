
<?php

//Author: Libby Ferland
//Date: 11/5/2013


$createBidString = "CREATE TABLE Bid(Email TEXT NOT NULL, 
    AuctionID INT NOT NULL,
    CurrentPrice FLOAT NOT NULL,
    FOREIGN KEY Email REFERENCES Customer(Email),
    FOREIGN KEY AuctionID REFERENCES Auction(AuctionID) ) ";

 if (mysqli_query($con, $createBidString))
{
    echo "Table Bid created successfully";
}
else 
{
    echo "Error creating table Bid: " . mysqli_error($con);
}

//dummy value? 

?>