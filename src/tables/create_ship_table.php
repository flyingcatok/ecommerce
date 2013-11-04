
<?php
//Author: Feiyu Shi
//Date: 11/4/2013

// create ship table
$create_ship_table = "
CREATE TABLE Ship
(EId			INT		NOT NULL,
 InvoiceNo 		INT 	NOT NULL,
 ShipDate 		DATE	NOT NULL,
 PRIMARY KEY (EId,InvoiceNo),
 FOREIGN KEY (EId) REFERENCES Employee(EId),
 FOREIGN KEY (InvoiceNo) REFERENCES Order(InvoiceNo) )";
 
  if (mysqli_query($con,$create_ship_table))
  {
  	echo "Table Ship created successfully<br>";
  }
  else
  {
  	echo "Error creating table Ship: " . mysqli_error($con)."<br>";
  } 
  
 ?>