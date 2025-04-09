<?php include('includes/header.php'); ?>

<!-- Checkout page -->
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
            <h4 class="mb-4">
                Checkout
            </h4>
            <div class="checkout-form">
                <form action="#">
                    <div class="form-group">
                        <label for="fullname my-2">Fullname</label>
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
                    <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                </form>
            </div>
            <h4 class="mt-5 mb-4">
                Basket items
            </h4>
            <div class="table-responsive mb-5">
                <table class="table table-bordered">
                    <tr>
                        <th>Product</td>
                        <th>Qty</td>
                        <th>Price</td>
                    </tr>
                    <tr>
                        <td width="70%">Coca Cola 1l</td>
                        <td>
                            <span class="d-inline-block mx-3">3</span>
                        </td>
                        <td class="text-end">
                            45.80 &euro;
                        </td>
                    </tr>
                </table>
            </div>
        </div> <!-- ./div -->
    </div>
</div>


<?php include('includes/footer.php'); ?>