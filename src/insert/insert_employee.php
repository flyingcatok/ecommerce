<?php
//Author: Feiyu Shi
//Date: 11/2/2013
//Last Edit: Libby Ferland
//Edit date: 11/10/2013

// fill in employee table
 mysqli_query($con,"INSERT INTO Employee (EId, EPassword, LastName,FirstName,IsManager)
 VALUES ('33', 'libby', 'Ferland','Libby','0')"); // Libby as a staff
  mysqli_query($con,"INSERT INTO Employee (EId, EPassword, LastName,FirstName,IsManager)
 VALUES ('24', 'feiyu','Shi','Feiyu','1')"); // Feiyu as a manager
 
?>