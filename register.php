<?php
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signUp'])) {
        // Registration logic
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $checkEmail = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($checkEmail);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Email Address Already Exists!";
        } else {
            // Insert new user into the database
            $insertQuery = "INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    if (isset($_POST['signIn'])) {
        // Login logic
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['email'] = $row['email'];
                header("Location: homepage.php");
                exit();
            } else {
                echo "Incorrect Password!";
            }
        } else {
            echo "No account found with this email!";
        }
    }
}
?>
