
<?php
//Author: Feiyu Shi
//Date: 11/2/2013

// create employee table
$create_employee_table = "
CREATE TABLE Employee 
(EId			INT			NOT NULL,
 LastName		TEXT			NOT NULL,
 FirstName		TEXT			NOT NULL,
 IsManager		BIT			NOT NULL,
 PRIMARY KEY (EId) )";
 
  if (mysqli_query($con,$create_employee_table))
  {
  echo "Table Employee created successfully<br>";
  }
  else
  {
  echo "Error creating table Employee: " . mysqli_error($con)."<br>";
  } 
  
 // fill in employee table
 mysqli_query($con,"INSERT INTO Employee
 VALUES ('33','Ferland','Libby','0')"); // Libby as a staff
  mysqli_query($con,"INSERT INTO Employee
 VALUES ('24','Shi','Feiyu','1')"); // Feiyu as a manager
 ?>