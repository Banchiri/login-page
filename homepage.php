<?php
session_start();
include("connect.php");

// Redirect if the user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];

// Secure database query with prepared statements
$stmt = $conn->prepare("SELECT firstName, lastName FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user data
if ($row = $result->fetch_assoc()) {
    $fullName = $row['firstName'] . ' ' . $row['lastName'];
} else {
    $fullName = "User"; // Fallback if no user is found
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align:center; padding:15%;">
       <p style="font-size:50px; font-weight:bold;">
        Hello <?= htmlspecialchars($fullName) ?> :)
        
        </p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>