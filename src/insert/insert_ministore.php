<?php
//Author: Libby Ferland
//Date: 11/2/2013
//Last Edited: 	
//Date: 

//insert dummy value

$addStore_1 = "INSERT INTO Ministore(StoreID, StoreName) VALUES (0001, 'Toyland')";


if (mysqli_query($con, $addStore_1)) 
 {
  echo "Values of Ministore inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to Ministore: " . mysqli_error($con)."<br>";
  }
?>
