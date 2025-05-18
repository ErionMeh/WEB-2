<?php
require_once '../classes/db.php';
require_once '../classes/product.php';

$product = new Product($conn);
$products = $product->getAll();
?>

<h2>Lista e produkteve</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>Emri</th><th>Përshkrimi</th><th>Çmimi</th><th>Stoku</th>
    </tr>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['id']) ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['description']) ?></td>
            <td><?= htmlspecialchars($p['price']) ?></td>
            <td><?= htmlspecialchars($p['stock']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
