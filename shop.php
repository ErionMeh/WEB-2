<?php include('includes/header.php'); ?>

<style>
.card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
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

.card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
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
.card {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>


<div class="products py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h2>Explore products</h2>
            </div>
            <div>
               <form method="get" action="shop.php">
    <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
        <option value="">Filter products ↓</option>
        <option value="price_asc" <?= (isset($_GET['filter']) && $_GET['filter'] == 'price_asc') ? 'selected' : '' ?>>Price: Low to High</option>
        <option value="price_desc" <?= (isset($_GET['filter']) && $_GET['filter'] == 'price_desc') ? 'selected' : '' ?>>Price: High to Low</option>
        <option value="name_asc" <?= (isset($_GET['filter']) && $_GET['filter'] == 'name_asc') ? 'selected' : '' ?>>Name: A-Z</option>
        <option value="name_desc" <?= (isset($_GET['filter']) && $_GET['filter'] == 'name_desc') ? 'selected' : '' ?>>Name: Z-A</option>
    </select>
</form>


            </div>
        </div>
        <div class="row mt-5">
            

        <?php
        define("VAT", 0.05);

        $products = [
           ["name" => "Samsung Galaxy S23", "price" => 2450.50, "discount" => 0.15, "stock" => 3, "img" => "assets/img/Samsung.png"],
           ["name" => "iPhone 13 Pro", "price" => 999.00, "discount" => 0.10, "stock" => 0, "img" => "assets/img/Iphone.png"],
           ["name" => "MacBook Air M2", "price" => 1249.00, "discount" => 0.12, "stock" => 8, "img" => "assets/img/apple.jpg"],
           ["name" => "Sony WH-1000XM5", "price" => 349.99, "discount" => 0.20, "stock" => 2, "img" => "assets/img/sony.png"],
           ["name" => "Lenovo Legion 5", "price" => 1599.00, "discount" => 0.18, "stock" => 4, "img" => "assets/img/Lenovo.legion.webp"],
           ["name" => "GoPro HERO12", "price" => 429.00, "discount" => 0.15, "stock" => 7, "img" => "assets/img/GoPro.jpg"],
           ["name" => "JBL Flip 6 Speaker", "price" => 129.99, "discount" => 0.10, "stock" => 15, "img" => "assets/img/jbl.png"],
           ["name" => "PlayStation 5", "price" => 599.99, "discount" => 0.05, "stock" => 1, "img" => "assets/img/PS5.jpg"],
           ["name" => "Men's Cotton T-Shirt", "price" => 19.99, "discount" => 0.10, "stock" => 7, "img" => "assets/img/tshirt.jpg"],
           ["name" => "Basketball Size 7", "price" => 29.99, "discount" => 0.10, "stock" => 0, "img" => "assets/img/basketball.jpg"],
           ["name" => "Running Shoes", "price" => 89.90, "discount" => 0.18, "stock" => 4, "img" => "assets/img/shoes.jpg"],
           ["name" => "Ceramic Coffee Mug", "price" => 11.99, "discount" => 0.10, "stock" => 12, "img" => "assets/img/a.webp"],
           ["name" => "Gaming Mouse Pad", "price" => 17.49, "discount" => 0.20, "stock" => 6, "img" => "assets/img/mousepad.jpg"],
           ["name" => "Organic Green Tea (Box)", "price" => 8.99, "discount" => 0.12, "stock" => 0, "img" => "assets/img/c.webp"],
        ];

        $loopIndex = 0;

       $filter = isset($_GET['filter']) ? $_GET['filter'] : '';


if ($filter == 'price_asc') {
    usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
} elseif ($filter == 'price_desc') {
    usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
} elseif ($filter == 'name_asc') {
    usort($products, fn($a, $b) => strcmp($a['name'], $b['name']));
} elseif ($filter == 'name_desc') {
    usort($products, fn($a, $b) => strcmp($b['name'], $a['name']));
} 

$search = strtolower(trim($_GET['search'] ?? ''));

if (!empty($search)) {
    $products = array_filter($products, function ($product) use ($search) {
        return str_contains(strtolower($product['name']), $search);
    });
}

if (empty($products)) {
                echo '<div class="col-12"><div class="alert alert-warning">No products match your search.</div></div>';
            }


        foreach ($products as $product):
            $loopIndex++;

            $name = $product['name'];
            $price = $product['price'];
            $discount = $product['discount'];
            $stock = $product['stock'];
            $img = $product['img'];

            $name = preg_replace('/\s+/', ' ', trim($name));

            if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $price)) {
                echo "<div class='alert alert-danger'>Invalid price format for product: $name</div>";
            }

            $priceAfterDiscount = $price - ($price * $discount);
            $vatAmount = $priceAfterDiscount * VAT;
            $final = $priceAfterDiscount + $vatAmount;
            $final = preg_replace("/[€,\\s]/", "", $final);
        ?>

            <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
               <div class="card h-100">

                    <img src="<?= $img ?>" class="card-img-top" alt="<?= $name ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $name ?></h5>

                        <?php
                        if ($stock == 0) {
                            echo "<span class='badge bg-danger mb-2'>Out of stock</span>";
                        } elseif ($stock < 5) {
                            echo "<span class='badge bg-warning mb-2'>Limited stock – $stock left</span>";
                        } else {
                            echo "<span class='badge bg-success mb-2'>In stock</span>";
                        }
                        ?>

                        <p class="card-text mb-1"><del><?= number_format($price, 2) ?> &euro;</del></p>
                        <p class="card-text mb-1 text-danger">Discount: <?= $discount * 100 ?>%</p>
                        <p class="card-text text-success fw-bold">Final Price incl. VAT: <?= number_format($final, 2) ?> &euro;</p>

                        <a href="view-product.php?id=<?= $loopIndex ?>" class="btn btn-outline-secondary mt-2">View product</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>  