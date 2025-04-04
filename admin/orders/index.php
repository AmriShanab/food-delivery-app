<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
// adminAuth();
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <br><br><br><br><br>
        <h1 class="h2">Orders</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="ordersTable">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Restaurant</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query to get orders with restaurant name
                        $orders = $db->query("
                            SELECT o.*, r.name as restaurant_name 
                            FROM orders o
                            LEFT JOIN restaurants r ON o.restaurant_id = r.id
                            ORDER BY o.created_at DESC
                        ")->fetchAll();
                        
                        foreach ($orders as $order):
                            $statusClass = '';
                            switch ($order['status']) {
                                case 'completed':
                                    $statusClass = 'bg-success';
                                    break;
                                case 'processing':
                                    $statusClass = 'bg-primary';
                                    break;
                                case 'cancelled':
                                    $statusClass = 'bg-danger';
                                    break;
                                default:
                                    $statusClass = 'bg-warning';
                            }
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_number']) ?></td>
                            <td><?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></td>
                            <td>
                                <?= htmlspecialchars($order['email']) ?><br>
                                <?= htmlspecialchars($order['phone']) ?>
                            </td>
                            <td><?= htmlspecialchars($order['address']) ?></td>
                            <td><?= htmlspecialchars($order['restaurant_name'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars(strtoupper($order['payment_method'])) ?></td>
                            <td>Rs. <?= number_format($order['total'], 2) ?></td>
                            <td>
                                <span class="badge <?= $statusClass ?>">
                                    <?= htmlspecialchars(ucfirst($order['status'])) ?>
                                </span>
                            </td>
                            <td><?= date('M d, Y h:i A', strtotime($order['created_at'])) ?></td>
                            <td>
                                <a href="view.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-primary" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="edit.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
