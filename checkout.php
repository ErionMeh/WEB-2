<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

include('includes/header.php');

$error = '';
$success = '';
$delivery_date = $_POST['delivery_date'] ?? '';

if (!empty($_POST)) {
    if (!preg_match("/^\d{2}-\d{2}-\d{4}$/", $delivery_date)) {
        $error = "Data duhet të jetë në formatin <strong>dd-mm-yyyy</strong>.";
    } else {
        $success = "Faleminderit për porosinë! Data e dorëzimit: <strong>$delivery_date</strong>";
        $_SESSION['cart'] = []; 
    }
}
?>

<div class="checkout py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div><h2>Buy from the best</h2></div>
            <div>
                <a href="update_cart.php?action=empty" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                    Empty cart
                </a>
            </div>
        </div>

        <div class="my-5">
            <h4 class="mb-4">Checkout</h4>
            <form method="POST">
                <div class="form-group">
                    <label class="my-2">Fullname</label>
                    <input type="text" name="fullname" class="form-control" placeholder="Fullname" required>
                </div>
                <div class="form-group my-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group my-2">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                </div>
                <div class="form-group my-2">
                    <label>Address</label>
                    <textarea name="address" class="form-control" required></textarea>
                </div>
                <div class="form-group my-2">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>
                <div class="form-group my-2">
                    <label>Delivery date</label>
                    <input type="text" name="delivery_date" class="form-control" placeholder="16-04-2025" required>
                </div>
                <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
            </form>

            <?php if (!empty($error)) echo "<p class='mt-3 text-danger'>$error</p>"; ?>
            <?php if (!empty($success)) echo "<p class='mt-3 text-success'>$success</p>"; ?>

            <h4 class="mt-5 mb-4">Basket items</h4>
            <?php if (!empty($cart)): ?>
                <div class="table-responsive mb-5">
                    <table class="table table-bordered">
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                        <?php foreach ($cart as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td><?= number_format($item['price'] * $item['qty'], 2) ?> &euro;</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else: ?>
                <p>No items in basket.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
