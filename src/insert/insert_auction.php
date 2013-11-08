<?php
//Author: Libby Ferland
//Date: 11/2/2013
//Last Edited: 
//Date: 

//insert dummy value

$addAuction_1 = "INSERT INTO Auction(AuctionID, StartPrice, BidInterval) VALUES (1001, 1.00, 0.50)";


if (mysqli_query($con, $addAuction_1)) 
 {
  echo "Values of Auction inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Auction: " . mysqli_error($con)."<br>";
  }
?>
