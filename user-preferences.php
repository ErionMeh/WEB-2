<?php
// user-preferences.php
include('includes/header.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prefs = [
        'theme' => $_POST['theme'] ?? 'light',
        'language' => $_POST['language'] ?? 'sq',
        'font_size' => $_POST['font_size'] ?? 'medium'
    ];
    
    setcookie('user_prefs', json_encode($prefs), [
        'expires' => time() + (365 * 24 * 60 * 60),
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    
    $_SESSION['success'] = 'Preferencat u ruajtën me sukses!';
    header('Location: profile.php');
    exit();
}

// Lexo preferencat aktuale
$currentPrefs = [];
if (isset($_COOKIE['user_prefs'])) {
    $currentPrefs = json_decode($_COOKIE['user_prefs'], true);
}
?>

<!-- Forma për preferencat -->