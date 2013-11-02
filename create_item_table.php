//Author: Feiyu Shi
//Date: 11/2/2013
<?php
// create item table
$create_item_table = "
CREATE TABLE Item 
(IId			INT					NOT NULL,
 IName			TEXT				NOT NULL,
 Category		TEXT				NOT NULL,
 Description	TEXT,		
 Quantity		INT					NOT NULL,
 IPrice			FLOAT				NOT NULL,
 PRIMARY KEY (IId) )";
 
   if (mysqli_query($con,$create_item_table))
  {
  echo "Table Item created successfully<br>";
  }
  else
  {
  echo "Error creating table Item: " . mysqli_error($con)."<br>";
  } 
 
 // fill in the item table
 mysqli_query($con,
 "INSERT INTO Item
 VALUES (
 '111',
 'LEGO Friends Olivia's Tree House 3065',
 'Toys',
 'Includes Olivia mini-doll figure and features the tree house pet cat Maxie, 
 4 ladybirds, a bird Goldie with birdhouse, 4 butterflies, hidden compartment and folding ladders.',
 '10',
 '17.59'
 )"); // LEGO example
 
 mysqli_query($con,
 "INSERT INTO Item
 VALUES (
 '201',
 'Call of Duty: Ghosts - Xbox 360',
 'Games',
 'The franchise that has defined a generation of gaming is set to raise the bar once again with the all-new Call of Duty: Ghosts.',
 '100',
 '59.96')"); // Call of duty example
 ?>