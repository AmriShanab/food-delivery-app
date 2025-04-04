<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodExpress - Sign In</title>
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
        
        .login-container {
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
            color:rgb(255, 92, 51);
            font-size: 2.5rem;
            margin-bottom: 5px;
        }
        
        .logo p {
            color: #aaa;
            font-size: 0.9rem;
        }
        
        .login-form .input-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .login-form .input-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            background-color: #2a2a2a;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .login-form .input-group input:focus {
            outline: none;
            background-color: #333;
            box-shadow: 0 0 0 2px rgb(255, 92, 51);
        }
        
        .login-form .input-group i {
            position: absolute;
            left: 15px;
            top: 15px;
            color: rgb(255, 92, 51);
        }
        
        .login-form button {
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
        
        .login-form button:hover {
            background-color: rgb(255, 92, 51);
            transform: translateY(-2px);
        }
        
        .additional-links {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
        }
        
        .additional-links a {
            color: rgb(255, 92, 51);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .additional-links a:hover {
            color: #ff5555;
            text-decoration: underline;
        }
        
        .error-message {
            color:rgb(255, 92, 51);
            text-align: center;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>FoodExpress</h1>
            <p>Your favorite meals delivered right to your doorstep</p>
        </div>
        
        <form class="login-form" action="login.php" method="POST">
            <div class="error-message" id="error-message"></div>
            
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <button type="submit">SIGN IN</button>
            
            <div class="additional-links">
                <a href="#">Forgot Password?</a> • <a href="#">Create Account</a>
            </div>
        </form>
    </div>
</body>
</html>