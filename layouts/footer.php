<style>
    .site-footer {
    background-color: #3E2723;
    color: white;
    padding: 40px 20px 20px 20px;
    font-size: 0.95rem;
    margin-top: 80px;
    border-top: 5px solid #FF7F11;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    gap: 20px;
}

.footer-section {
    flex: 1;
    min-width: 250px;
}

.footer-section h4 {
    font-size: 1.2rem;
    margin-bottom: 15px;
    color: #FF7F11;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: white;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-section ul li a:hover {
    color: #FF7F11;
}

.footer-bottom {
    text-align: center;
    margin-top: 30px;
    border-top: 1px solid #ffffff2f;
    padding-top: 15px;
    font-size: 0.85rem;
    color: #ccc;
}

</style>

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h4>About Us</h4>
            <p>Your trusted partner for delicious food delivery and quality service. Fast, reliable, and always fresh!</p>
        </div>
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="orders.php">My Orders</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="signin.php">Logout</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Contact Us</h4>
            <p>Email: foodexpress@gmail.com</p>
            <p>Phone: +94 77 123 4567</p>
            <p>Address: Colombo, Sri Lanka</p>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; <?= date('Y') ?> FoodExpress. All rights reserved.
    </div>
</footer>
