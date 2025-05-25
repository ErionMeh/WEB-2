<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user']);
$user = $isLoggedIn ? $_SESSION['user'] : null;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eStore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        .carousel-item img,
        .image-wrapper img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            display: block;
        }
        
        .image-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500px;
            overflow: hidden;
        }
        
        .navbar .dropdown-menu-right {
            right: 0;
            left: auto;
        }
        
        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">eStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            Cart
                            <?php if ($isLoggedIn && isset($_SESSION['cart_count'])): ?>
                                <span class="badge bg-danger ms-1"><?= htmlspecialchars($_SESSION['cart_count']) ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
                 <!-- Përshëndetja vetëm kur është i kyçur -->
                <?php if ($isLoggedIn && isset($_SESSION['username'])): ?>
                    <?php
                    function mesazhPershendetje() {
                        return "Mirë se vini, " . htmlspecialchars($_SESSION['username']) . "!";
                    }
                    ?>
                    <span class="navbar-text text-success fw-semibold me-3">
                        <?= mesazhPershendetje(); ?>
                    </span>
                <?php endif; ?>
                
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if (!empty($user['avatar'])): ?>
                                    <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="User Avatar" class="user-avatar">
                                <?php else: ?>
                                    <i class="bi bi-person-circle me-1"></i>
                                <?php endif; ?>
                                <?= htmlspecialchars($user['name'] ?? 'User') ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <?php if ($user['is_admin'] ?? false): ?>
                                    <li><a class="dropdown-item" href="admin/dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Admin Panel</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <form class="d-flex ms-3" role="search" method="get" action="shop.php">
                    <input class="form-control me-2" type="search" placeholder="Search products..." name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>