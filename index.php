<?php 
session_start();

$show_cookie_popup = true;


if (isset($_COOKIE['cookie_accepted']) && $_COOKIE['cookie_accepted'] === 'yes') {
    $show_cookie_popup = false;
}


if (isset($_SESSION['cookie_popup_cancelled']) && $_SESSION['cookie_popup_cancelled'] === true) {
    $show_cookie_popup = false;
}

if (isset($_GET['accept_cookies']) && $_GET['accept_cookies'] === 'yes') {
    setcookie('cookie_accepted', 'yes', time() + (30 * 24 * 60 * 60)); // 30 ditë
    unset($_SESSION['cookie_popup_cancelled']);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

if (isset($_GET['cancel_cookies']) && $_GET['cancel_cookies'] === 'yes') {
    $_SESSION['cookie_popup_cancelled'] = true;
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

include('includes/header.php'); 
?>


<div class="promotions">
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="assets/img/6988236.jpg" class="d-block w-100" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
               
            </div>
            </div>
            
<<div class="carousel-item">
    <img src="assets/img/3.jpg" class="d-block w-100" alt="Second slide">
    <div class="carousel-caption d-none d-md-block">
    </div>
</div>

<div class="carousel-item">
    <img src="assets/img/2.webp" class="d-block w-100" alt="Third slide">
    <div class="carousel-caption d-none d-md-block">
    </div>
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
            <h2>Latest products</h2>
           
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="assets/img/Iphone.png" class="card-img-top" alt="iPhone 14 Pro">
                    <div class="card-body">
                        <h5 class="card-title">iPhone 14 Pro</h5>
                       
                       
                    </div>
                </div> 
            </div> 
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="assets/img/Samsung.png" class="card-img-top" alt="Samsung Galaxy S23 Ultra">
                    <div class="card-body">
                        <h5 class="card-title">Samsung Galaxy S23 Ultra</h5>
                       
                       
                    </div>
                </div> <!-- ./card -->
            </div> <!-- ./col -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="assets/img/Apple Watch.png" class="card-img-top" alt="Apple Watch Series 8">
                    <div class="card-body">
                        <h5 class="card-title">Apple Watch Series 8</h5>
                       
                       
                    </div>
                </div> 
            </div> 
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="assets/img/Airpods.png" class="card-img-top" alt="AirPods Pro 2">
                    <div class="card-body">
                        <h5 class="card-title">AirPods Pro 2</h5>
                       
                     
                    </div>
                </div> 
            </div> 
            <div class="col-lg-3 col-md-3 col-sm-12 mt-4">
                <div class="card" style="width: 18rem;">
                    <img src="assets/img/Asus.png" class="card-img-top" alt="ASUS ROG Strix G15">
                    <div class="card-body">
                        <h5 class="card-title">ASUS ROG Strix G15</h5>
                        
                    
                    </div>
                </div>
            </div> 
            <div class="col-lg-3 col-md-3 col-sm-12 mt-4">
                <div class="card" style="width: 18rem;">
                    <img src="assets/img/LG.png" class="card-img-top" alt="LG OLED C2 65-inch">
                    <div class="card-body">
                        <h5 class="card-title">LG OLED C2 65-inch</h5>
                      
                  
                    </div>
                </div> 
            </div> 
            <div class="col-lg-3 col-md-3 col-sm-12 mt-4">
                <div class="card" style="width: 18rem;">
                    <img src="assets/img/JBL.png" class="card-img-top" alt="JBL Charge 5">
                    <div class="card-body">
                        <h5 class="card-title">JBL Charge 5</h5>
                       
                     
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mt-4">
                <div class="card" style="width: 18rem;">
                    <img src="assets/img/sony.png" class="card-img-top" alt="Sony Alpha a7 III">
                    <div class="card-body">
                        <h5 class="card-title">Sony Alpha a7 III</h5>
                     
                    </div>
                </div> 
            </div> 
        </div> 
        <div class="text-center mt-5">
            <a href="shop.php" class="btn btn-sm btn-outline-primary">Shop page &rarr;</a>
        </div>
    </div>
</div>


<div class="about-us py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <img src="./assets/img/aboutus.webp" class="img-fluid" alt="eStore" />
            </div>
            <div class="col-lg-6 offset-lg-1 col-md-6 offset-md-1 col-sm-12 offset-sm-0">
                <h2>eStore</h2>
                <p>
                 eStore është destinacioni juaj online për blerje të shpejta, të sigurta dhe moderne. Me një gamë të gjerë produktesh – nga teknologjia, moda e deri te aksesorët e përditshëm – ju mund të gjeni gjithçka që ju nevojitet në një vend të vetëm.
                </p>
                <p class="mt-2">
                     Ne ofrojmë çmime konkurruese, transport të shpejtë dhe shërbim të shkëlqyer ndaj klientit. Regjistrohuni sot dhe përjetoni blerjen më të lehtë që keni provuar ndonjëherë!
                </p>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

  <?php if ($show_cookie_popup): ?>
<div style="position:fixed; bottom:10px; left:10px; right:10px; background:#333; color:#fff; padding:15px; text-align:center; z-index:9999; font-family: Arial, sans-serif;">
    Kjo faqe përdor cookies për përmirësimin e shërbimit.
    <a href="?accept_cookies=yes" style="color:#4CAF50; font-weight:bold; text-decoration:none; margin-left:10px;">Pranoj</a>
    <a href="?cancel_cookies=yes" style="color:#f44336; font-weight:bold; text-decoration:none; margin-left:10px;">Anulo</a>
</div>
<?php endif; ?>
