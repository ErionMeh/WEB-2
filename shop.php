<?php include('includes/header.php'); ?>


<!-- Products -->
<div class="products py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h2>Explore products</h2>
                <p>45.960 products available</p>
            </div>
            <div>
                <form action="#">
                    <select name="filter" id="filter" class="form-control">
                        <option value="">Filter products &darr;</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="row mt-5">

        <?php
        define("VAT", 0.05);

        $products=[
           ["name" => "Samsung Galaxy A14", "price" => 2450.50, "discount" => 0.15, "stock" => 3, "img" => "assets/img/galaxy-a14.jpg"]
           ["name" => "iPhone 13 Pro", "price" => 999.00, "discount" => 0.10, "stock" => 0, "img" => "assets/img/iphone-13-pro.jpg"],
           ["name" => "MacBook Air M2", "price" => 1249.00, "discount" => 0.12, "stock" => 8, "img" => "assets/img/macbook-air.jpg"],
           ["name" => "Sony WH-1000XM5", "price" => 349.99, "discount" => 0.20, "stock" => 2, "img" => "assets/img/sony-headphones.jpg"],
           ["name" => "Lenovo Legion 5", "price" => 1599.00, "discount" => 0.18, "stock" => 4, "img" => "assets/img/legion-5.jpg"],
           ["name" => "GoPro HERO12", "price" => 429.00, "discount" => 0.15, "stock" => 7, "img" => "assets/img/gopro12.jpg"],
           ["name" => "JBL Flip 6 Speaker", "price" => 129.99, "discount" => 0.10, "stock" => 15, "img" => "assets/img/jbl-flip6.jpg"],
           ["name" => "PlayStation 5", "price" => 599.99, "discount" => 0.05, "stock" => 1, "img" => "assets/img/ps5.jpg"],
           ["name" => "Men's Cotton T-Shirt", "price" => 19.99, "discount" => 0.10, "stock" => 7, "img" => "assets/img/tshirt.jpg"],
           ["name" => "Chocolate Gift Box", "price" => 24.50, "discount" => 0.20, "stock" => 10, "img" => "assets/img/chocolate.jpg"],
           ["name" => "The Alchemist (Book)", "price" => 14.99, "discount" => 0.25, "stock" => 2, "img" => "assets/img/alchemist.jpg"],
           ["name" => "Basketball Size 7", "price" => 29.99, "discount" => 0.10, "stock" => 0, "img" => "assets/img/basketball.jpg"],
           ["name" => "Running Shoes", "price" => 89.90, "discount" => 0.18, "stock" => 4, "img" => "assets/img/shoes.jpg"],
           ["name" => "Ceramic Coffee Mug", "price" => 11.99, "discount" => 0.10, "stock" => 12, "img" => "assets/img/mug.jpg"],
           ["name" => "Gaming Mouse Pad", "price" => 17.49, "discount" => 0.20, "stock" => 6, "img" => "assets/img/mousepad.jpg"],
           ["name" => "Organic Green Tea (Box)", "price" => 8.99, "discount" => 0.12, "stock" => 0, "img" => "assets/img/greentea.jpg"],
        ];

        foreach ($products as $product):
            $name = $product['name'];
            $price = $product['price'];
            $discount = $product['discount'];
            $stock = $product['stock'];
            $img = $product['img'];

            $priceAfterDiscount = $price - ($price * $discount);
            $vatAmount = $priceAfterDiscount * VAT;
            $final = $priceAfterDiscount + $vatAmount;
        ?>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="https://hhstsyoejx.gjirafa.net/gj50/img/204546/thumb/0.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $name ?></h5>
                        

                        <a href="#" class="btn btn-outline-secondary">View product</a>
                    </div>
                </div> <!-- ./card -->
            </div> <!-- ./col -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="https://hhstsyoejx.gjirafa.net/gj50/img/204546/thumb/0.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product title</h5>
                        <p class="card-text">
                            <strike>2450.50 &euro;</strike>
                            <span class="badge bg-danger">10%</span>
                            <span>2120 &euro;</span>
                        </p>
                        <a href="#" class="btn btn-outline-secondary">View product</a>
                    </div>
                </div> <!-- ./card -->
            </div> <!-- ./col -->
        </div> <!-- ./row -->
    </div>
</div>


<?php include('includes/footer.php'); ?>