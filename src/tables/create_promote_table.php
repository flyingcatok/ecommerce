
<?php
//Author: Feiyu Shi
//Date: 11/4/2013

// create promote table
$create_promote_table = "
CREATE TABLE Promote
(EId			INT				NOT NULL,
 IId			INT				NOT NULL,
 PromoteRate	FLOAT			NOT NULL,
 PStartDate		DATE			NOT NULL,
 PEndDate		DATE,
 PRIMARY KEY (EId, IId), 
 FOREIGN KEY (EId) REFERENCES Employee(EId),
 FOREIGN KEY (IId) REFERENCES Item(IId))";
 
  if (mysqli_query($con,$create_employee_table))
  {
  echo "Table Promote created successfully<br>";
  }
  else
  {
  echo "Error creating table Promote: " . mysqli_error($con)."<br>";
  } 
  
 ?>