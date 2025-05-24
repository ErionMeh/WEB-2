<?php
include('includes/header.php');
require_once 'classes/db.php';
require_once 'classes/User.php';
require_once 'classes/Admin.php';

// Initialize variables
$error = '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Redirect if already logged in
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($email) && !empty($password)) {
    try {
        $db = new Db();
        $conn = $db->conn;
        
        // Try admin login first
        $admin = new Admin($conn);
        if ($admin->login($email, $password)) {
            $_SESSION['user'] = [
                'id' => $admin->getId(),
                'name' => $admin->getFullname(),
                'email' => $admin->getEmail(),
                'role' => 'admin',
                'last_login' => date('Y-m-d H:i:s')
            ];
            header('Location: index.php');
            exit();
        }

        // Try regular user login
        $user = new User($conn);
        if ($user->login($email, $password)) {
            $_SESSION['user'] = [
                'id' => $user->getId(),
                'name' => $user->getFullname(),
                'email' => $user->getEmail(),
                'role' => 'user',
                'last_login' => date('Y-m-d H:i:s')
            ];
            
            // Clear any previous error messages
            if (isset($_SESSION['error_message'])) {
                unset($_SESSION['error_message']);
            }
            
            header('Location: index.php');
            exit();
        }

        $error = 'Email ose fjalëkalim i gabuar!';
        
    } catch (Exception $e) {
        error_log('Login error: ' . $e->getMessage());
        $error = 'Ndodhi një gabim. Ju lutem provoni përsëri.';
    }
}
?>

<div class="auth py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src="./assets/img/aboutus.webp" class="img-fluid" alt="eStore" />
            </div>
            <div class="col-lg-5 offset-lg-1 col-md-5 offset-md-1 col-sm-12 offset-sm-0 d-flex align-items-center">
                <div class="login w-100">
                    <h2 class="mb-4">Login</h2>
                    
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger mb-4"><?= htmlspecialchars($_SESSION['error_message']) ?></div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
                    
                    <form method="post" autocomplete="off">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   placeholder="Enter your email" 
                                   value="<?= htmlspecialchars($email) ?>" 
                                   required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" 
                                   class="form-control" 
                                   placeholder="Enter your password" 
                                   required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary px-4">Login</button>
                            <a href="register.php" class="text-decoration-none">Register</a>
                        </div>
                    </form>

                    <?php if ($error): ?>
                        <div class="alert alert-danger mt-4"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>