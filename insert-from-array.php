<?php
require_once 'classes/db.php';
require_once 'classes/product.php';

$db = new Db();
$conn = $db->conn;
$product = new Product($conn);

// Array me produktet që i ke ti
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

$product->bulkInsert($products);
echo "Produktet u insertuan me sukses!";
?>
