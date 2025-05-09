<?php
require_once 'auth.php';
adminAuth(); // This will redirect to login if not authenticated
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
    <!-- Add these right after your other CSS links -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    /* Map Container Styles */
    #puttalamMap {
        height: 500px;
        width: 100%;
        z-index: 1;
    }

    /* Fix for tiles loading */
    .leaflet-container {
        background: #f8f9fa;
    }

    /* Fix for map controls */
    .leaflet-control-container {
        position: relative;
        z-index: 1000;
    }
</style>

<body style="background-image: url('assets/images/fish-fry.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">

            <!-- About & Rider Section -->
            <div class="about-rider-section">
                <!-- Left Side: About Section -->
                <div class="about-section">
                    <h2>Welcome to <span class="brand">FoodExpress</span> 🚀</h2>
                    <p>Your favorite meals delivered right to your doorstep. Explore our wide range of restaurants and delicious cuisines.</p>
                <a href="restaurents.php"><button class="btn">Explore Now</button></a>
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
                                <!-- <a href="#" class="btn btn-primary button-color">See Menu</a> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card mx-auto">
                            <img src="assets/images/yummize.png" class="card-img-top" alt="Yumize">
                            <div class="card-body text-center">
                                <h5 class="card-title">Yumize</h5>
                                <!-- <a href="#" class="btn btn-primary button-color">See Menu</a> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card mx-auto">
                            <img src="assets/images/kandiah-THUMBNAIL.jpg" class="card-img-top" alt="Kandiah Restaurant">
                            <div class="card-body text-center">
                                <h5 class="card-title">Kandiah Restaurant</h5>
                                <!-- <a href="#" class="btn btn-primary button-color">See Menu</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card mx-auto">
                            <img src="assets/images/ice-talk.png" class="card-img-top" alt="Kandiah Restaurant">
                            <div class="card-body text-center">
                                <h5 class="card-title">ICE talk</h5>
                                <!-- <a href="#" class="btn btn-primary button-color">See Menu</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card mx-auto">
                            <img src="assets/images/jollybee.png" class="card-img-top" alt="Kandiah Restaurant">
                            <div class="card-body text-center">
                                <h5 class="card-title">Jollybee</h5>
                                <!-- <a href="#" class="btn btn-primary button-color">See Menu</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card mx-auto">
                            <img src="assets/images/kfc-new-logo-design-2018-1024x683.webp" class="card-img-top" alt="Kandiah Restaurant">
                            <div class="card-body text-center">
                                <h5 class="card-title">KFC</h5>
                                <!-- <a href="#" class="btn btn-primary button-color">See Menu</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card mx-auto">
                            <img src="assets/images/Pizza-Hut-Logo.webp" class="card-img-top" alt="Kandiah Restaurant">
                            <div class="card-body text-center">
                                <h5 class="card-title">Pizza Hut</h5>
                                <!-- <a href="#" class="btn btn-primary button-color">See Menu</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card mx-auto">
                            <img src="assets/images/dynamic.avif" class="card-img-top" alt="Kandiah Restaurant">
                            <div class="card-body text-center">
                                <h5 class="card-title">Dynamic</h5>
                                <!-- <a href="#" class="btn btn-primary button-color">See Menu</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card mx-auto">
                            <img src="assets/images/MUMS-FOOD.jpg" class="card-img-top" alt="Kandiah Restaurant">
                            <div class="card-body text-center">
                                <h5 class="card-title">Mum's Food</h5>
                                <!-- <a href="#" class="btn btn-primary button-color">See Menu</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        
            <div class="map-section">
                <h2 class="text-center mb-4">Our Coverage Area in Puttalam</h2>
                <div id="puttalamMap"></div>
                <div class="text-center mt-3">
                    <small class="text-muted">Zoom in to see our delivery coverage area</small>
                </div>
            </div>


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
            
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <!-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> -->
            <script>
        // Wait for everything to load
        window.addEventListener('load', function() {
            console.log("Initializing map...");
            
            // Initialize the map centered on Puttalam
            const map = L.map('puttalamMap', {
                center: [8.0333, 79.8333],
                zoom: 13
            });

            // Check if map initialized
            if (!map) {
                console.error("Map initialization failed!");
                return;
            }

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Simple test marker
            L.marker([8.0333, 79.8333]).addTo(map)
                .bindPopup("<b>Puttalam Center</b>").openPopup();

            console.log("Map should be visible now");
        });
        </script>
</body>

</html>
<?php include "layouts/footer.php"; ?>