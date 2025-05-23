<?php
header('Content-Type: application/json');

require_once '../classes/Product.php'; // ose rruga ku e ke klasën Product

// Konektimi me DB
$conn = new mysqli('localhost', 'db_user', 'db_pass', 'db_name');
if($conn->connect_error) {
    echo json_encode(['error' => 'Nuk u lidh me DB']);
    exit;
}

if(!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID nuk u dhanë']);
    exit;
}

$id = intval($_GET['id']);

$product = new Product($conn);
$data = $product->getById($id);

if(!$data) {
    echo json_encode(['error' => 'Produkti nuk u gjet']);
} else {
    echo json_encode($data);
}

$conn->close();
