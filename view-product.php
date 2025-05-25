<?php 
include('includes/header.php');
include('classes/db.php'); // lidhja me DB

$db = new Db();
$conn = $db->conn;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container'><h3>Invalid product ID.</h3></div>";
    include('includes/footer.php');
    exit;
}

$id = (int) $_GET['id'];

// Merr produktin nga databaza
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='container'><h3>Product not found.</h3></div>";
    include('includes/footer.php');
    exit;
}

$product = $result->fetch_assoc();

// Kontrollo nëse ekziston discount, nëse jo, vendos 0
$discount = isset($product['discount']) ? $product['discount'] : 0;

define("VAT", 0.05);

$priceAfterDiscount = $product['price'] - ($product['price'] * $discount);
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
            <p class="text-danger">Discount: <?= $discount * 100 ?>%</p>
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
