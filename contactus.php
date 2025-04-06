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
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .alert-success {
            background-color: rgba(0, 128, 0, 0.2);
            color: #4CAF50;
            border: 1px solid #4CAF50;
        }
        
        .alert-danger {
            background-color: rgba(255, 0, 0, 0.2);
            color: #f44336;
            border: 1px solid #f44336;
        }
        
        .contact-form .input-group {
            margin-bottom: 15px;
            position: relative;
        }
        
        .contact-form .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #ddd;
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
        
        .error-message {
            color: #f44336;
            font-size: 0.8rem;
            margin-top: 5px;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="contact-container">
        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($errors['database'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($errors['database']); ?>
            </div>
        <?php endif; ?>
        
        <div class="logo">
            <h1>FoodExpress</h1>
            <p>We'd love to hear from you</p>
        </div>
        
        <form class="contact-form" action="process_contact.php" method="POST">
            <div class="input-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required 
                       value="<?php echo htmlspecialchars($form_data['name'] ?? ''); ?>">
                <?php if (isset($errors['name'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['name']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Email Address" required 
                       value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['email']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="input-group">
                <label for="subject">Subject</label>
                <select id="subject" name="subject" required>
                    <option value="" disabled selected>Select Subject</option>
                    <option value="Order Issue" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Order Issue') ? 'selected' : ''; ?>>Order Issue</option>
                    <option value="Feedback" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Feedback') ? 'selected' : ''; ?>>Feedback</option>
                    <option value="Business Inquiry" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Business Inquiry') ? 'selected' : ''; ?>>Business Inquiry</option>
                    <option value="Other" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
                <?php if (isset($errors['subject'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['subject']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="input-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" placeholder="Your Message" required><?php echo htmlspecialchars($form_data['message'] ?? ''); ?></textarea>
                <?php if (isset($errors['message'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['message']); ?></span>
                <?php endif; ?>
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