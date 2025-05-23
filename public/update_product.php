<?php
require_once '../classes/db.php';
require_once '../classes/product.php';

$db = new Db();
$conn = $db->conn;
$product = new Product($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    header('Content-Type: application/json');
    $id = intval($_GET['id']);
    $data = $product->getById($id);
    if ($data) {
        echo json_encode(['success' => true, 'product' => $data]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Produkti nuk u gjet.']);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);
    if ($input) {
        $id = intval($input['id'] ?? 0);
        $name = trim($input['name'] ?? '');
        $description = trim($input['description'] ?? '');
        $price = floatval($input['price'] ?? 0);
        $stock = intval($input['stock'] ?? 0);

        if ($product->update($id, $name, $description, $price, $stock)) {
            echo json_encode(['success' => true, 'message' => 'Produkti u përditësua me sukses!']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gabim gjatë përditësimit!']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Të dhënat janë të pavlefshme.']);
    }
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8" />
    <title>Përditëso Produktin</title>
    <style>
        /* Reset i vogël */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background:  #f9f9f9;
            color: #333;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            max-width: 450px;
            width: 100%;
        }
        h2 {
            margin-bottom: 25px;
            color: #222;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #555;
        }
        input[type="number"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border: 1.8px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        input[type="number"]:focus,
        input[type="text"]:focus,
        textarea:focus {
            border-color: #2575fc;
            outline: none;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
            font-family: inherit;
        }
        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background: #2575fc;
            border: none;
            color: white;
            font-weight: 700;
            font-size: 17px;
            border-radius: 7px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(37,117,252,0.4);
            transition: background 0.3s ease;
        }
        button:hover {
            background: #185bcf;
            box-shadow: 0 8px 20px rgba(24,91,207,0.6);
        }
        #message {
            margin-top: 20px;
            font-weight: 700;
            font-size: 16px;
            text-align: center;
        }
        #message.success {
            color: #2e7d32; /* green */
        }
        #message.error {
            color: #d32f2f; /* red */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Përditëso Produktin</h2>
        <form id="updateForm" autocomplete="off">
            <label for="productId">ID e produktit:</label>
            <input type="number" id="productId" name="id" required>

            <label for="name">Emri i ri:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Përshkrimi i ri:</label>
            <textarea id="description" name="description"></textarea>

            <label for="price">Çmimi i ri:</label>
            <input type="number" step="0.01" id="price" name="price" required>

            <label for="stock">Sasia e re në stok:</label>
            <input type="number" id="stock" name="stock" required>

            <button type="submit">Përditëso produktin</button>
        </form>
        <div id="message"></div>
    </div>

    <script>
        const messageDiv = document.getElementById('message');

        document.getElementById('productId').addEventListener('change', function() {
            const id = this.value;
            if (!id) return;

            fetch('update_product.php?id=' + id)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('name').value = data.product.name;
                        document.getElementById('description').value = data.product.description;
                        document.getElementById('price').value = data.product.price;
                        document.getElementById('stock').value = data.product.stock;
                        messageDiv.textContent = '';
                        messageDiv.className = '';
                    } else {
                        messageDiv.textContent = data.error;
                        messageDiv.className = 'error';

                        // Pastrimi i fushave
                        document.getElementById('name').value = '';
                        document.getElementById('description').value = '';
                        document.getElementById('price').value = '';
                        document.getElementById('stock').value = '';
                    }
                })
                .catch(() => {
                    messageDiv.textContent = 'Gabim në marrjen e produktit.';
                    messageDiv.className = 'error';
                });
        });

        document.getElementById('updateForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('productId').value;
            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;
            const price = document.getElementById('price').value;
            const stock = document.getElementById('stock').value;

            fetch('update_product.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ id, name, description, price, stock })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    messageDiv.textContent = data.message;
                    messageDiv.className = 'success';
                } else {
                    messageDiv.textContent = data.error;
                    messageDiv.className = 'error';
                }
            })
            .catch(() => {
                messageDiv.textContent = 'Gabim gjatë përditësimit.';
                messageDiv.className = 'error';
            });
        });
    </script>
</body>
</html>
