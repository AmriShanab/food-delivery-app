<?php
// Start session for error handling
session_start();

// Include database connection
require_once 'database/dbconfig.php';

// Initialize variables
$name = $email = $subject = $message = '';
$errors = [];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validate name
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors['name'] = 'Only letters and white space allowed';
    }
    
    // Validate email
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    
    // Validate subject
    if (empty($subject)) {
        $errors['subject'] = 'Subject is required';
    }
    
    // Validate message
    if (empty($message)) {
        $errors['message'] = 'Message is required';
    }
    
    // If no errors, proceed to save to database
    if (empty($errors)) {
        try {
            // Prepare SQL statement
            $stmt = $db->prepare("INSERT INTO inquiries (name, email, subject, message) 
                                VALUES (:name, :email, :subject, :message)");
            
            // Bind parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':message', $message);
            
            // Execute the statement
            if ($stmt->execute()) {
                // Success - redirect with success message
                $_SESSION['success'] = 'Thank you! Your message has been sent successfully.';
                header('Location: contact.php');
                exit();
            } else {
                $errors['database'] = 'Failed to save your inquiry. Please try again.';
            }
        } catch (PDOException $e) {
            $errors['database'] = 'Database error: ' . $e->getMessage();
            error_log('Database error: ' . $e->getMessage());
        }
    }
    
    // Store errors and form data in session
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    
    // Redirect back to form
    header('Location: contact.php');
    exit();
}

// If directly accessed, redirect to form
header('Location: contactus.php');
exit();
?>