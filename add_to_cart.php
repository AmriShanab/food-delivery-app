<?php
session_start(); // Start the session

// Check if the cart session exists, if not, create an empty cart
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Ensure the necessary data is present in the POST request and that values are valid
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['size'])) {
    
    // Get and sanitize the inputs
    $name = trim($_POST['name']);
    $price = (float)$_POST['price'];  // Convert to float
    $quantity = (int)$_POST['quantity'];  // Convert to int
    $size = trim($_POST['size']);
    
    // Validate the inputs: Ensure price and quantity are greater than 0 and fields are not empty
    if ($price > 0 && $quantity > 0 && !empty($name) && !empty($size)) {
        // Add item to the session cart
        $item = [
            "name" => $name,  // Item name
            "price" => $price, // Item price
            "quantity" => $quantity, // Item quantity
            "size" => $size // Item size
        ];

        // Add item to the session cart
        $_SESSION["cart"][] = $item;

        // Calculate the total in the session after adding the item
        $total = 0;
        foreach ($_SESSION["cart"] as $item) {
            $total += $item["price"] * $item["quantity"];
        }
        $_SESSION["total"] = $total; // Store the updated total in the session

        // Optionally, return a response
        echo "Item added to cart! Total: $" . number_format($total, 2);
    } else {
        // Handle validation failure: missing or invalid data
        echo "Invalid item data. Ensure price and quantity are greater than 0 and all fields are filled.";
    }
} else {
    echo "Missing data in POST request.";
}
?>
