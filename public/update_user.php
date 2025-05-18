<?php require_once '../classes/db.php'; ?>

<form method="POST">
    User ID: <input type="number" name="id"><br>
    Emri i ri: <input type="text" name="fullname"><br>
    <button type="submit" name="submit">Update</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];

    $sql = "UPDATE users SET fullname = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $fullname, $id);
    
    if ($stmt->execute()) {
        echo "Emri u përditësu.";
    } else {
        echo "Gabim gjatë update-it.";
    }
}
?>
