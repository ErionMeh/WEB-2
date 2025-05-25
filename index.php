<?php 
require_once 'classes/error-handler.php';
include('includes/header.php');  // session_start() is now handled in header.php

// index.php - Zëvendëso pjesën ekzistuese të cookie consent

// Cookie consent logic me më shumë opsione
$show_cookie_popup = true;
$cookieConsent = $_COOKIE['cookie_consent'] ?? null;

if ($cookieConsent === 'accepted' || $cookieConsent === 'rejected') {
    $show_cookie_popup = false;
}

// Handle cookie acceptance with more options
if (isset($_GET['cookie_consent'])) {
    $value = $_GET['cookie_consent'] === 'accept' ? 'accepted' : 'rejected';
    setcookie('cookie_consent', $value, [
        'expires' => time() + (365 * 24 * 60 * 60),
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}
?>

<div class="promotions">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/6988236.jpg" class="d-block w-100" alt="Special offers">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            <div class="carousel-item">
                <img src="assets/img/3.jpg" class="d-block w-100" alt="New arrivals">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            <div class="carousel-item">
                <img src="assets/img/2.webp" class="d-block w-100" alt="Featured products">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="latest-products bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Latest Products</h2>
        </div>
        <div class="row">
            <?php
            // Product data array for cleaner code
            $products = [
                ['img' => 'Iphone.png', 'name' => 'iPhone 14 Pro'],
                ['img' => 'Samsung.png', 'name' => 'Samsung Galaxy S23 Ultra'],
                ['img' => 'Apple Watch.png', 'name' => 'Apple Watch Series 8'],
                ['img' => 'Airpods.png', 'name' => 'AirPods Pro 2'],
                ['img' => 'Asus.png', 'name' => 'ASUS ROG Strix G15', 'class' => 'mt-4'],
                ['img' => 'LG.png', 'name' => 'LG OLED C2 65-inch', 'class' => 'mt-4'],
                ['img' => 'JBL.png', 'name' => 'JBL Charge 5', 'class' => 'mt-4'],
                ['img' => 'sony.png', 'name' => 'Sony Alpha a7 III', 'class' => 'mt-4']
            ];
            
            foreach ($products as $product) {
                echo '
                <div class="col-lg-3 col-md-3 col-sm-12 ' . ($product['class'] ?? '') . '">
                    <div class="card product-card">
                        <img src="assets/img/' . htmlspecialchars($product['img']) . '" class="card-img-top" alt="' . htmlspecialchars($product['name']) . '">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($product['name']) . '</h5>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
        <div class="text-center mt-5">
            <a href="shop.php" class="btn btn-outline-primary btn-lg">View All Products &rarr;</a>
        </div>
    </div>
</div>

<div class="about-us py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-5 col-sm-12 mb-4 mb-lg-0">
                <img src="./assets/img/aboutus.webp" class="img-fluid rounded shadow" alt="About eStore">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2 class="mb-4">About eStore</h2>
                <p class="lead">
                    eStore is your online destination for fast, secure, and modern shopping.
                </p>
                <p>
                    With a wide range of products - from technology, fashion to everyday accessories - you can find everything you need in one place.
                </p>
                <p class="mt-3">
                    We offer competitive prices, fast shipping and excellent customer service. Register today and experience the easiest shopping you've ever had!
                </p>
            </div>
        </div>
    </div>
</div>

<?php if ($show_cookie_popup): ?>
<div class="cookie-consent fixed-bottom bg-dark text-white p-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <p class="mb-md-0">We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.</p>
            </div>
            <div class="col-md-4 text-md-end mt-2 mt-md-0">
                <a href="?cookie_consent=accept" class="btn btn-success btn-sm">Accept</a>
                <a href="?cookie_consent=reject" class="btn btn-outline-light btn-sm ms-2">Reject</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php include('includes/footer.php'); ?>

