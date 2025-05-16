<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$productId = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;
$name = $_GET['name'] ?? '';
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0.0;


if (!$productId && $action !== 'empty') {
    header("Location: shop.php");
    exit;
}

switch ($action) {
    case 'add':
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['qty']++;
        } else {
            if (!empty($name) && $price > 0) {
                $_SESSION['cart'][$productId] = [
                    'id' => $productId,
                    'name' => htmlspecialchars($name),
                    'price' => $price,
                    'qty' => 1
                ];
            }
        }
        break;

    case 'increase':
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['qty']++;
        }
        break;

    case 'decrease':
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['qty']--;
            if ($_SESSION['cart'][$productId]['qty'] <= 0) {
                unset($_SESSION['cart'][$productId]);
            }
        }
        break;

    case 'empty':
        $_SESSION['cart'] = [];
        break;
}

header("Location: cart.php");
exit;
