<?php
require_once 'classes/db.php';
require_once 'classes/product.php';

$db = new Db();
$conn = $db->conn;
$product = new Product($conn);

// Array me produktet që i ke ti
$products = [
   ["name" => "Samsung Galaxy S23", "price" => 2450.50, "stock" => 3],
           ["name" => "iPhone 13 Pro", "price" => 999.00, "stock" => 0],
           ["name" => "MacBook Air M2", "price" => 1249.00,"stock" => 8 ],
           ["name" => "Sony WH-1000XM5", "price" => 349.99, "stock" => 2],
           ["name" => "Lenovo Legion 5", "price" => 1599.00, "stock" => 4],
           ["name" => "GoPro HERO12", "price" => 429.00, "stock" => 7],
           ["name" => "JBL Flip 6 Speaker", "price" => 129.99, "stock" => 15],
           ["name" => "PlayStation 5", "price" => 599.99, "stock" => 1],
           ["name" => "Men's Cotton T-Shirt", "price" => 19.99,"stock" => 7],
           ["name" => "Basketball Size 7", "price" => 29.99,"stock" => 0],
           ["name" => "Running Shoes", "price" => 89.90, "stock" => 4],
           ["name" => "Ceramic Coffee Mug", "price" => 11.99, "stock" => 12],
           ["name" => "Gaming Mouse Pad", "price" => 17.49, "stock" => 6],
           ["name" => "Organic Green Tea (Box)", "price" => 8.99, "stock" => 0],
];

$product->bulkInsert($products);
echo "Produktet u insertuan me sukses!";
?>
