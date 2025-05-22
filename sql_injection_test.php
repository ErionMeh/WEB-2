<?php
require_once 'classes/db.php';
$db = new Db();
$conn = $db->conn;

$input = isset($_GET['id']) ? $_GET['id'] : '';

?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Testimi SQL Injection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem auto;
            max-width: 800px;
            background-color: #f9f9f9;
            color: #333;
        }
        .section {
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .danger {
            background-color: #ffe6e6;
            border-left: 6px solid #e60000;
        }
        .safe {
            background-color: #e6ffe6;
            border-left: 6px solid #00b300;
        }
        h2 {
            margin-top: 0;
        }
        code {
            background-color: #eee;
            padding: 0.2rem 0.4rem;
            border-radius: 5px;
            font-family: monospace;
        }
    </style>
</head>
<body>

<h1>Demonstrimi i SQL Injection</h1>
<p><strong>Inputi i dhënë:</strong> <?= htmlspecialchars($input) ?></p>

<div class="section danger">
    <h2>Pa mbrojtje (Rrezik për SQL Injection)</h2>
   <?php
if (is_numeric($input)) {
    $sql1 = "SELECT * FROM products WHERE id = $input";
    echo "<p><strong>Query pa mbrojtje:</strong><br><code>$sql1</code></p>";
    $result1 = $conn->query($sql1);

    if ($result1 && $result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            echo "<p><strong>Produkt:</strong> " . htmlspecialchars($row['name']) . "</p>";
        }
    } else {
        echo "<p><em>Asnjë produkt nuk u gjet.</em></p>";
    }
} else {
    echo "<p style='color: red;'><em>ID e papranueshme për query pa mbrojtje.</em></p>";
}
?>

</div>

<div class="section safe">
    <h2>Me mbrojtje (Prepared Statement)</h2>
    <?php
    echo "<p><strong>Query me mbrojtje:</strong><br><code>SELECT * FROM products WHERE id = ?</code></p>";

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $input);
    $stmt->execute();
    $result2 = $stmt->get_result();

    if ($result2 && $result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            echo "<p><strong>Produkt:</strong> " . htmlspecialchars($row['name']) . "</p>";
        }
    } else {
        echo "<p><em>Asnjë produkt nuk u gjet me prepared statement.</em></p>";
    }

    $stmt->close();
    ?>
</div>

</body>
</html>
