<?php
$username = "cs405";
$password = "cs405";
$con = mysqli_connect('localhost:8889', $username, $password, 'cs405');
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