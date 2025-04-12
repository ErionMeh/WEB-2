<?php include('includes/header.php'); ?>


<div class="cart py-5">
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
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Product</td>
                        <th>Qty</td>
                        <th>Price</td>
                    </tr>
                    <tr>
                        <td width="70%">Coca Cola 1l</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-secondary">-</a>
                            <span class="d-inline-block mx-3">3</span>
                            <a href="#" class="btn btn-sm btn-outline-secondary">+</a>
                        </td>
                        <td class="text-end">
                            45.80 &euro;
                        </td>
                    </tr>
                </table>
            </div>
        </div> 
        <div>
            <a href="checkout.php" class="btn btn-sm btn-outline-primary">Check out</a>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
