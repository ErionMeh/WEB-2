<?php 
include('includes/header.php');

$error = '';
$success = '';

$delivery_date = $_POST['delivery_date'] ?? '';


if (!empty($_POST)) {
    if (!preg_match("/^\d{2}-\d{2}-\d{4}$/", $delivery_date)) {
        $error = "Data duhet të jetë në formatin <strong>dd-mm-yyyy</strong>.";
    } else {
        $success = "Data është e vlefshme: <strong>$delivery_date</strong>";
    }
}
?>

<div class="checkout py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h2>Buy from the best</h2>
                <p>45.960 products available</p>
            </div>
            <div>
                <a href="#" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                    Empty cart
                </a>
            </div>
        </div>

        <div class="my-5">
            <h4 class="mb-4">Checkout</h4>
            <div class="checkout-form">
                <form method="POST">
                    <div class="form-group">
                        <label for="fullname" class="my-2">Fullname</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Fullname" />
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                    </div>
                    <div class="form-group my-2">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" />
                    </div>
                    <div class="form-group my-2">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control"></textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" class="form-control"></textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="delivery_date">Delivery date (dd-mm-yyyy)</label>
                        <input type="text" name="delivery_date" id="delivery_date" class="form-control" placeholder="16-04-2025" />
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                </form>
                <?php if (!empty($error)) echo "<p class='mt-3' style='color:red;'>$error</p>"; ?>
                <?php if (!empty($success)) echo "<p class='mt-3' style='color:green;'>$success</p>"; ?>
            </div>

            <h4 class="mt-5 mb-4">Basket items</h4>
            <div class="table-responsive mb-5">
                <table class="table table-bordered">
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                        <td width="70%">Coca Cola 1l</td>
                        <td><span class="d-inline-block mx-3">3</span></td>
                        <td class="text-end">45.80 &euro;</td>
                    </tr>
                </table>
            </div>
        </div> <!-- ./div -->
    </div>
</div>

<?php include('includes/footer.php'); ?>
