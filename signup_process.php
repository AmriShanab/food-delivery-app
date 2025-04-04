<?php
// File: signup_process.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_delivery";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Password validation
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Insert the user into the database
        $sql = "INSERT INTO users (first_name, last_name, email, address, password, phone) 
                VALUES ('$first_name', '$last_name', '$email', '$address', '$hashed_password', '$phone')";

        if ($conn->query($sql) === TRUE) {
            echo "Sign up successful! You can <a href='login.php'>login</a> now.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
