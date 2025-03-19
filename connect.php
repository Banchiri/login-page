<?php
error_reporting(0);
$host="localhost";
$user="root";
$pass="";
$db="login";
//creates a new connection
$conn=new mysqli($host,$user,$pass,$db);
//check connection
if($conn->connect_error){
    //echo "Failed to connect to DB" . $conn->connect_error; this does not stop the excution on failure
    die("Connection failed: " . $conn->connection_error);
}
echo "connected successfully";
?>