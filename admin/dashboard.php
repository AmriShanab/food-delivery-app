<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
adminAuth();
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders/index.php">
                            <i class="bi bi-cart"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="restaurants/index.php">
                            <i class="bi bi-shop"></i> Restaurants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu_items/index.php">
                            <i class="bi bi-menu-button"></i> Menu Items
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users/index.php">
                            <i class="bi bi-people"></i> Users
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <p class="card-text"><?= $db->query("SELECT COUNT(*) FROM orders")->fetchColumn() ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Restaurants</h5>
                            <p class="card-text"><?= $db->query("SELECT COUNT(*) FROM restaurants")->fetchColumn() ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Menu Items</h5>
                            <p class="card-text"><?= $db->query("SELECT COUNT(*) FROM menu_items")->fetchColumn() ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text"><?= $db->query("SELECT COUNT(*) FROM users")->fetchColumn() ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Recent Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Restaurant</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $orders = $db->query("
                                    SELECT o.*, u.first_name AS customer_name, r.name AS restaurant_name 
                                    FROM orders o
                                    JOIN users u ON o.user_id = u.id
                                    JOIN restaurants r ON o.restaurant_id = r.id
                                    ORDER BY o.created_at DESC LIMIT 5
                                ")->fetchAll();
                                
                                foreach ($orders as $order):
                                ?>
                                <tr>
                                    <td><?= $order['order_number'] ?></td>
                                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                                    <td><?= htmlspecialchars($order['restaurant_name']) ?></td>
                                    <td>Rs. <?= number_format($order['total'], 2) ?></td>
                                    <td>
                                        <span class="badge bg-<?= 
                                            $order['status'] == 'completed' ? 'success' : 
                                            ($order['status'] == 'cancelled' ? 'danger' : 
                                            ($order['status'] == 'processing' ? 'warning' : 'primary'))
                                        ?>">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('M j, Y', strtotime($order['created_at'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
