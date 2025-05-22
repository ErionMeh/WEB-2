<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function modifikoCartin(& $cart, $productId, $action, $name = '', $price = 0.0) {
    switch ($action) {
        case 'add':
            if (isset($cart[$productId])) {
                $cart[$productId]['qty']++;
            } else {
                if (!empty($name) && $price > 0) {
                    $cart[$productId] = [
                        'id' => $productId,
                        'name' => htmlspecialchars($name),
                        'price' => $price,
                        'qty' => 1
                    ];
                }
            }
            break;
        case 'increase':
            if (isset($cart[$productId])) {
                $cart[$productId]['qty']++;
            }
            break;
        case 'decrease':
            if (isset($cart[$productId])) {
                $cart[$productId]['qty']--;
                if ($cart[$productId]['qty'] <= 0) {
                    unset($cart[$productId]);
                }
            }
            break;
        case 'empty':
            $cart = [];
            break;
    }
}

$productId = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;
$name = $_GET['name'] ?? '';
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0.0;

if (!$productId && $action !== 'empty') {
    header("Location: shop.php");
    exit;
}

modifikoCartin($_SESSION['cart'], $productId, $action, $name, $price);

header("Location: cart.php");
exit;
