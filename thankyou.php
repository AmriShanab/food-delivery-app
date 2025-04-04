<?php
include "layouts/header.php";

// Get order ID from URL
$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Fetch order details from database
$order = null;
if ($orderId > 0) {
    include "database/dbconfig.php";
    $orderQuery = $db->prepare("SELECT * FROM orders WHERE id = ?");
    $orderQuery->execute([$orderId]);
    $order = $orderQuery->fetch();

    if ($order) {
        $itemsQuery = $db->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $itemsQuery->execute([$orderId]);
        $orderItems = $itemsQuery->fetchAll();
    }
}
?>

<div class="container my-5">
    <div class="text-center">
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#28a745" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
        </div>
        <h2 class="mb-3">Thank You for Your Order!</h2>

        <?php if ($order): ?>
            <div class="card mb-4 text-start">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Order #<?php echo htmlspecialchars($order['order_number']); ?></h5>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> <span class="badge bg-info"><?php echo ucfirst($order['status']); ?></span></p>
                    <p><strong>Order Date:</strong> <?php echo date('F j, Y \a\t g:i A', strtotime($order['created_at'])); ?></p>
                    <p><strong>Total:</strong> $<?php echo number_format($order['total'], 2); ?></p>

                    <h6 class="mt-4">Items Ordered:</h6>
                    <ul class="list-group">
                        <?php foreach ($orderItems as $item): ?>
                            <li class="list-group-item">
                                <?php echo htmlspecialchars($item['item_name']); ?> (<?php echo $item['size']; ?>)
                                - <?php echo $item['quantity']; ?> x $<?php echo number_format($item['price'], 2); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- Add this inside the order details card -->
                    <div class="text-center mt-3">
                        <a href="generate_invoice.php?order_id=<?php echo $orderId; ?>" class="btn btn-outline-primary">
                            <i class="bi bi-download button-color"></i> Download Invoice (PDF)
                        </a>
                    </div>
                </div>
            </div>

            <p class="lead mb-4">An order confirmation has been sent to <?php echo htmlspecialchars($order['email']); ?>.</p>
        <?php else: ?>
            <p class="lead mb-4">Your order has been received.</p>
        <?php endif; ?>

        <a href="restaurents.php" class="btn btn-primary mt-3 button-color">Back to Restaurants</a>
    </div>
</div>