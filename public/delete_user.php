<?php require_once '../classes/db.php'; ?>

<form method="POST">
    User ID për fshirje: <input type="number" name="id"><br>
    <button type="submit" name="submit">Fshi</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Përdoruesi u fshi.";
    } else {
        echo "Gabim gjatë fshirjes.";
    }
}
?>
