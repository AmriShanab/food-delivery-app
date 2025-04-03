<?php
session_start();
include "layouts/header.php";
?>

<div class="container">
    <h3 class="my-5 text-center">Your Cart</h3>
    <?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION["cart"] as $item) {
                    // Ensure price and quantity are numeric
                    $price = (float)($item["price"] ?? 0);
                    $quantity = (int)($item["quantity"] ?? 0);

                    // If any item has invalid data, skip it
                    if (empty($item["name"]) || empty($item["price"]) || empty($item["quantity"])) {
                        continue;
                    }

                    $itemTotal = $price * $quantity;
                    $total += $itemTotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item["name"] ?? 'No Name'); ?></td>
                        <td><?php echo htmlspecialchars($item["size"] ?? 'No Size'); ?></td>
                        <td><?php echo htmlspecialchars($item["quantity"] ?? 0); ?></td>
                        <td>$<?php echo number_format($price, 2); ?></td>
                        <td>$<?php echo number_format($itemTotal, 2); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Total</th>
                    <th>$<?php echo number_format($total, 2); ?></th>
                </tr>
            </tfoot>
        </table>

        <button class="btn btn-primary button-color">Proceed to Checkout</button>
    <?php } else { ?>
        <p class="text-center">Your cart is empty!</p>
    <?php } ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelector('.button-color').addEventListener('click', function() {
        let checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        checkoutModal.show();
    });
</script>