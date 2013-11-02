<?php
// create employee table
$create_employee_table = "
CREATE TABLE Employee 
(EId			INT				NOT NULL,
 LastName		VARCHAR(20)		NOT NULL,
 FirstName		VARCHAR(20)		NOT NULL,
 IsManager		BIT				NOT NULL,
 PRIMARY KEY (EId) )";
 
 // fill in employee table
 mysqli_query($con,"INSERT INTO Employee
 VALUES ('33','Ferland','Libby','0')"); // Libby as a staff
  mysqli_query($con,"INSERT INTO Employee
 VALUES ('24','Shi','Feiyu','1')"); // Feiyu as a manager
 ?>