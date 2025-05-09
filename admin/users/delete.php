<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
adminAuth();

// Check if ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error_message'] = "Invalid user ID.";
    header("Location: index.php");
    exit();
}

$id = (int) $_GET['id'];

// Check if user exists
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    $_SESSION['error_message'] = "User not found.";
    header("Location: index.php");
    exit();
}

// Delete user
$stmt = $db->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

$_SESSION['success_message'] = "User deleted successfully.";
header("Location: index.php");
exit();
