<?php
$host = "localhost";
$user = "root";
$pwd = "";
$dbname = "inoutkvp";

$conn = mysqli_connect($host,$user,$pwd,$dbname);

if (!$conn || empty($conn)) {

   die(mysqli_connect_error(). "DATABASE ERROR!");
   

}


?>