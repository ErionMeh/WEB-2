<?php include('includes/header.php'); ?>
<?php
require_once 'classes/db.php';
require_once 'classes/product.php';

define("VAT", 0.05);

$db = new Db();
$conn = $db->conn;
$productObj = new Product($conn);

$filter = $_GET['filter'] ?? '';
$search = $_GET['search'] ?? '';

$products = $productObj->getAllProducts($filter, $search);
?>

<style>
/* Stilet janë të njëjta si në versionin tënd */
.card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    animation: fadeIn 0.5s ease-in-out;
}
.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
}
.card-img-top {
    height: 200px;
    object-fit: cover;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card-title {
    font-size: 1.1rem;
    font-weight: 600;
    min-height: 48px;
    color: #333;
}
.card-text {
    font-size: 0.95rem;
    color: #555;
}
.btn-outline-secondary {
    border-radius: 30px;
    padding: 6px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-top: auto;
}
.btn-outline-secondary:hover {
    background-color: #333;
    color: #fff;
}
.badge {
    font-size: 0.8rem;
    padding: 6px 10px;
    border-radius: 12px;
}
.products .container {
    max-width: 1200px;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="products py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div><h2>Explore products</h2></div>
            <div>
                <form method="get" action="shop.php">
                    <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                        <option value="">Filter products ↓</option>
                        <option value="price_asc" <?= ($filter == 'price_asc') ? 'selected' : '' ?>>Price: Low to High</option>
                        <option value="price_desc" <?= ($filter == 'price_desc') ? 'selected' : '' ?>>Price: High to Low</option>
                        <option value="name_asc" <?= ($filter == 'name_asc') ? 'selected' : '' ?>>Name: A-Z</option>
                        <option value="name_desc" <?= ($filter == 'name_desc') ? 'selected' : '' ?>>Name: Z-A</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <?php if (empty($products)): ?>
                <div class="col-12">
                    <div class="alert alert-warning">No products match your search.</div>
                </div>
            <?php endif; ?>

            <?php foreach ($products as $index => $product): 
                $name = htmlspecialchars($product['name']);
                $price = $product['price'];
                $discount = $product['discount'] ?? 0;
                $stock = $product['stock'];
               $img = $product['img'] ?? 'assets/img/default.jpg';


                $priceAfterDiscount = $price - ($price * $discount);
                $vatAmount = $priceAfterDiscount * VAT;
                $final = $priceAfterDiscount + $vatAmount;
            ?>
                <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($img) ?>" class="card-img-top" alt="<?= $name ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $name ?></h5>

                            <?php if ($stock == 0): ?>
                                <span class='badge bg-danger mb-2'>Out of stock</span>
                            <?php elseif ($stock < 5): ?>
                                <span class='badge bg-warning mb-2'>Limited stock – <?= $stock ?> left</span>
                            <?php else: ?>
                                <span class='badge bg-success mb-2'>In stock</span>
                            <?php endif; ?>

                            <p class="card-text mb-1"><del><?= number_format($price, 2) ?> &euro;</del></p>
                            <p class="card-text mb-1 text-danger">Discount: <?= $discount * 100 ?>%</p>
                            <p class="card-text text-success fw-bold">Final Price incl. VAT: <?= number_format($final, 2) ?> &euro;</p>

                            <a href="view-product.php?id=<?= $product['id'] ?>" class="btn btn-outline-secondary mt-2">View product</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
