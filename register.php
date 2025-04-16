<?php 
include('includes/header.php');
require_once '../classes/User.php';

$error = '';
$success = '';


$fullname = $_POST['fullname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password1'] ?? '';
$confirm_password = $_POST['password2'] ?? '';

if (!empty($fullname) && !empty($email) && !empty($password) && !empty($confirm_password)) {
    if ($password !== $confirm_password) {
        $error = 'Passwords do not match!';
    } else {
        $user = new User();
        $user->register($fullname, $email, $password);
        $success = 'Registration successful!';
    }
} elseif (!empty($_POST)) {
    $error = 'All fields are required!';
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
                    <h2>Register</h2>
                    <form action="#">
                        <div class="form-group">
                            <label for="fullname my-2">Fullname</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your name and surname" />
                        </div>
                        <div class="form-group my-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" />
                        </div>
                        <div class="form-group my-4">
                            <label for="password">Password</label>
                            <input type="password" name="password1" id="password" class="form-control" placeholder="Enter your password" />
                        </div>
                        <div class="form-group my-4">
                            <label for="password">Repeat password</label>
                            <input type="password" name="password2" id="password" class="form-control" placeholder="Repeat your password" />
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-primary">Register</button>
                        <a href="login.php" class="btn btn-sm btn-link">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>