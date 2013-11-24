<?php
//Author: Feiyu Shi
//Date: 11/7/2013

$add_addr_1 = "INSERT INTO AddressBook (AddrIndex, CEmail, AddrLine1, AddrLine2, City, State, Zip, IsVisible) VALUES ('1','john.smith@gmail.com','434 Transylvania Ave','APT 114','Lexington','KY', '40508','1');";
$add_addr_2 = "INSERT INTO AddressBook (AddrIndex, CEmail, AddrLine1, AddrLine2, City, State, Zip, IsVisible) VALUES ('2','john.smith@gmail.com','189 Lake Lila Ln','APT 8A3','Ann Arbor','MI', '48105','1');";


if (mysqli_query($con, $add_addr_1)) 
 {
  echo "Values of AddressBook inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to AddressBook: " . mysqli_error($con)."<br>";
  }
  
  if (mysqli_query($con, $add_addr_2)) 
 {
  echo "Values of AddressBook inserted successfully<br>";
  }
else
  {
  echo "Error inserting values to AddressBook: " . mysqli_error($con)."<br>";
  }
?>