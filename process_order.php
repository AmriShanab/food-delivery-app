<?php
session_start();
header('Content-Type: application/json');
require_once 'database/dbconfig.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in.'
    ]);
    exit;
}

$userId = $_SESSION['user_id'];

// Get POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validate required fields (optional but recommended)
$requiredFields = ['firstName', 'lastName', 'email', 'phone', 'address', 'paymentMethod', 'subtotal', 'deliveryFee', 'total', 'restaurant_id', 'cart'];
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        echo json_encode([
            'success' => false,
            'message' => "Missing required field: $field"
        ]);
        exit;
    }
}

try {
    $db->beginTransaction();

    // Generate unique order number
    $orderNumber = 'ORD-' . strtoupper(uniqid());

    // Prepare card details if payment method is card
    $cardDetails = ($data['paymentMethod'] === 'card') ? json_encode($data['cardDetails']) : null;

    // Insert into orders table
    $orderQuery = $db->prepare("
        INSERT INTO orders (
            user_id,
            order_number, 
            first_name, 
            last_name, 
            email, 
            phone, 
            address, 
            payment_method, 
            card_details, 
            additional_info, 
            subtotal, 
            delivery_fee, 
            total,
            restaurant_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $orderQuery->execute([
        $userId,
        $orderNumber,
        $data['firstName'],
        $data['lastName'],
        $data['email'],
        $data['phone'],
        $data['address'],
        $data['paymentMethod'],
        $cardDetails,
        $data['additionalInfo'] ?? null,
        $data['subtotal'],
        $data['deliveryFee'],
        $data['total'],
        $data['restaurant_id']
    ]);

    $orderId = $db->lastInsertId();

    // Insert order items
    $itemQuery = $db->prepare("
        INSERT INTO order_items (
            order_id, 
            menu_item_id, 
            item_name, 
            quantity, 
            price, 
            size
        ) VALUES (?, ?, ?, ?, ?, ?)
    ");

    foreach ($data['cart'] as $item) {
        $itemQuery->execute([
            $orderId,
            $item['id'],
            $item['name'],
            $item['quantity'],
            $item['price'],
            $item['size']
        ]);
    }

    $db->commit();

    echo json_encode([
        'success' => true,
        'order_id' => $orderId,
        'order_number' => $orderNumber,
        'message' => 'Order placed successfully!'
    ]);

} catch (PDOException $e) {
    $db->rollBack();
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
