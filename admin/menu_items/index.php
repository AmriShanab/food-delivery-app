<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
// adminAuth();

// Get restaurant_id if passed (for filtered view)
$restaurant_id = isset($_GET['restaurant_id']) ? intval($_GET['restaurant_id']) : 0;

// Get restaurant name if filtered
$restaurant_name = '';
if ($restaurant_id) {
    $restaurant = $db->query("SELECT name FROM restaurants WHERE id = $restaurant_id")->fetch();
    $restaurant_name = $restaurant ? $restaurant['name'] : '';
}
?>

<div class="container-fluid">
    <br><br>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <br><br><br><br><br>
        <h1 class="h2">
            <?= $restaurant_id ? "Menu Items for " . htmlspecialchars($restaurant_name) : "All Menu Items" ?>
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="create.php<?= $restaurant_id ? '?restaurant_id='.$restaurant_id : '' ?>" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-plus"></i> Add New Menu Item
            </a>
            <a href="../dashboard.php" class="btn btn-sm btn-outline-secondary" style="margin-left: 20px;">
                <i class="bi bi-arrow-left"></i> Back to Restaurants
            </a>
            <?php if ($restaurant_id): ?>
                <a href="../restaurants/" class="btn btn-sm btn-outline-secondary ms-2">
                    <i class="bi bi-arrow-left"></i> Back to Restaurants
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="menuItemsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Restaurant</th>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Base query
                        $query = "
                            SELECT mi.*, r.name as restaurant_name 
                            FROM menu_items mi
                            JOIN restaurants r ON mi.restaurant_id = r.id
                        ";
                        
                        // Add filter if restaurant_id is set
                        if ($restaurant_id) {
                            $query .= " WHERE mi.restaurant_id = $restaurant_id";
                        }
                        
                        $query .= " ORDER BY mi.name ASC";
                        
                        $menu_items = $db->query($query)->fetchAll();
                        
                        foreach ($menu_items as $item):
                        ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td>
                                <?php if (!empty($item['image'])): ?>
                                    <img src="../../assets/images/<?= htmlspecialchars($item['image']) ?>" 
                                         width="50" height="50" 
                                         class="img-thumbnail" 
                                         alt="<?= htmlspecialchars($item['name']) ?>">
                                <?php else: ?>
                                    <span class="text-muted">No image</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= htmlspecialchars($item['restaurant_name']) ?></td>
                            <td>Rs. <?= number_format($item['price'], 2) ?></td>
                            <td><?= date('M d, Y h:i A', strtotime($item['created_at'])) ?></td>
                            <td><?= date('M d, Y h:i A', strtotime($item['updated_at'])) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="delete.php?id=<?= $item['id'] ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   title="Delete"
                                   onclick="return confirm('Are you sure you want to delete this menu item?')">
                                    <i class="bi bi-trash"></i>
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
