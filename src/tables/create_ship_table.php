
<?php
//Author: Feiyu Shi
//Date: 11/4/2013
//Last Edited: Feiyu Shi
//Last Edit Date: 11/6/13

// create ship table
$create_ship_table = "
CREATE TABLE Ship
(EId			INT		NOT NULL,
 OrderID 		INT 		NOT NULL,
 ShipDate 		TIMESTAMP	NOT NULL,
 PRIMARY KEY (EId,OrderID),
 FOREIGN KEY (EId) REFERENCES Employee(EId),
 FOREIGN KEY (OrderID) REFERENCES Orders(POrderID)
  )";
 
  if (mysqli_query($con,$create_ship_table))
  {
  	echo "Table Ship created successfully<br>";
  }
  else
  {
  	echo "Error creating table Ship: " . mysqli_error($con)."<br>";
  } 
  
 ?>