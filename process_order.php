<?php
header('Content-Type: application/json');

include "database/dbconfig.php";

// Get the POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

try {
    // Start transaction
    $db->beginTransaction();

    // Generate order number
    $orderNumber = 'ORD-' . strtoupper(uniqid());

    // Insert order into database
    $orderQuery = $db->prepare("
        INSERT INTO orders (
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
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $cardDetails = ($data['paymentMethod'] === 'card') ? json_encode($data['cardDetails']) : null;
    
    $orderQuery->execute([
        $orderNumber,
        $data['firstName'],
        $data['lastName'],
        $data['email'],
        $data['phone'],
        $data['address'],
        $data['paymentMethod'],
        $cardDetails,
        $data['additionalInfo'],
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

    // Commit transaction
    $db->commit();

    echo json_encode([
        'success' => true,
        'order_id' => $orderId,
        'order_number' => $orderNumber
    ]);

} catch (PDOException $e) {
    $db->rollBack();
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>