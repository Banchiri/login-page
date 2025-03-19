<?php
error_reporting(0);
$host="localhost";
$user="root";
$pass="";
$db="login";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    //echo "Failed to connect to DB" . $conn->connect_error; this does not stop the excution on failure
    die("Connection failed:" . $conn->connection_error);
}
?>