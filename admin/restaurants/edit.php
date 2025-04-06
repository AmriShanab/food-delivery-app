<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
// adminAuth();

$restaurant_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch restaurant details
$restaurant = $db->query("SELECT * FROM restaurants WHERE id = $restaurant_id")->fetch();

if (!$restaurant) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $phone = $_POST['phone'] ?? '';
    
    // Handle image upload
    $image = $restaurant['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/images/restaurants/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        
        // Generate unique filename
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
        UPDATE restaurants 
        SET name = ?, 
            address = ?, 
            city = ?, 
            telephone_no = ?,
            image = ?
        WHERE id = ?
    ");
    $stmt->execute([$name, $address, $city, $phone, $image, $restaurant_id]);

    $_SESSION['success_message'] = "Restaurant updated successfully!";
    header("Location: index.php");
    exit();
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Restaurant</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="index.php" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Restaurants
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Restaurant Name</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= htmlspecialchars($restaurant['name']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" 
                               value="<?= htmlspecialchars($restaurant['telephone_no']) ?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" 
                               value="<?= htmlspecialchars($restaurant['address']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" 
                               value="<?= htmlspecialchars($restaurant['city']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Restaurant Image</label>
                    <?php if ($restaurant['image']): ?>
                        <div class="mb-2">
                            <img src="../../assets/images/<?= htmlspecialchars($restaurant['image']) ?>" 
                                 width="100" class="img-thumbnail">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <button type="submit" class="btn btn-primary">Update Restaurant</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
