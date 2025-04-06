<?php
// signup_process.php

// Start session to store user messages
session_start();

// Database connection
$host = 'localhost';
$db = 'food_delivery'; // Change to your DB name
$user = 'root';
$pass = ''; // Your DB password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize form inputs
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$address = trim($_POST['address']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone = trim($_POST['phone']);

// Basic validation
if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Check if email already exists
$check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check_email->bind_param("s", $email);
$check_email->execute();
$check_email->store_result();

if ($check_email->num_rows > 0) {
    die("Email already registered.");
}
$check_email->close();

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, address, password, phone) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $first_name, $last_name, $email, $address, $hashed_password, $phone);

if ($stmt->execute()) {
    // Redirect to login page
    header("Location: signin.php?signup=success");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>