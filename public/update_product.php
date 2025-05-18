<?php
require_once '../classes/db.php';
require_once '../classes/product.php';

$product = new Product($conn);

if (isset($_POST['submit'])) {
    $id = intval($_POST['id'] ?? 0);
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = floatval($_POST['price'] ?? 0);
    $stock = intval($_POST['stock'] ?? 0);

    if ($product->update($id, $name, $description, $price, $stock)) {
        echo "Produkti u përditësua me sukses!";
    } else {
        echo "Gabim gjatë përditësimit!";
    }
}
?>

<form method="POST">
    ID e produktit: <input type="number" name="id" required><br>
    Emri i ri: <input type="text" name="name" required><br>
    Përshkrimi i ri: <textarea name="description"></textarea><br>
    Çmimi i ri: <input type="number" step="0.01" name="price" required><br>
    Sasia e re në stok: <input type="number" name="stock" required><br>
    <button type="submit" name="submit">Përditëso produktin</button>
</form>
