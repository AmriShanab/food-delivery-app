<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Food Delivery</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Only include Leaflet CSS here -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Bootstrap 5 CSS -->
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
=======
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
>>>>>>> e93fe8dcdb6c01b59fb24ad707b4c7e030e4b6f0
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <a href="dashboard.php">🍽️ FoodExpress</a>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Home</a></li>
            <li><a href="restaurents.php" class="<?= basename($_SERVER['PHP_SELF']) == 'restaurents.php' ? 'active' : '' ?>">Restaurants</a></li>
            <li><a href="cart.php" class="<?= basename($_SERVER['PHP_SELF']) == 'cart.php' ? 'active' : '' ?>">Cart</a></li>
            <li><a href="orders.php" class="<?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : '' ?>">Orders</a></li>
            <li><a href="contact.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">👤 Account ▾</a>
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <a href="settings.php">Settings</a>
                    <a href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">☰</div>
    </nav>