<?php
session_start();
include "layouts/header.php";
include "database/dbconfig.php";

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$tele_no = $_POST['tele_no'];
$address = $_POST['address'];
$paymentOption = $_POST['payment_option'];
$additionalInfo = $_POST['additional_info'];


$total = $_SESSION["total"];

$query = $db->prepare("INSERT INTO orders (first_name, last_name, email, tele_no, address, payment_option, additional_info, total) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$query->execute([$firstName, $lastName, $email, $tele_no, $address, $paymentOption, $additionalInfo, $total]);
$orderId = $db->lastInsertId();

unset($_SESSION["cart"]);
unset($_SESSION["total"]);

// Set success message in session
$_SESSION['success_message'] = "Order placed successfully! Redirecting to dashboard...";
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