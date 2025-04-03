<?php
session_start();

// Redirect if not logged in
function adminAuth() {
    if (!isset($_SESSION['admin_logged_in'])) {
        header("Location: login.php");
        exit();
    }
}

// Admin login check
function adminLogin($username, $password) {
    global $db;
    
    // In production, use prepared statements and password hashing
    $admin = $db->query("SELECT * FROM admins WHERE username = '$username'")->fetch();
    
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        return true;
    }
    return false;
}
?>