
<?php
//Author: Libby Ferland
//Date: 11/2/2013
//Last Edited: Feiyu Shi
//Date: 11/4/2013

//create table - but what about the final price value (composite?)
$create_auction_table = "CREATE TABLE Auction(
    AuctionID 	INT 	NOT NULL,
    StartPrice 	FLOAT 	NOT NULL,
    BidInterval FLOAT 	NOT NULL, 
    PRIMARY KEY(AuctionID))";

    if (mysqli_query($con, $create_auction_table))
{
    echo "Table Auction created successfully<br>";
}
else 
{
    echo "Error creating table Auction: " . mysqli_error($con)."<br>";
}


?>