
<?php

//Author: Libby Ferland
//Date: 11/5/2013
//Lasted Edited: Feiyu Shi
//Date: 11/5/2013

$create_upforauc_table_String = "CREATE TABLE UpForAuc(
	StoreID 	INT 	NOT NULL,
    AucID 	INT 		NOT NULL,
    IId 	INT 		NOT NULL,
    StartTime 	TIMESTAMP	NOT NULL,
    EndTime 	TIMESTAMP	NOT NULL,
    AucRating	INT,
    AucReview	TEXT,
    PRIMARY KEY(AucID,IId,StoreID),
    FOREIGN KEY (AucID) REFERENCES Auction(AuctionID),
    FOREIGN KEY (IId) REFERENCES Item(IId),
    FOREIGN KEY (StoreID) REFERENCES Ministore(StoreID))";

 if (mysqli_query($con, $create_upforauc_table_String))
{
    echo "Table UpForAuc created successfully<br>";
}
else 
{
    echo "Error creating table UpForAuc: " . mysqli_error($con)."<br>";
}

//will need dummy value

?>