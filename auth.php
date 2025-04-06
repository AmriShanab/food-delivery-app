<?php
session_start();

function checkAuth() {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
        header('Location: signin.php');
        exit();
    }
}

function adminAuth() {
    checkAuth();
    // Add additional admin checks if needed
    // if ($_SESSION['role'] !== 'admin') {
    //     header('Location: unauthorized.php');
    //     exit();
    // }
}
?>