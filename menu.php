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
                    <button type="button" class="btn btn-primary" id="addToCart">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Capture all "Order Now" buttons
        let orderButtons = document.querySelectorAll(".order-btn");

        orderButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                // Prevent default behavior of the anchor tag
                event.preventDefault();

                // Get the data from the clicked button
                let itemId = this.getAttribute("data-id");
                let itemName = this.getAttribute("data-name");
                let itemPrice = this.getAttribute("data-price");

                // Set the values in the modal
                document.getElementById("item_id").value = itemId;
                document.getElementById("item_name").value = itemName;
                document.getElementById("item_price").value = itemPrice;

                // Manually show the modal using Bootstrap's modal API
                let modal = new bootstrap.Modal(document.getElementById("orderModal"));
                modal.show();
            });
        });

        // Handle Add to Cart button click
        document.getElementById("addToCart").addEventListener("click", function() {
            // Get all the values from the modal form
            let itemId = document.getElementById("item_id").value;
            let itemName = document.getElementById("item_name").value;
            let itemPrice = document.getElementById("item_price").value;
            let quantity = document.getElementById("quantity").value;
            let size = document.getElementById("size").value;

            // Send data to server (add to cart)
            fetch("add_to_cart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id=${itemId}&name=${itemName}&price=${itemPrice}&quantity=${quantity}&size=${size}`
            })
            .then(response => response.text())
            .then(data => {
                alert("Item added to cart!");

                // Close the modal after adding to cart
                let modal = bootstrap.Modal.getInstance(document.getElementById("orderModal"));
                modal.hide();
            })
            .catch(error => {
                console.error("Error adding to cart: ", error);
                alert("There was an error adding the item to the cart.");
            });
        });
    });
</script>
