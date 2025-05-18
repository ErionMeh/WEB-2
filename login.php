<?php
session_start();  // Fillimisht hapim sesionin

include('includes/header.php'); 
require_once 'classes/db.php';  // Konektimi me DB, krijohet $conn
require_once 'classes/User.php';
require_once 'classes/Admin.php';

$error = '';
$success = '';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Nese po vie POST dhe email+password nuk jane bosh
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($email) && !empty($password)) {
    $admin = new Admin($conn);
    if ($admin->login($email, $password)) {
        // Ruaj session për adminin
        $_SESSION['user_id'] = $admin->getId();
        $_SESSION['fullname'] = $admin->getFullname();
        $_SESSION['role'] = 'admin';

        // Redirect tek faqja kryesore pas login-it
        header('Location: index.php');
        exit();
    } else {
        $user = new User($conn);
        if ($user->login($email, $password)) {
            // Ruaj session për userin
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['fullname'] = $user->getFullname();
            $_SESSION['role'] = 'user';

            // Redirect tek faqja kryesore pas login-it
            header('Location: index.php');
            exit();
        } else {
            $error = 'Email ose fjalëkalim i gabuar!';
        }
    }
}
?>

<!-- Login -->
<div class="auth py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src="./assets/img/aboutus.webp" class="img-fluid" alt="eStore" />
            </div>
            <div class="col-lg-5 offset-lg-1 col-md-5 offset-md-1 col-sm-12 offset-sm-0 d-flex align-items-center">
                <div class="login w-100">
                    <h2>Login</h2>
                    <form action="" method="post">
                        <div class="form-group my-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="<?= htmlspecialchars($email) ?>" />
                        </div>
                        <div class="form-group my-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" />
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-primary">Login</button>
                        <a href="register.php" class="btn btn-sm btn-link">Register</a>
                    </form>

                    <?php if ($error): ?>
                        <div class="alert alert-danger mt-3"><?= $error ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
