<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
adminAuth();

// Fetch all restaurants for the dropdown
$restaurants = $db->query("SELECT id, name FROM restaurants ORDER BY name ASC")->fetchAll();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $restaurant_id = $_POST['restaurant_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_POST['image'] ?? '';

    // Basic validation
    if ($restaurant_id && $name && $price && $image) {
        $stmt = $db->prepare("INSERT INTO menu_items (restaurant_id, name, price, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$restaurant_id, $name, $price, $image]);
        $_SESSION['success_message'] = "Menu item added successfully.";
        header("Location: index.php");
        exit();
    } else {
        $error = "All fields are required.";
    }
}
?>

<div class="container mt-4">
    <h2>Add New Menu Item</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Restaurant</label>
            <select name="restaurant_id" id="restaurant_id" class="form-select" required>
                <option value="">-- Select Restaurant --</option>
                <?php foreach ($restaurants as $restaurant): ?>
                    <option value="<?= $restaurant['id'] ?>"><?= htmlspecialchars($restaurant['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Menu Item Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (e.g., 9.99)</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
