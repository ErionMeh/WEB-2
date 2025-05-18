<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include('includes/header.php');
?>

<div class="container mt-5">
    <h2>Profili i përdoruesit</h2>
    <p><strong>Emri:</strong> <?= htmlspecialchars($_SESSION['user']['name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
    <p><strong>Roli:</strong> <?= htmlspecialchars($_SESSION['user']['role']) ?></p>
</div>

<?php include('includes/footer.php'); ?>
