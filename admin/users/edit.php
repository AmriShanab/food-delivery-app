<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch user details
$user = $db->query("SELECT * FROM users WHERE id = $user_id")->fetch();

if (!$user) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name   = trim($_POST['first_name'] ?? '');
    $last_name    = trim($_POST['last_name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $address      = trim($_POST['address'] ?? '');
    $is_active    = isset($_POST['is_active']) ? 1 : 0;

    if ($first_name && $last_name && $email) {
        // Update user
        $stmt = $db->prepare("
            UPDATE users 
            SET first_name = ?, 
                last_name = ?, 
                email = ?, 
                phone = ?, 
                address = ?, 
                is_active = ?
            WHERE id = ?
        ");
        $stmt->execute([$first_name, $last_name, $email, $phone, $address, $is_active, $user_id]);

        $_SESSION['success_message'] = "User updated successfully!";
        header("Location: index.php");
        exit();
    } else {
        $error = "First name, last name, and email are required.";
    }
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User #<?= htmlspecialchars($user['id']) ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="index.php" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Users
            </a>
        </div>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($user['address']) ?></textarea>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" <?= $user['is_active'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_active">
                        Active User
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
