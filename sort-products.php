<?php include 'includes/header.php'; ?>

<h2>Produktet Elektronike</h2>

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
    ["emri" => "Laptop Lenovo", "cmimi" => 599.99],
    ["emri" => "Smartphone Samsung", "cmimi" => 299.90],
    ["emri" => "Kufje Wireless", "cmimi" => 24.99],
    ["emri" => "Mouse Gaming", "cmimi" => 19.99],
    ["emri" => "Tablet iPad", "cmimi" => 429.00],
    ["emri" => "Monitor Dell", "cmimi" => 189.00],
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

// Shfaqim produktet
echo "<ul>";
foreach ($products as $p) {
    echo "<li><strong>{$p['emri']}</strong> – {$p['cmimi']}€</li>";
}
echo "</ul>";
?>

<hr>
<h3>Shembuj të sortimeve në PHP</h3>

<?php
$emrat = ["Tablet", "Laptop", "Monitor", "Smartphone"];
$cmimet = ["A" => 299, "B" => 129, "C" => 479];
$produktetAssoc = ["x" => "iPhone", "a" => "AirPods", "b" => "iMac"];

echo "<h4>sort()</h4>";
sort($emrat);
print_r($emrat);

echo "<h4>rsort()</h4>";
$emrat = ["Tablet", "Laptop", "Monitor", "Smartphone"];
rsort($emrat);
print_r($emrat);

echo "<h4>asort()</h4>";
asort($cmimet);
print_r($cmimet);

echo "<h4>arsort()</h4>";
arsort($cmimet);
print_r($cmimet);

echo "<h4>ksort()</h4>";
ksort($produktetAssoc);
print_r($produktetAssoc);

echo "<h4>krsort()</h4>";
krsort($produktetAssoc);
print_r($produktetAssoc);
?>

<hr>
<h3>Shembull me global</h3>

<?php
$zbritje = 0.10; 

function llogaritCmimin($cmimi) {
    global $zbritje;
    return $cmimi - ($cmimi * $zbritje);
}

$cmimiOrigjinal = 500;
$cmimiMeZbritje = llogaritCmimin($cmimiOrigjinal);

echo "Çmimi origjinal: $cmimiOrigjinal €<br>";
echo "Çmimi me zbritje: $cmimiMeZbritje €";
?>

<?php include 'includes/footer.php'; ?>


