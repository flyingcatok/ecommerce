
<?php

//Author: Libby Ferland
//Date: 11/5/2013

$create_upforauc_table_String = "CREATE TABLE UpForAuc(
	AuctionID INT NOT NULL,
    IId INT NOT NULL,
    StartTime DATE NOT NULL,
    EndTime DATE NOT NULL
    PRIMARY KEY(AuctionID,IId),
    FOREIGN KEY (AuctionID) REFERENCES Auction(AuctionID),
    FOREIGN KEY (IId) REFERENCES Item(IId))";

 if (mysqli_query($con, $create_upforauc_table_String))
{
    echo "Table UpForAuc created successfully";
}
else 
{
    echo "Error creating table UpForAuc: " . mysqli_error($con);
}

//will need dummy value

?>