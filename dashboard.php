<?php
include "layouts/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Food Delivery</title>
    <link rel="stylesheet" href="assets/styles.css"> <!-- Link your CSS file -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script defer src="assets/script.js"></script> <!-- JavaScript for menu toggle -->
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!-- About & Rider Section -->
    <div class="about-rider-section">
        <!-- Left Side: About Section -->
        <div class="about-section">
            <h2>Welcome to <span class="brand">FoodExpress</span> 🚀</h2>
            <p>Your favorite meals delivered right to your doorstep. Explore our wide range of restaurants and delicious cuisines.</p>
            <button class="btn">Explore Now</button>
        </div>

        <!-- Right Side: Rider Section -->
        <div class="rider-container">
            <div class="half-circle">
                <img src="assets/images/rider-vector-image-removebg-preview.png" alt="Food Delivery Rider" class="rider-image">
            </div>
        </div>
    </div>

    <div class="container">
    <div class="row">
        <h3 class="heading-r my-5 text-center">Our Restaurants</h3>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mx-auto">
                <img src="assets/images/tuans.jpeg" class="card-img-top" alt="Tuan's Food Bowl">
                <div class="card-body text-center">
                    <h5 class="card-title">Tuan's Food Bowl</h5>
                    <a href="#" class="btn btn-primary button-color">See Menu</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mx-auto">
                <img src="assets/images/yummize.png" class="card-img-top" alt="Yumize">
                <div class="card-body text-center">
                    <h5 class="card-title">Yumize</h5>
                    <a href="#" class="btn btn-primary button-color">See Menu</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mx-auto">
                <img src="assets/images/kandiah-THUMBNAIL.jpg" class="card-img-top" alt="Kandiah Restaurant">
                <div class="card-body text-center">
                    <h5 class="card-title">Kandiah Restaurant</h5>
                    <a href="#" class="btn btn-primary button-color">See Menu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mx-auto">
                <img src="assets/images/ice-talk.png" class="card-img-top" alt="Kandiah Restaurant">
                <div class="card-body text-center">
                    <h5 class="card-title">ICE talk</h5>
                    <a href="#" class="btn btn-primary button-color">See Menu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mx-auto">
                <img src="assets/images/jollybee.png" class="card-img-top" alt="Kandiah Restaurant">
                <div class="card-body text-center">
                    <h5 class="card-title">Jollybee</h5>
                    <a href="#" class="btn btn-primary button-color">See Menu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mx-auto">
                <img src="assets/images/kfc-new-logo-design-2018-1024x683.webp" class="card-img-top" alt="Kandiah Restaurant">
                <div class="card-body text-center">
                    <h5 class="card-title">KFC</h5>
                    <a href="#" class="btn btn-primary button-color">See Menu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mx-auto">
                <img src="assets/images/Pizza-Hut-Logo.webp" class="card-img-top" alt="Kandiah Restaurant">
                <div class="card-body text-center">
                    <h5 class="card-title">Pizza Hut</h5>
                    <a href="#" class="btn btn-primary button-color">See Menu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mx-auto">
                <img src="assets/images/dynamic.avif" class="card-img-top" alt="Kandiah Restaurant">
                <div class="card-body text-center">
                    <h5 class="card-title">Dynamic</h5>
                    <a href="#" class="btn btn-primary button-color">See Menu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card mx-auto">
                <img src="assets/images/MUMS-FOOD.jpg" class="card-img-top" alt="Kandiah Restaurant">
                <div class="card-body text-center">
                    <h5 class="card-title">Mum's Food</h5>
                    <a href="#" class="btn btn-primary button-color">See Menu</a>
                </div>
            </div>
        </div>
    </div>
</div>




    <!-- Restaurant Carousel
<div id="restaurantCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/ice-talk.png" class="d-block w-100 carousel-image" alt="Restaurant 1">
        </div>
        <div class="carousel-item">
            <img src="assets/images/jollybee.png" class="d-block w-100 carousel-image" alt="Restaurant 2">
        </div>
        <div class="carousel-item">
            <img src="assets/images/kandiah-THUMBNAIL.jpg" class="d-block w-100 carousel-image" alt="Restaurant 3">
        </div>
        <div class="carousel-item">
            <img src="assets/images/tuans.jpeg" class="d-block w-100 carousel-image" alt="Restaurant 3">
        </div>
        <div class="carousel-item">
            <img src="assets/images/yummize.png" class="d-block w-100 carousel-image" alt="Restaurant 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#restaurantCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#restaurantCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>  -->


    <div class="benefits-section">
        <h2>Benefits on <span class="brand">FoodExpress</span></h2>
        <div class="benefit">
            <div class="benefit-item">
                <img src="assets/images/fast-delivery-icon-silhouette-shipping-truck-isolated-vector-illustration-PEX7AD.jpg" alt="Fast Delivery" class="benefit-icon">
                <h3>Fast Delivery</h3>
                <p>Enjoy lightning-fast delivery services directly to your doorstep. No more waiting around, your favorite meals arrive in no time!</p>
            </div>
            <div class="benefit-item">
                <img src="assets/images/choices.png" alt="Variety of Choices" class="benefit-icon">
                <h3>Endless Choices</h3>
                <p>Choose from a wide selection of restaurants and cuisines. Whether you're craving pizza, sushi, or a healthy salad, we’ve got it all!</p>
            </div>
            <div class="benefit-item">
                <img src="assets/images/secure-payment.jpg" alt="Secure Payment" class="benefit-icon">
                <h3>Secure Payment</h3>
                <p>Our platform offers multiple secure payment options, including credit cards and digital wallets, so you can pay with peace of mind.</p>
            </div>
            <div class="benefit-item">
                <img src="assets/images/track-order.avif" alt="Track Your Order" class="benefit-icon">
                <h3>Track Your Order</h3>
                <p>Stay updated with real-time tracking of your order, from the moment it’s prepared to the moment it arrives at your doorstep.</p>
            </div>
            <div class="benefit-item">
                <img src="assets/images/24_customer_support.jpg" alt="24/7 Customer Support" class="benefit-icon">
                <h3>24/7 Customer Support</h3>
                <p class="small-font">If you have any questions or issues, our dedicated customer support team is available around the clock to assist you.</p>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>