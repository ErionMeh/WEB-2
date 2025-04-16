<?php include 'includes/header.php'; ?>

<h2>Produktet</h2>

<form method="get" style="margin-bottom: 20px;">
    <label>Sorto sipas:</label>
    <select name="sort">
        <option value="">-- Zgjedh --</option>
        <option value="name_asc">Emrit (A-Z)</option>
        <option value="name_desc">Emrit (Z-A)</option>
        <option value="price_asc">Çmimit (nga më i liri)</option>
        <option value="price_desc">Çmimit (nga më i shtrenjti)</option>
    </select>
    <button type="submit">Apliko</button>
</form>

<?php
$products = [
   
];

$sortType = $_GET['sort'] ?? '';

if ($sortType === 'name_asc') {
    usort($products, fn($a, $b) => strcmp($a['emri'], $b['emri']));
} elseif ($sortType === 'name_desc') {
    usort($products, fn($a, $b) => strcmp($b['emri'], $a['emri']));
} elseif ($sortType === 'price_asc') {
    usort($products, fn($a, $b) => $a['cmimi'] <=> $b['cmimi']);
} elseif ($sortType === 'price_desc') {
    usort($products, fn($a, $b) => $b['cmimi'] <=> $a['cmimi']);
}

echo "<ul>";
foreach ($products as $p) {
    echo "<li><strong>{$p['emri']}</strong> – {$p['cmimi']}€</li>";
}
echo "</ul>";
?>

<?php include 'includes/footer.php'; ?>
