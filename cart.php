<?php
include "layouts/header.php";
?>

<div class="container my-5">
    <h3 class="mb-4">Your Cart</h3>

    <?php if (isset($_GET['empty'])): ?>
        <div class="alert alert-success">Your cart has been emptied.</div>
    <?php endif; ?>

    <div id="cartItems">
        <!-- Cart items will be loaded here via JavaScript -->
        <div class="text-center my-5">
            <p>Your cart is empty</p>
            <a href="restaurants.php" class="btn btn-primary">Browse Restaurants</a>
        </div>
    </div>

    <div id="cartSummary" class="card mt-4" style="display: none;">
        <div class="card-body">
            <h5 class="card-title">Order Summary</h5>
            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span id="subtotal">$0.00</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Delivery Fee:</span>
                <span id="deliveryFee">$2.99</span>
            </div>
            <div class="d-flex justify-content-between mb-3 fw-bold">
                <span>Total:</span>
                <span id="total">$0.00</span>
            </div>
            <button id="checkoutBtn" class="btn btn-success w-100 button-color">Proceed to Checkout</button>
            <button id="emptyCartBtn" class="btn btn-outline-danger w-100 mt-2">Empty Cart</button>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="checkoutModalLabel">Complete Your Order</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="checkoutForm">
                        <div class="row g-3">
                            <!-- Personal Information -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Personal Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="firstName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lastName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Telephone No <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select" id="countryCode" style="max-width: 120px;">
                                                    <option value="+1">+1 (US)</option>
                                                    <option value="+44">+44 (UK)</option>
                                                    <option value="+91">+91 (IN)</option>
                                                    <option value="+971">+971 (UAE)</option>
                                                </select>
                                                <input type="tel" class="form-control" id="phone" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delivery & Payment -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Delivery & Payment</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="address" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="paymentMethod" class="form-label">Payment Option <span class="text-danger">*</span></label>
                                            <select class="form-select" id="paymentMethod" required>
                                                <option value="" selected disabled>Select payment method</option>
                                                <option value="COD">Cash on Delivery (COD)</option>
                                                <option value="card">Credit/Debit Card</option>
                                            </select>
                                        </div>
                                        <div id="cardDetails" class="mt-3" style="display: none;">
                                            <div class="mb-3">
                                                <label for="cardNumber" class="form-label">Card Number</label>
                                                <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                                    <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="cvv" class="form-label">CVV</label>
                                                    <input type="text" class="form-control" id="cvv" placeholder="123">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="additionalInfo" class="form-label">Additional Information</label>
                                            <textarea class="form-control" id="additionalInfo" rows="2" placeholder="Any special instructions?"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitOrder">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Make sure Bootstrap JS is included -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load cart items from localStorage
        function loadCartItems() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartItemsContainer = document.getElementById('cartItems');
            const cartSummary = document.getElementById('cartSummary');

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `
                <div class="text-center my-5">
                    <p>Your cart is empty</p>
                    <a href="restaurants.php" class="btn btn-primary">Browse Restaurants</a>
                </div>
            `;
                cartSummary.style.display = 'none';
                return;
            }

            // Group items by restaurant
            const restaurants = {};
            cart.forEach(item => {
                if (!restaurants[item.restaurant_id]) {
                    restaurants[item.restaurant_id] = {
                        name: item.restaurant_name || 'Restaurant',
                        items: []
                    };
                }
                restaurants[item.restaurant_id].items.push(item);
            });

            // Generate HTML for cart items
            let html = '';
            let subtotal = 0;

            for (const [restaurantId, restaurant] of Object.entries(restaurants)) {
                html += `<div class="card mb-4">
                <div class="card-header bg-light">
                    <h5>${restaurant.name}</h5>
                </div>
                <div class="card-body">`;

                restaurant.items.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    subtotal += itemTotal;

                    html += `
                <div class="row mb-3 align-items-center cart-item" data-id="${item.id}" data-size="${item.size}">
                    <div class="col-md-6">
                        <h6>${item.name} (${item.size})</h6>
                    </div>
                    <div class="col-md-2">
                        <span>$${item.price.toFixed(2)}</span>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control quantity-input" 
                               value="${item.quantity}" min="1" data-id="${item.id}" data-size="${item.size}">
                    </div>
                    <div class="col-md-2 text-end">
                        <span class="fw-bold">$${itemTotal.toFixed(2)}</span>
                        <button class="btn btn-sm btn-outline-danger remove-item ms-2" 
                                data-id="${item.id}" data-size="${item.size}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>`;
                });

                html += `</div></div>`;
            }

            cartItemsContainer.innerHTML = html;
            cartSummary.style.display = 'block';

            // Update summary
            const deliveryFee = 2.99;
            const total = subtotal + deliveryFee;

            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;

            // Add event listeners for quantity changes and remove buttons
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const itemId = this.getAttribute('data-id');
                    const size = this.getAttribute('data-size');
                    const newQuantity = parseInt(this.value);

                    updateCartItemQuantity(itemId, size, newQuantity);
                });
            });

            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    const size = this.getAttribute('data-size');

                    removeCartItem(itemId, size);
                });
            });
        }

        // Update item quantity in cart
        function updateCartItemQuantity(itemId, size, newQuantity) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const itemIndex = cart.findIndex(item =>
                item.id === itemId && item.size === size
            );

            if (itemIndex >= 0) {
                if (newQuantity < 1) {
                    cart.splice(itemIndex, 1);
                } else {
                    cart[itemIndex].quantity = newQuantity;
                }

                localStorage.setItem('cart', JSON.stringify(cart));
                loadCartItems();
                updateCartCount();
            }
        }

        // Remove item from cart
        function removeCartItem(itemId, size) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            cart = cart.filter(item =>
                !(item.id === itemId && item.size === size)
            );

            localStorage.setItem('cart', JSON.stringify(cart));
            loadCartItems();
            updateCartCount();
        }

        // Empty cart
        document.getElementById('emptyCartBtn').addEventListener('click', function() {
            localStorage.removeItem('cart');
            window.location.href = 'cart.php?empty=1';
        });

        // Checkout button
        document.getElementById('checkoutBtn').addEventListener('click', function() {
            const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
            checkoutModal.show();
        });

        // Show/hide card details based on payment method
        document.getElementById('paymentMethod').addEventListener('change', function() {
            const cardDetails = document.getElementById('cardDetails');
            cardDetails.style.display = this.value === 'card' ? 'block' : 'none';
        });

        // Form submission
        document.getElementById('submitOrder').addEventListener('click', function() {
            const form = document.getElementById('checkoutForm');

            // Validate form
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            // Collect form data
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const subtotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
            const deliveryFee = 2.99;
            const total = subtotal + deliveryFee;

            const orderData = {
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('countryCode').value + document.getElementById('phone').value,
                address: document.getElementById('address').value,
                paymentMethod: document.getElementById('paymentMethod').value,
                additionalInfo: document.getElementById('additionalInfo').value,
                subtotal: subtotal,
                deliveryFee: deliveryFee,
                total: total,
                cart: cart,
                restaurant_id: cart.length > 0 ? cart[0].restaurant_id : null
            };

            // If card payment, add card details
            if (orderData.paymentMethod === 'card') {
                orderData.cardDetails = {
                    cardNumber: document.getElementById('cardNumber').value,
                    expiryDate: document.getElementById('expiryDate').value,
                    cvv: document.getElementById('cvv').value
                };
            }

            // Disable button to prevent multiple submissions
            this.disabled = true;
            this.textContent = 'Processing...';

            // Send data to server via AJAX
            fetch('process_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Clear cart and redirect to thank you page
                        localStorage.removeItem('cart');
                        updateCartCount();
                        window.location.href = 'thankyou.php?order_id=' + data.order_id;
                    } else {
                        alert('Error: ' + data.message);
                        this.disabled = false;
                        this.textContent = 'Place Order';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    this.disabled = false;
                    this.textContent = 'Place Order';
                });
        });

        // Function to update cart count in navbar
        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            const cartCountElements = document.querySelectorAll('.cart-count');

            cartCountElements.forEach(element => {
                element.textContent = totalItems;
                element.style.display = totalItems > 0 ? 'inline-block' : 'none';
            });
        }

        // Load cart items when page loads
        loadCartItems();
    });
</script>
