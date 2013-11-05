<?php

$usr = "cs405";
$pin = "cs405";
// global $con;
$con = mysqli_connect('localhost:8889', $usr, $pin, 'cs405');
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else
  {
  echo "Connection Established!";
  }

?>