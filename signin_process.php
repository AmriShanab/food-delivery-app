<?php
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'food_delivery';
$username = 'root';
$password = '';

// Error handling
ini_set('display_errors', 0);
error_reporting(0);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // Validate inputs
        if (empty($email) || empty($password)) {
            throw new Exception("Please fill in all fields");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Please enter a valid email address");
        }

        // Check user
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception("Account not found. Please create an account");
        }

        if (!password_verify($password, $user['password'])) {
            throw new Exception("Incorrect email or password");
        }

        if (isset($user['is_active']) && !$user['is_active']) {
            throw new Exception("Account inactive. Contact support");
        }

        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['logged_in'] = true;

        header("Location: dashboard.php");
        exit();
    }
} catch (Exception $e) {
    $_SESSION['login_error'] = $e->getMessage();
    header("Location: signin.php");
    exit();
}