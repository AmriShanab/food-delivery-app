<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
// adminAuth();

$item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$restaurant_id = isset($_GET['restaurant_id']) ? intval($_GET['restaurant_id']) : 0;

// Fetch menu item details
$menu_item = $db->query("SELECT * FROM menu_items WHERE id = $item_id")->fetch();

if (!$menu_item) {
    header("Location: index.php" . ($restaurant_id ? "?restaurant_id=$restaurant_id" : ""));
    exit();
}

// Fetch all restaurants for dropdown
$restaurants = $db->query("SELECT id, name FROM restaurants ORDER BY name")->fetchAll();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $restaurant_id = $_POST['restaurant_id'] ?? 0;
    
    // Handle image upload
    $image = $menu_item['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/images/menu_items/';
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $ext;
        $targetFile = $uploadDir . $filename;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Delete old image if exists
            if ($image && file_exists($uploadDir . $image)) {
                unlink($uploadDir . $image);
            }
            $image = $filename;
        }
    }

    $stmt = $db->prepare("
        UPDATE menu_items 
        SET name = ?, 
            price = ?, 
            restaurant_id = ?,
            image = ?
        WHERE id = ?
    ");
    $stmt->execute([$name, $price, $restaurant_id, $image, $item_id]);

    $_SESSION['success_message'] = "Menu item updated successfully!";
    header("Location: index.php" . ($restaurant_id ? "?restaurant_id=$restaurant_id" : ""));
    exit();
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Menu Item</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="index.php<?= $restaurant_id ? "?restaurant_id=$restaurant_id" : '' ?>" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Menu Items
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= htmlspecialchars($menu_item['name']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" 
                               value="<?= htmlspecialchars($menu_item['price']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="restaurant_id" class="form-label">Restaurant</label>
                    <select class="form-select" id="restaurant_id" name="restaurant_id" required>
                        <option value="">Select Restaurant</option>
                        <?php foreach ($restaurants as $restaurant): ?>
                            <option value="<?= $restaurant['id'] ?>" 
                                <?= $restaurant['id'] == $menu_item['restaurant_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($restaurant['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Item Image</label>
                    <?php if ($menu_item['image']): ?>
                        <div class="mb-2">
                            <img src="../../assets/images/<?= htmlspecialchars($menu_item['image']) ?>" 
                                 width="100" class="img-thumbnail">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <button type="submit" class="btn btn-primary">Update Item</button>
                <a href="index.php<?= $restaurant_id ? "?restaurant_id=$restaurant_id" : '' ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
