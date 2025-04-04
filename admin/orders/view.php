<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
// adminAuth();

$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch order details with restaurant information
$order = $db->query("
    SELECT o.*, r.name as restaurant_name, r.address as restaurant_address
    FROM orders o
    LEFT JOIN restaurants r ON o.restaurant_id = r.id
    WHERE o.id = $order_id
")->fetch();

if (!$order) {
    header("Location: index.php");
    exit();
}

// Fetch order items if you have an order_items table
$order_items = $db->query("
    SELECT oi.*, mi.name as item_name, mi.price as item_price
    FROM order_items oi
    JOIN menu_items mi ON oi.menu_item_id = mi.id
    WHERE oi.order_id = $order_id
")->fetchAll();
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Order Details #<?= htmlspecialchars($order['order_number']) ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="index.php" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Customer Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> <?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
                    <p><strong>Delivery Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Order Summary</h5>
                </div>
                <div class="card-body">
                    <p><strong>Restaurant:</strong> <?= htmlspecialchars($order['restaurant_name']) ?></p>
                    <p><strong>Order Date:</strong> <?= date('M d, Y h:i A', strtotime($order['created_at'])) ?></p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-<?= getStatusColor($order['status']) ?>">
                            <?= ucfirst($order['status']) ?>
                        </span>
                    </p>
                    <p><strong>Payment Method:</strong> <?= strtoupper($order['payment_method']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Order Items</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['item_name']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>Rs. <?= number_format($item['item_price'], 2) ?></td>
                            <td>Rs. <?= number_format($item['item_price'] * $item['quantity'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="table-light">
                            <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                            <td><strong>Rs. <?= number_format($order['subtotal'], 2) ?></strong></td>
                        </tr>
                        <tr class="table-light">
                            <td colspan="3" class="text-end"><strong>Delivery Fee:</strong></td>
                            <td><strong>Rs. <?= number_format($order['delivery_fee'], 2) ?></strong></td>
                        </tr>
                        <tr class="table-primary">
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>Rs. <?= number_format($order['total'], 2) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if (!empty($order['additional_info'])): ?>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Additional Information</h5>
        </div>
        <div class="card-body">
            <p><?= nl2br(htmlspecialchars($order['additional_info'])) ?></p>
        </div>
    </div>
    <?php endif; ?>

    <div class="d-flex justify-content-end">
        <a href="edit.php?id=<?= $order['id'] ?>" class="btn btn-primary me-2">
            <i class="bi bi-pencil"></i> Edit Order
        </a>
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-list"></i> Back to Orders
        </a>
    </div>
</div>

<?php 
function getStatusColor($status) {
    switch ($status) {
        case 'completed': return 'success';
        case 'processing': return 'primary';
        case 'cancelled': return 'danger';
        default: return 'warning';
    }
}

?>