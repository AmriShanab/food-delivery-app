<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
// adminAuth();

$restaurant_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // First get the image path to delete it
    $restaurant = $db->query("SELECT image FROM restaurants WHERE id = $restaurant_id")->fetch();
    
    // Delete the restaurant
    $stmt = $db->prepare("DELETE FROM restaurants WHERE id = ?");
    $stmt->execute([$restaurant_id]);
    
    // Delete the image file if exists
    if ($restaurant && $restaurant['image']) {
        $imagePath = '../../assets/images/restaurants/' . $restaurant['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $_SESSION['success_message'] = "Restaurant deleted successfully!";
    header("Location: index.php");
    exit();
}

// Fetch restaurant details for confirmation
$restaurant = $db->query("SELECT name FROM restaurants WHERE id = $restaurant_id")->fetch();

if (!$restaurant) {
    header("Location: index.php");
    exit();
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Delete Restaurant</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="index.php" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Restaurants
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p>Are you sure you want to delete the restaurant <strong><?= htmlspecialchars($restaurant['name']) ?></strong>?</p>
            <p class="text-danger">This action cannot be undone and will also delete all menu items associated with this restaurant.</p>
            
            <form method="POST">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
