
<?php
//Author: Feiyu Shi
//Date: 11/2/2013
//Last Edit: Libby Ferland
//Edit date: 11/10/2013

// create employee table
$create_employee_table = "
CREATE TABLE Employee 
(EId			INT			NOT NULL,
 EPassword      VARCHAR(30) NOT NULL,
 LastName		TEXT			NOT NULL,
 FirstName		TEXT			NOT NULL,
 IsManager		BOOLEAN			NOT NULL,
 PRIMARY KEY (EId) )";
 
  if (mysqli_query($con,$create_employee_table))
  {
  echo "Table Employee created successfully<br>";
  }
  else
  {
  echo "Error creating table Employee: " . mysqli_error($con)."<br>";
  } 
  
 
 ?>