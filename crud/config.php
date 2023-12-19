<?php

$hostname = "localhost";
$username = "root";
$password = "TPPkWL]fCQRdmY]r";
$dbname = "canteen_ordering_system";

$conn = new mysqli();
$conn->connect($hostname,$username,$password,$dbname) or die("Connection Failed");
// or $conn = mysqli_connect($hostname,$username,$password,$dbname);

$sql = "SHOW TABLES FROM canteen_ordering_system";


$result =  $conn->query($sql);




?>