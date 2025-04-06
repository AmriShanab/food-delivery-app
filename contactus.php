<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
$success = $_SESSION['success'] ?? '';
unset($_SESSION['errors']);
unset($_SESSION['form_data']);
unset($_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodExpress - Contact Us</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #121212;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
        }

        .contact-container {
            background-color: rgba(20, 20, 20, 0.9);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            border-top: 3px solid rgb(255, 92, 51);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            color: rgb(255, 92, 51);
            font-size: 2.5rem;
            margin-bottom: 5px;
        }

        .logo p {
            color: #aaa;
            font-size: 0.9rem;
        }

        .contact-form .input-group {
            margin-bottom: 15px;
            position: relative;
        }

        .contact-form .input-group input,
        .contact-form .input-group textarea,
        .contact-form .input-group select {
            width: 100%;
            padding: 15px;
            background-color: #2a2a2a;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .contact-form .input-group textarea {
            height: 120px;
            resize: vertical;
        }

        .contact-form .input-group input:focus,
        .contact-form .input-group textarea:focus,
        .contact-form .input-group select:focus {
            outline: none;
            background-color: #333;
            box-shadow: 0 0 0 2px rgb(255, 92, 51);
        }

        .contact-form button {
            width: 100%;
            padding: 15px;
            background-color: rgb(255, 92, 51);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .contact-form button:hover {
            background-color: rgb(255, 110, 70);
            transform: translateY(-2px);
        }

        .contact-info {
            margin-top: 30px;
            border-top: 1px solid #333;
            padding-top: 20px;
        }

        .contact-info p {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #aaa;
        }

        .contact-info i {
            color: rgb(255, 92, 51);
            font-size: 1.1rem;
        }

        .social-links {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        .social-links a {
            color: #aaa;
            font-size: 1.5rem;
            transition: all 0.3s;
        }

        .social-links a:hover {
            color: rgb(255, 92, 51);
        }
    </style>
</head>

<body>
    <div class="contact-container">
        <?php if (!empty($success)): ?>
            <div class="alert alert-success" style="color: green; margin-bottom: 20px;">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($errors['database'])): ?>
            <div class="alert alert-danger" style="color: red; margin-bottom: 20px;">
                <?php echo htmlspecialchars($errors['database']); ?>
            </div>
        <?php endif; ?>
        <div class="logo">
            <h1>FoodExpress</h1>
            <p>We'd love to hear from you</p>
        </div>

        <form class="contact-form" action="process_contact.php" method="POST">
            <div class="input-group">
                <input type="text" name="name" placeholder="Your Name" required>
            </div>

            <div class="input-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <div class="input-group">
                <select name="subject" required>
                    <option value="" disabled selected>Select Subject</option>
                    <option>Order Issue</option>
                    <option>Feedback</option>
                    <option>Business Inquiry</option>
                    <option>Other</option>
                </select>
            </div>

            <div class="input-group">
                <textarea name="message" placeholder="Your Message" required></textarea>
            </div>

            <button type="submit">SEND MESSAGE</button>
        </form>

        <div class="contact-info">
            <p><i class="fas fa-phone"></i> +9475 206 7852</p>
            <p><i class="fas fa-envelope"></i> support@foodexpress.com</p>
            <p><i class="fas fa-map-marker-alt"></i> 123 Food Street, Foodville</p>

            <div class="social-links">
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</body>

</html>