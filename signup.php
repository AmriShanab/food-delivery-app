<?php
// File: signup.php (Frontend Only)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodExpress - Sign Up</title>
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
        
        .signup-container {
            background-color: rgba(20, 20, 20, 0.9);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 450px;
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
        
        .signup-form .input-group {
            margin-bottom: 15px;
            position: relative;
        }
        
        .signup-form .input-group input,
        .signup-form .input-group textarea {
            width: 100%;
            padding: 15px 15px 15px 45px;
            background-color: #2a2a2a;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .signup-form .input-group textarea {
            height: 80px;
            resize: vertical;
        }
        
        .signup-form .input-group input:focus,
        .signup-form .input-group textarea:focus {
            outline: none;
            background-color: #333;
            box-shadow: 0 0 0 2px rgb(255, 92, 51);
        }
        
        .signup-form .input-group i {
            position: absolute;
            left: 15px;
            top: 15px;
            color: rgb(255, 92, 51);
        }
        
        .signup-form button {
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
        
        .signup-form button:hover {
            background-color: rgb(255, 92, 51);
            transform: translateY(-2px);
        }
        
        .login-link {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
        }
        
        .login-link a {
            color: rgb(255, 92, 51);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .login-link a:hover {
            color: rgb(255, 92, 51);
            text-decoration: underline;
        }
        
        .password-toggle {
            position: absolute;
            right: 50px;
            top: 15px;
            cursor: pointer;
            color: #aaa;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="signup-container">
        <div class="logo">
            <h1>FoodExpress</h1>
            <p>Create your account to start ordering</p>
        </div>
        <form class="signup-form" action="signup_process.php" method="POST">
            <!-- Name -->
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="first_name" placeholder="First Name" required>
            </div>
            
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            
            <!-- Email -->
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            
            <!-- Address -->
            <div class="input-group">
                <i class="fas fa-map-marker-alt"></i>
                <textarea name="address" placeholder="Delivery Address" required></textarea>
            </div>
            
            <!-- Password -->
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <span class="password-toggle" onclick="toggleConfirmPassword()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            
            <!-- Phone -->
            <div class="input-group">
                <i class="fas fa-phone"></i>
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
            
            <button type="submit">SIGN UP</button>
            
            <div class="login-link">
                Already have an account? <a href="signin.php">Sign In</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.querySelector('#password + .password-toggle i');
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
        
        function toggleConfirmPassword() {
            const confirmPassword = document.getElementById('confirm_password');
            const icon = document.querySelector('#confirm_password + .password-toggle i');
            if (confirmPassword.type === 'password') {
                confirmPassword.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                confirmPassword.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
    <!-- frontend end -->
</html>


