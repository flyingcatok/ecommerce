<?php
//Author: Feiyu Shi
//Date: 11/2/2013

// fill in employee table
 mysqli_query($con,"INSERT INTO Employee (EId,LastName,FirstName,IsManager)
 VALUES ('33','Ferland','Libby','0')"); // Libby as a staff
  mysqli_query($con,"INSERT INTO Employee (EId,LastName,FirstName,IsManager)
 VALUES ('24','Shi','Feiyu','1')"); // Feiyu as a manager
 
?>