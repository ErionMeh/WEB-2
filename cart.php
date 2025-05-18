<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

define("VAT", 0.05);
include('includes/header.php');
?>

<style>
    /* Stil për butonat me kufi blu të hapur dhe sfond të bardhë */
    .btn-outline-lightblue {
        border: 2px solid #3399ff;
        color: #3399ff;
        background-color: white;
        border-radius: 30px;
        padding: 6px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }

    .btn-outline-lightblue:hover {
        background-color: #3399ff;
        color: white;
    }

    /* Stil për butonat plus dhe minus në tabelë */
    .btn-cart-action {
        border: 2px solid #3399ff;
        color: #3399ff;
        background-color: white;
        border-radius: 30px;
        width: 32px;
        height: 32px;
        line-height: 26px;
        font-weight: 600;
        font-size: 18px;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        user-select: none;
        cursor: pointer;
        margin: 0 3px;
        display: inline-block;
    }

    .btn-cart-action:hover {
        background-color: #3399ff;
        color: white;
    }

    .empty-cart-message {
    border: 2px solid #3399ff;
    border-radius: 30px;
    max-width: 320px;
    margin: 50px auto;
    padding: 40px 20px;
    background-color: #f9faff;
    box-shadow: 0 0 8px rgba(51, 153, 255, 0.2);
}

.empty-cart-message p {
    color: #3399ff;
    font-weight: 600;
}

.btn-outline-lightblue {
    border: 2px solid #3399ff;
    color: #3399ff;
    background-color: white;
    border-radius: 30px;
    padding: 8px 24px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    text-decoration: none;
    cursor: pointer;
    display: inline-block;
}

.btn-outline-lightblue:hover {
    background-color: #3399ff;
    color: white;
}

</style>

<div class="container py-5">
   <?php if (empty($cart)): ?>
    <div class="empty-cart-message text-center py-5">
        <p class="fs-4 mb-4">Your cart is empty.</p>
        <a href="shop.php" class="btn btn-outline-lightblue px-4 py-2">Go shopping</a>
    </div>
<?php else: ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price (&euro;)</th>
                    <th>Qty</th>
                    <th>Total (&euro;)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalPrice = 0;
                foreach ($cart as $product): 
                    $linePrice = $product['price'] * $product['qty'];
                    $totalPrice += $linePrice;
                ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= number_format($product['price'], 2) ?></td>
                    <td><?= $product['qty'] ?></td>
                    <td><?= number_format($linePrice, 2) ?></td>
                    <td>
                        <a href="update_cart.php?action=increase&id=<?= $product['id'] ?>" class="btn-cart-action">+</a>
                        <a href="update_cart.php?action=decrease&id=<?= $product['id'] ?>" class="btn-cart-action">−</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Subtotal</td>
                    <td colspan="2"><?= number_format($totalPrice, 2) ?> &euro;</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end fw-bold">VAT (5%)</td>
                    <td colspan="2"><?= number_format($totalPrice * VAT, 2) ?> &euro;</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total</td>
                    <td colspan="2"><?= number_format($totalPrice * (1 + VAT), 2) ?> &euro;</td>
                </tr>
            </tbody>
        </table>

        <a href="update_cart.php?action=empty" class="btn-outline-lightblue">Empty cart</a>
        <a href="shop.php" class="btn-outline-lightblue ms-2">Continue shopping</a>
        <a href="checkout.php" class="btn-outline-lightblue ms-2">Checkout</a>

    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
