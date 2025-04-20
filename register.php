<?php include('includes/header.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $phone = $_POST['phone'] ?? '';


    $errors = [];

    if (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
        $errors[] = "Emri duhet të përmbajë vetëm shkronja dhe hapësira.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email-i nuk është valid.";
    }

    if (!preg_match("/^\d{3}-\d{3}-\d{3}$/", $phone)) {
        $errors[] = "Numri i telefonit duhet të jetë në formatin 044-123-456.";
    }
    

    
    if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/", $password1)) {
        $errors[] = "Fjalëkalimi duhet të ketë së paku 8 karaktere, një shkronjë të madhe, një numër dhe një simbol.";
    }
    

    
    if ($password1 !== $password2) {
        $errors[] = "Fjalëkalimet nuk përputhen.";
    }

    if (empty($errors)) {
        echo "<div class='alert alert-success'>Regjistrimi u bë me sukses!</div>";
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
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
                    <h2>Register</h2>
                    <form method="POST" action="">

                        <div class="form-group">
                            <label for="fullname my-2">Fullname</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your name and surname" />
                        </div>
                        <div class="form-group my-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" />
                        </div>
                        <div class="form-group my-4">
                           <label for="phone">Phone Number</label>
                             <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. 044-123-456" />
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