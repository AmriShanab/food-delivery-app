<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Food Delivery</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar {
            background-color: #121212 !important; 
            color: rgb(255, 92, 51) !important; 
            padding: 15px 30px;
        }

        .nav-links a {
            color: white !important; 
        }

        .navbar .logo a {
            color: rgb(255, 92, 51) !important; 
        }

        .nav-links a:hover {
            background-color: rgb(218, 184, 175) !important; 
        }

        .user-profile-link {
            display: flex;
            align-items: center;
            gap: 2px;
            padding: 2px 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .user-profile-link:hover {
            background-color: rgb(255, 92, 51) !important;
            text-decoration: none;
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: rgb(255, 92, 51);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <a href="dashboard.php">🍽️ FoodExpress</a>
        </div>
        <ul class="nav-links" style="margin-top: 15px;">
            <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Home</a></li>
            <li><a href="restaurents.php" class="<?= basename($_SERVER['PHP_SELF']) == 'restaurents.php' ? 'active' : '' ?>">Restaurants</a></li>
            <li><a href="cart.php" class="<?= basename($_SERVER['PHP_SELF']) == 'cart.php' ? 'active' : '' ?>">Cart</a></li>
            <li><a href="orders.php" class="<?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : '' ?>">Orders</a></li>
            <li><a href="contactus.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contactus.php' ? 'active' : '' ?>">Contact</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="signin.php">Logout</a></li>
                <a href="profile.php" class="user-profile-link" style="margin-bottom: -15px; margin-top: -10px;">
                        <div class="user-avatar">
                            <?= substr($_SESSION['username'] ?? 'U', 0, 1) ?>
                        </div>
                        <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
                    </a>
            <?php else: ?>
                <li><a href="signin.php">Login</a></li>
                <li><a href="signup.php">Register</a></li>
            <?php endif; ?>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">☰</div>
    </nav>  