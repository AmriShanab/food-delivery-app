<?php
include "layouts/header.php";
include "database/dbconfig.php"; // Database connection

// Get restaurant_id from URL
if (isset($_GET['restaurant_id'])) {
    $restaurant_id = intval($_GET['restaurant_id']);

    // Fetch restaurant details
    $restaurantQuery = $db->prepare("SELECT name FROM restaurants WHERE id = ?");
    $restaurantQuery->execute([$restaurant_id]);
    $restaurant = $restaurantQuery->fetch();

    // Fetch menu items for the restaurant
    $menuQuery = $db->prepare("SELECT * FROM menu_items WHERE restaurant_id = ?");
    $menuQuery->execute([$restaurant_id]);
    $menuItems = $menuQuery->fetchAll();
} else {
    echo "<h3 class='text-center'>Restaurant not found</h3>";
    exit;
}
?>

<div class="container">
    <h3 class="my-5 text-center"><?php echo $restaurant['name']; ?> - Menu</h3>
    <div class="row">
        <?php foreach ($menuItems as $item) { ?>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card mx-auto">
                    <img src="assets/images/<?php echo $item['image']; ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $item['name']; ?></h5>
                        <p class="text-muted">$<?php echo number_format($item['price'], 2); ?></p>
                        <a href="#" class="btn btn-success order-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#orderModal"
                            data-id="<?php echo $item['id']; ?>"
                            data-name="<?php echo $item['name']; ?>"
                            data-price="<?php echo $item['price']; ?>">
                            Order Now
                        </a>


                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<!-- Bootstrap Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Order Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="orderForm">
                    <input type="hidden" id="item_id">
                    <input type="hidden" id="item_name">
                    <input type="hidden" id="item_price">

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" id="quantity" class="form-control" min="1" value="1">
                    </div>
                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <select id="size" class="form-control">
                            <option value="S">Small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary button-color" id="addToCart">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Set up modal with item data when Order Now is clicked
    document.querySelectorAll('.order-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('item_id').value = this.getAttribute('data-id');
            document.getElementById('item_name').value = this.getAttribute('data-name');
            document.getElementById('item_price').value = this.getAttribute('data-price');
        });
    });

    // Add to cart button functionality
    document.getElementById('addToCart').addEventListener('click', function() {
        const itemId = document.getElementById('item_id').value;
        const itemName = document.getElementById('item_name').value;
        const itemPrice = parseFloat(document.getElementById('item_price').value);
        const quantity = parseInt(document.getElementById('quantity').value);
        const size = document.getElementById('size').value;
        
        if (!itemId || !itemName || !itemPrice || !quantity) {
            alert('Please select an item first');
            return;
        }

        // Create cart item object
        const cartItem = {
            id: itemId,
            name: itemName,
            price: itemPrice,
            quantity: quantity,
            size: size,
            restaurant_id: <?php echo $restaurant_id; ?>
        };

        // Get existing cart from localStorage or initialize empty array
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        // Check if item already exists in cart
        const existingItemIndex = cart.findIndex(item => 
            item.id === itemId && item.size === size && item.restaurant_id === <?php echo $restaurant_id; ?>
        );
        
        if (existingItemIndex >= 0) {
            // Update quantity if item exists
            cart[existingItemIndex].quantity += quantity;
        } else {
            // Add new item to cart
            cart.push(cartItem);
        }
        
        // Save updated cart to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Update cart count in navbar (if you have one)
        updateCartCount();
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
        modal.hide();
        
        // Show success message
        alert(`${quantity} ${itemName} (${size}) added to cart!`);
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

    // Initialize cart count on page load
    updateCartCount();
});
</script>