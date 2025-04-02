<?php
session_start(); // Start the session

// Check if the cart session exists, if not, create an empty cart
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Example of adding an item to the cart
$item = [
    "name" => $_POST['name'],  // Item name
    "price" => $_POST['price'], // Item price
    "quantity" => $_POST['quantity'], // Item quantity
    "size" => $_POST['size'] // Item size
];


$_SESSION["cart"][] = $item;

$total = 0;
foreach ($_SESSION["cart"] as $item) {
    $total += $item["price"] * $item["quantity"];
}
$_SESSION["total"] = $total; 
echo $_SESSION["total"];

// Optionally, return a response
echo "Item added to cart! Total: $" . number_format($total, 2);
?>
