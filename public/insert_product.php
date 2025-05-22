<?php
require_once '../classes/db.php';
$db = new Db();
$conn = $db->conn;
require_once '../classes/product.php';


$product = new Product($conn);

if (isset($_POST['submit'])) {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = floatval($_POST['price'] ?? 0);
    $stock = intval($_POST['stock'] ?? 0);

    if ($product->insert($name, $description, $price, $stock)) {
        echo "Produkti u shtua me sukses!";
    } else {
        echo "Gabim gjatë shtimit të produktit!";
    }
}
?>

<form method="POST">
    Emri i produktit: <input type="text" name="name" required><br>
    Përshkrimi: <textarea name="description"></textarea><br>
    Çmimi: <input type="number" step="0.01" name="price" required><br>
    Sasia në stok: <input type="number" name="stock" required><br>
    <button type="submit" name="submit">Shto produktin</button>
</form>
