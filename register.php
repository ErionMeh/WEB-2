<?php 
include('includes/header.php');
require_once 'classes/db.php';
require_once 'classes/User.php';

$db = new Db();
$conn = $db->conn;
$user = new User($conn);

$error = '';
$success = '';
$formData = [
    'fullname' => '',
    'email' => '',
    'phone' => ''
];

// Përpunimi i formës
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Marrja dhe pastrimi i të dhënave
        $formData['fullname'] = trim($_POST['fullname'] ?? '');
        $formData['email'] = trim($_POST['email'] ?? '');
        $formData['phone'] = trim($_POST['phone'] ?? '');
        $password1 = $_POST['password1'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        // Validimet
        if (empty($formData['fullname'])) {
            throw new Exception("Emri i plotë është i detyrueshëm.");
        }

        if (!preg_match("/^[a-zA-Z\s]+$/", $formData['fullname'])) {
            throw new Exception("Emri duhet të përmbajë vetëm shkronja dhe hapësira.");
        }

        if (empty($formData['email'])) {
            throw new Exception("Email-i është i detyrueshëm.");
        }

        if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email-i nuk është valid.");
        }

        if (empty($formData['phone'])) {
            throw new Exception("Numri i telefonit është i detyrueshëm.");
        }

        if (!preg_match("/^\d{3}-\d{3}-\d{3}$/", $formData['phone'])) {
            throw new Exception("Numri i telefonit duhet të jetë në formatin 044-123-456.");
        }

        if (empty($password1) || empty($password2)) {
            throw new Exception("Fjalëkalimi është i detyrueshëm.");
        }

        if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/", $password1)) {
            throw new Exception("Fjalëkalimi duhet të ketë së paku 8 karaktere, një shkronjë të madhe, një numër dhe një simbol.");
        }

        if ($password1 !== $password2) {
            throw new Exception("Fjalëkalimet nuk përputhen.");
        }

        // Regjistrimi në databazë
        $result = $user->register($formData['fullname'], $formData['email'], $formData['phone'], $password1);

        if ($result !== true) {
            throw new Exception($result);
        }

        $success = "Regjistrimi u bë me sukses! Tani mund të kyçeni.";
        $formData = []; // Pastro të dhënat e formës pas regjistrimit të suksesshëm

    } catch (Exception $e) {
        $error = $e->getMessage();
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
                    <h2 class="mb-4">Regjistrohu</h2>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="" autocomplete="off">
                        <div class="form-group mb-3">
                            <label for="fullname" class="form-label">Emri i plotë</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" 
                                   placeholder="Shkruani emrin dhe mbiemrin" 
                                   value="<?= htmlspecialchars($formData['fullname'] ?? '') ?>" 
                                   required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   placeholder="Shkruani email-in tuaj" 
                                   value="<?= htmlspecialchars($formData['email'] ?? '') ?>" 
                                   required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Numri i telefonit</label>
                            <input type="text" name="phone" id="phone" class="form-control" 
                                   placeholder="P.sh. 044-123-456" 
                                   value="<?= htmlspecialchars($formData['phone'] ?? '') ?>" 
                                   required>
                            <small class="text-muted">Formati: 044-123-456</small>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="password1" class="form-label">Fjalëkalimi</label>
                            <input type="password" name="password1" id="password1" 
                                   class="form-control" 
                                   placeholder="Shkruani fjalëkalimin" 
                                   required>
                            <small class="text-muted">Duhet të përmbajë të paktën 8 karaktere, 1 shkronjë të madhe, 1 numër dhe 1 simbol</small>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="password2" class="form-label">Përsërit fjalëkalimin</label>
                            <input type="password" name="password2" id="password2" 
                                   class="form-control" 
                                   placeholder="Përsëritni fjalëkalimin" 
                                   required>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary px-4">Regjistrohu</button>
                            <a href="login.php" class="text-decoration-none">Keni llogari? Kyçuni</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>