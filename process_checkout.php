<?php
session_start();
include "layouts/header.php";
include "database/dbconfig.php";


if (!isset($_SESSION["total"])) {
    $_SESSION["total"] = 0; // Default value if total is not set
}
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $teleNo = $_POST['tele_no'];
    $address = $_POST['address'];
    $paymentOption = $_POST['payment_option'];
    $additionalInfo = $_POST['additional_info'];
    $total = $_SESSION["total"]; // Assuming you have the total stored in the session

    // Database connection (Make sure to replace these with your own)
    $host = 'localhost';
    $db = 'food_delivery';
    $user = 'root';
    $pass = '';
    
    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL query
        $sql = "INSERT INTO orders (first_name, last_name, email, tele_no, address, payment_option, additional_info, total) 
                VALUES (:first_name, :last_name, :email, :tele_no, :address, :payment_option, :additional_info, :total)";

        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tele_no', $teleNo);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':payment_option', $paymentOption);
        $stmt->bindParam(':additional_info', $additionalInfo);
        $stmt->bindParam(':total', $total);

        // Execute the statement
        $stmt->execute();

        // Clear the cart after order
        unset($_SESSION['cart']);
        unset($_SESSION['total']);

        echo "Order has been placed successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<script>
    document.getElementById("checkoutForm").addEventListener("submit", function(e) {
    // Validate first name
    let firstName = document.getElementById("firstName").value;
    if (firstName.trim() === "") {
        alert("First Name is required!");
        e.preventDefault();
    }

    // Validate last name
    let lastName = document.getElementById("lastName").value;
    if (lastName.trim() === "") {
        alert("Last Name is required!");
        e.preventDefault();
    }

    // Validate email
    let email = document.getElementById("email").value;
    if (!validateEmail(email)) {
        alert("Invalid email address!");
        e.preventDefault();
    }

    // Validate phone number
    let teleNo = document.getElementById("teleNo").value;
    if (teleNo.trim() === "") {
        alert("Phone number is required!");
        e.preventDefault();
    }

    // Validate payment option
    let paymentOption = document.getElementById("paymentOption").value;
    if (paymentOption === "") {
        alert("Please select a payment option!");
        e.preventDefault();
    }
});

function validateEmail(email) {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return re.test(email);
}

</script>