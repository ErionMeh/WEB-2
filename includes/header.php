<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
.carousel-item img {
    width: 100%;
    height: auto;
    object-fit: cover; 
    display: block;
}

.carousel-item img {
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
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
                </li>
 

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="login.php">Login</a></li>
                        <li><a class="dropdown-item" href="register.php">Register</a></li>
                    </ul>
                </li>
            </ul>
          <?php if (isset($_SESSION['fullname'])): ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="bi bi-person-circle me-1"></i>
            <?= htmlspecialchars($_SESSION['fullname']) ?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="profile.php">Profili</a></li>
            <li><a class="dropdown-item text-danger" href="logout.php">Dil</a></li>
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

                     <form class="d-flex" role="search" method="get" action="shop.php">
    <input class="form-control me-2" type="search" placeholder="Search products..." name="search" value="<?= $_GET['search'] ?? '' ?>">
    <button class="btn btn-outline-light" type="submit">Search</button>
</form>
            </div>
        </div>
    </nav>
    
