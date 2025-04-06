<?php
session_start();
include "layouts/header.php";
require_once 'database/dbconfig.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please login.");
}

$user_id = $_SESSION['user_id'];

// Fetch user's orders
$sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
    .orders-container {
    max-width: 1000px;
    margin: 120px auto 40px auto; /* push down below navbar */
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.orders-container h2 {
    color: #3E2723;
    font-size: 2rem;
    margin-bottom: 25px;
    border-left: 5px solid #FF7F11;
    padding-left: 15px;
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
}

.orders-table th,
.orders-table td {
    padding: 12px 15px;
    text-align: left;
}

.orders-table th {
    background-color: #FF7F11;
    color: white;
    font-weight: 600;
}

.orders-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.orders-table tr:hover {
    background-color: #f1f1f1;
}

.orders-table ul {
    padding-left: 20px;
    margin: 0;
    list-style-type: square;
    color: #3E2723;
}

.orders-table li {
    margin-bottom: 4px;
}

.status {
    font-weight: 600;
    text-transform: capitalize;
}

.status.pending {
    color: #FF7F11;
}

.status.processing {
    color: #007BFF;
}

.status.completed {
    color: green;
}

.status.cancelled {
    color: red;
}

</style>
<div class="orders-container">
    <h2>Your Orders</h2>

    <?php if (count($orders) > 0): ?>
        <table class="orders-table">
            <tr>
                <th>Order ID</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            <?php foreach ($orders as $order): ?>
                <?php
                $item_sql = "SELECT item_name, quantity, price, size FROM order_items WHERE order_id = :order_id";
                $item_stmt = $db->prepare($item_sql);
                $item_stmt->bindParam(':order_id', $order['id'], PDO::PARAM_INT);
                $item_stmt->execute();
                $items = $item_stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <tr>
                    <td><?= htmlspecialchars($order['id']) ?></td>
                    <td>
                        <ul>
                            <?php foreach ($items as $item): ?>
                                <li>
                                    <?= htmlspecialchars($item['item_name']) ?> 
                                    (<?= htmlspecialchars($item['size']) ?>) × <?= htmlspecialchars($item['quantity']) ?> 
                                    @ Rs. <?= htmlspecialchars(number_format($item['price'], 2)) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>Rs. <?= htmlspecialchars(number_format($order['total'], 2)) ?></td>
                    <td class="status <?= htmlspecialchars($order['status']) ?>">
                        <?= ucfirst(htmlspecialchars($order['status'])) ?>
                    </td>
                    <td><?= htmlspecialchars($order['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
</div>
<?php include "layouts/footer.php"; ?>