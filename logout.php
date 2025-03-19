<?php
session_start();
session_unset();//Unset all session variables
session_destroy();//destroy the session
header("location: index.php"); // redirect the user to login.php or any other login page
exit()


?>