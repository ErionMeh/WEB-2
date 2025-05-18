<?php
require_once '../classes/db.php';
require_once '../classes/product.php';

$product = new Product($conn);

if (isset($_POST['submit'])) {
    $id = intval($_POST['id'] ?? 0);

    if ($product->delete($id)) {
        echo "Produkti u fshi me sukses!";
    } else {
        echo "Gabim gjatë fshirjes!";
    }
}
?>

<form method="POST">
    ID e produktit për fshirje: <input type="number" name="id" required><br>
    <button type="submit" name="submit">Fshi produktin</button>
</form>
