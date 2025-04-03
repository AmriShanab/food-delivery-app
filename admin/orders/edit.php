<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
// adminAuth();

$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch order details
$order = $db->query("
    SELECT o.*, r.name as restaurant_name 
    FROM orders o
    LEFT JOIN restaurants r ON o.restaurant_id = r.id
    WHERE o.id = $order_id
")->fetch();

if (!$order) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'] ?? '';
    $payment_method = $_POST['payment_method'] ?? '';
    $additional_info = $_POST['additional_info'] ?? '';

    // Validate inputs
    $valid_statuses = ['pending', 'processing', 'completed', 'cancelled'];
    $valid_payment_methods = ['COD', 'card'];

    if (in_array($status, $valid_statuses) && in_array($payment_method, $valid_payment_methods)) {
        $stmt = $db->prepare("
            UPDATE orders 
            SET status = ?, 
                payment_method = ?, 
                additional_info = ?,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        $stmt->execute([$status, $payment_method, $additional_info, $order_id]);

        $_SESSION['success_message'] = "Order updated successfully!";
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid status or payment method selected";
    }
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Order #<?= htmlspecialchars($order['order_number']) ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="index.php" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Order Number</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($order['order_number']) ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Customer</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?>" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Restaurant</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($order['restaurant_name'] ?? 'N/A') ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Amount</label>
                        <input type="text" class="form-control" value="Rs. <?= number_format($order['total'], 2) ?>" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                            <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="COD" <?= $order['payment_method'] === 'COD' ? 'selected' : '' ?>>Cash on Delivery</option>
                            <option value="card" <?= $order['payment_method'] === 'card' ? 'selected' : '' ?>>Credit/Debit Card</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="additional_info" class="form-label">Additional Information</label>
                    <textarea class="form-control" id="additional_info" name="additional_info" rows="3"><?= htmlspecialchars($order['additional_info'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Order Date</label>
                    <input type="text" class="form-control" value="<?= date('M d, Y h:i A', strtotime($order['created_at'])) ?>" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Update Order</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
