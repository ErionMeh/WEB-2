<?php
include('includes/header.php');

if (isset($_GET['theme'])) {
    $theme = $_GET['theme'] === 'dark' ? 'dark' : 'light';
    
    // Ruaj në cookie global
    setcookie('theme', $theme, [
        'expires' => time() + (365 * 24 * 60 * 60),
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    
    // Nëse përdoruesi është i kyçur, ruaj në session dhe cookie të përdoruesit
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        $_SESSION['user']['theme'] = $theme;
        
        // Merr preferencat ekzistuese
        $userPrefs = [];
        if (isset($_COOKIE['user_prefs_'.$userId])) {
            $userPrefs = json_decode($_COOKIE['user_prefs_'.$userId], true);
        }
        
        // Përditëso temën
        $userPrefs['theme'] = $theme;
        
        // Ruaj përsëri
        setcookie('user_prefs_'.$userId, json_encode($userPrefs), [
            'expires' => time() + (365 * 24 * 60 * 60),
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }
    
    // Kthehu në faqen e mëparshme
    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header('Location: ' . $referer);
    exit();
}