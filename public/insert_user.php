<?php
require_once '../classes/db.php';

if (isset($_POST['submit'])) {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password_raw = $_POST['password'];
    $phone = trim($_POST['phone']);

    // Kontroll bazik
    if (empty($fullname) || empty($email) || empty($password_raw)) {
        echo "Plotëso fushat Fullname, Email dhe Password!";
        exit;
    }

    // Password hash
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // Përgatit query
    $sql = "INSERT INTO users (fullname, email, password, phone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Gabim në përgatitje të query: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssss", $fullname, $email, $password, $phone);

    if ($stmt->execute()) {
        echo "U shtua përdoruesi me sukses!";
    } else {
        if ($conn->errno == 1062) { // Duplicate entry
            echo "Ky email ekziston tashmë!";
        } else {
            echo "Gabim gjatë futjes së të dhënave: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<form method="POST" action="">
    Fullname: <input type="text" name="fullname" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Phone: <input type="text" name="phone"><br>
    <button type="submit" name="submit">Regjistrohu</button>
</form>
