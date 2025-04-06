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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
        .navbar {
            background-color: #121212 !important; /* Force black background */
            color: rgb(255, 92, 51) !important; /* White text for contrast */
            padding: 15px 30px;
        }

        .nav-links a {
            color: white !important; /* Ensure link color is white */
        }

        .navbar .logo a {
            color: rgb(255, 92, 51) !important; /* Logo color */
        }

        .nav-links a:hover {
            background-color: rgb(255, 92, 51) !important; /* Hover effect */
        }

        .dropdown-content a:hover {
            background-color: rgb(255, 92, 51) !important; /* Hover effect for dropdown */
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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