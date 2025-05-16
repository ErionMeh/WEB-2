<?php 
include('includes/header.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container'><h3>Invalid product ID.</h3></div>";
    include('includes/footer.php');
    exit;
}

$id = (int) $_GET['id'];

$products = [
    ["name" => "Samsung Galaxy S23", "price" => 2450.50, "discount" => 0.15, "stock" => 3, "img" => "assets/img/Samsung.png"],
    ["name" => "iPhone 13 Pro", "price" => 999.00, "discount" => 0.10, "stock" => 0, "img" => "assets/img/Iphone.png"],
    ["name" => "MacBook Air M2", "price" => 1249.00, "discount" => 0.12, "stock" => 8, "img" => "assets/img/macbook-air.jpg"],
    ["name" => "Dell XPS 13", "price" => 1099.99, "discount" => 0.08, "stock" => 6, "img" => "assets/img/dell-xps.jpg"],
    ["name" => "Sony WH-1000XM4", "price" => 349.99, "discount" => 0.20, "stock" => 15, "img" => "assets/img/sony-headphones.jpg"],
    ["name" => "Canon EOS R5", "price" => 3899.00, "discount" => 0.05, "stock" => 2, "img" => "assets/img/canon-eos-r5.jpg"],
    ["name" => "GoPro HERO10", "price" => 499.99, "discount" => 0.15, "stock" => 10, "img" => "assets/img/gopro-hero10.jpg"],
    ["name" => "Nintendo Switch OLED", "price" => 349.99, "discount" => 0.10, "stock" => 0, "img" => "assets/img/switch-oled.jpg"]
];

define("VAT", 0.05);

if (!isset($products[$id - 1])) {
    echo "<div class='container'><h3>Product not found.</h3></div>";
    include('includes/footer.php');
    exit;
}

$product = $products[$id - 1];
$priceAfterDiscount = $product['price'] - ($product['price'] * $product['discount']);
$vatAmount = $priceAfterDiscount * VAT;
$final = $priceAfterDiscount + $vatAmount;
?>

<style>
    .btn-outline-lightblue {
        border: 2px solid #3399ff;
        color: #3399ff;
        background-color: white;
        border-radius: 30px;
        padding: 8px 20px;
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

    .btn-outline-lightblue:disabled, 
    .btn-outline-lightblue[disabled] {
        opacity: 0.6;
        cursor: not-allowed;
        background-color: white;
        color: #3399ff;
        border-color: #3399ff;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p><del><?= number_format($product['price'], 2) ?> &euro;</del></p>
            <p class="text-danger">Discount: <?= $product['discount'] * 100 ?>%</p>
            <p class="text-success fw-bold">Final Price incl. VAT: <?= number_format($final, 2) ?> &euro;</p>

            <?php if ($product['stock'] == 0): ?>
                <span class="badge bg-danger mb-2">Out of stock</span>
            <?php elseif ($product['stock'] < 5): ?>
                <span class="badge bg-warning mb-2">Limited stock – <?= $product['stock'] ?> left</span>
            <?php else: ?>
                <span class="badge bg-success mb-2">In stock</span>
            <?php endif; ?>

            <br><br>

            <?php if ($product['stock'] > 0): ?>
                <a href="update_cart.php?action=add&id=<?= $id ?>&name=<?= urlencode($product['name']) ?>&price=<?= $product['price'] ?>" class="btn-outline-lightblue">Add to cart</a>
            <?php else: ?>
                <button class="btn-outline-lightblue" disabled>Out of stock</button>
            <?php endif; ?>

            <a href="shop.php" class="btn-outline-lightblue ms-2">← Back to Products</a>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
