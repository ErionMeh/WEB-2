<?php require_once '../classes/db.php';
$db = new Db();
$conn = $db->conn;
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8" />
    <title>Përditëso Emrin e Përdoruesit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 30px;
        }
        form {
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }
        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="number"]:focus,
        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
        .message {
            max-width: 400px;
            margin: 20px auto;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<form method="POST" novalidate>
    <label for="id">User ID:</label>
    <input type="number" name="id" id="id" required min="1" placeholder="Shkruaj ID-në e përdoruesit" />

    <label for="fullname">Emri i ri:</label>
    <input type="text" name="fullname" id="fullname" required placeholder="Shkruaj emrin e ri" />

    <button type="submit" name="submit">Përditëso Emrin</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $fullname = trim($_POST['fullname']);

    if ($id <= 0 || empty($fullname)) {
        echo '<div class="message error">Ju lutem plotësoni të gjitha fushat saktë.</div>';
    } else {
        $sql = "UPDATE users SET fullname = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $fullname, $id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo '<div class="message success">Emri u përditësua me sukses!</div>';
            } else {
                echo '<div class="message error">Nuk u gjet përdorues me këtë ID ose nuk ka ndryshime.</div>';
            }
        } else {
            echo '<div class="message error">Gabim gjatë përditësimit: ' . htmlspecialchars($conn->error) . '</div>';
        }
        $stmt->close();
    }
}
$conn->close();
?>

</body>
</html>
