
<?php
//Author: Libby Ferland
//Date: 11/2/2013
//Last Edited: Feiyu Shi
//Date: 11/6/2013

//create table
$create_customer_table = "CREATE TABLE Customer
    (Email 		VARCHAR(30) 		NOT NULL, PRIMARY KEY(Email),
     Password 		TEXT 			NOT NULL,
     Lname  		TEXT 			NOT NULL,
     Fname 		TEXT 			NOT NULL,
     IsVIP 		BOOLEAN 			NOT NULL)
     ENGINE = INNODB";

//check to make sure table is there

if (mysqli_query($con, $create_customer_table))
{
    echo "Table Customer created successfully<br>";
}
else 
{
    echo "Error creating table Customer: " . mysqli_error($con)."<br>";
}

?>

     