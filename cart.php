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
                    $itemTotal = $item["price"] * $item["quantity"];
                    $total += $itemTotal;
                ?>
                <tr>
                    <td><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["size"]; ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td>$<?php echo number_format($item["price"], 2); ?></td>
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


<!-- Proceed to Checkout Form Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="checkoutForm" method="POST" action="process_checkout.php">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="teleNo" class="form-label">Tele No</label>
                        <input type="text" class="form-control" id="teleNo" name="tele_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="paymentOption" class="form-label">Payment Option</label>
                        <select class="form-select" id="paymentOption" name="payment_option" required>
                            <option value="COD">Cash on Delivery (COD)</option>
                            <option value="Credit card">Credit Card</option>
                            <option value="Debit card">Debit Card</option>
                            <option value="Paypal">Paypal</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="additionalInfo" class="form-label">Any Information (Optional)</label>
                        <textarea class="form-control" id="additionalInfo" name="additional_info"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelector('.button-color').addEventListener('click', function() {
        let checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        checkoutModal.show();
    });
</script>
