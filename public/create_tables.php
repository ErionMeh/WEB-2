<?php
require_once '../classes/db.php';

$db = new Db();
$conn = $db->conn;
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    username VARCHAR(100)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'users' u kriju me sukses!";
} else {
    echo "Gabim: " . $conn->error;
}


$sql2 = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    discount DECIMAL(4,2) DEFAULT 0.0,
    img VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";


if ($conn->query($sql2) === TRUE) {
    echo "Tabela 'products' u krijua me sukses!<br>";
} else {
    echo "Gabim në krijimin e tabelës 'products': " . $conn->error . "<br>";
}

$conn->close();
?>
