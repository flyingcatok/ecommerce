<?php
//Author: Feiyu Shi
//Date: 11/7/2013
//Last Edited: 
//Last Edit Date:

$add_bid_1 = "INSERT INTO Bid(CEmail,AuctionID, CurrentPrice,BidTime) VALUES ('john.smith@gmail.com','1001','2.0','2013-11-8 00:00:00');";
$add_bid_2 = "INSERT INTO Bid(CEmail,AuctionID, CurrentPrice,BidTime) VALUES ('john.smith@gmail.com','1001','3.0','2013-11-8 01:12:45');";
$add_bid_3 = "INSERT INTO Bid(CEmail,AuctionID, CurrentPrice,BidTime) VALUES ('john.smith@gmail.com','1001','15.0','2013-11-10 17:55:11');";


if (mysqli_query($con, $add_bid_1)) 
 {
  echo "Values of Bid inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Bid: " . mysqli_error($con)."<br>";
  }
  
  if (mysqli_query($con, $add_bid_2)) 
 {
  echo "Values of Bid inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Bid: " . mysqli_error($con)."<br>";
  }
  
  if (mysqli_query($con, $add_bid_3)) 
 {
  echo "Values of Bid inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Bid: " . mysqli_error($con)."<br>";
  }
?>