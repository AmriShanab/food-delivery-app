<?php
session_start();
include "layouts/header.php";
require_once 'database/dbconfig.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please login.");
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT * FROM users WHERE id = :user_id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}
?>
<style>
    .profile-container {
    max-width: 800px;
    margin: 120px auto 40px auto;
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.profile-container h2 {
    color: #3E2723;
    font-size: 2rem;
    margin-bottom: 25px;
    border-left: 5px solid #FF7F11;
    padding-left: 15px;
}

.profile-card {
    background-color: #fdfdfd;
    padding: 25px;
    border-radius: 10px;
    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
}

.profile-row {
    font-size: 1rem;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    color: #333;
}

.profile-row strong {
    color: #FF7F11;
    min-width: 140px;
    display: inline-block;
}

</style>
<div class="profile-container">
    <h2>My Profile</h2>
    <div class="profile-card">
        <div class="profile-row"><strong>Full Name:</strong> <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></div>
        <div class="profile-row"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></div>
        <div class="profile-row"><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></div>
        <div class="profile-row"><strong>Address:</strong> <?= nl2br(htmlspecialchars($user['address'])) ?></div>
        <div class="profile-row"><strong>Registered At:</strong> <?= htmlspecialchars($user['created_at']) ?></div>
    </div>
</div>
<?php include "layouts/footer.php"; ?>
