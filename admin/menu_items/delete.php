<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
// adminAuth();

$item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$restaurant_id = isset($_GET['restaurant_id']) ? intval($_GET['restaurant_id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // First get the image path to delete it
    $menu_item = $db->query("SELECT image FROM menu_items WHERE id = $item_id")->fetch();
    
    // Delete the menu item
    $stmt = $db->prepare("DELETE FROM menu_items WHERE id = ?");
    $stmt->execute([$item_id]);
    
    // Delete the image file if exists
    if ($menu_item && $menu_item['image']) {
        $imagePath = '../../assets/images/menu_items/' . $menu_item['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $_SESSION['success_message'] = "Menu item deleted successfully!";
    header("Location: index.php" . ($restaurant_id ? "?restaurant_id=$restaurant_id" : ""));
    exit();
}

// Fetch menu item details for confirmation
$menu_item = $db->query("
    SELECT m.name, r.name as restaurant_name 
    FROM menu_items m
    JOIN restaurants r ON m.restaurant_id = r.id
    WHERE m.id = $item_id
")->fetch();

if (!$menu_item) {
    header("Location: index.php" . ($restaurant_id ? "?restaurant_id=$restaurant_id" : ""));
    exit();
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Delete Menu Item</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="index.php<?= $restaurant_id ? "?restaurant_id=$restaurant_id" : '' ?>" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Menu Items
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p>Are you sure you want to delete the menu item <strong><?= htmlspecialchars($menu_item['name']) ?></strong> from <strong><?= htmlspecialchars($menu_item['restaurant_name']) ?></strong>?</p>
            <p class="text-danger">This action cannot be undone.</p>
            
            <form method="POST">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a href="index.php<?= $restaurant_id ? "?restaurant_id=$restaurant_id" : '' ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
