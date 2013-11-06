
<?php

//Author: Libby Ferland
//Date: 11/5/2013
//Last Edited: Feiyu Shi
//Date: 11/5/2013


$create_bid_table = "CREATE TABLE Bid(
    CEmail 		VARCHAR(30) 	NOT NULL, 
    AuctionID 		INT 		NOT NULL,
    CurrentPrice 	FLOAT 		NOT NULL,
    BidTime		TIMESTAMP	NOT NULL,
    PRIMARY KEY(AuctionID,CEmail),
    FOREIGN KEY (CEmail) REFERENCES Customer(Email),
    FOREIGN KEY (AuctionID) REFERENCES Auction(AuctionID) ) ";

 if (mysqli_query($con, $create_bid_table ))
{
    echo "Table Bid created successfully";
}
else 
{
    echo "Error creating table Bid: " . mysqli_error($con);
}

//dummy value? 

?>