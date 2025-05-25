<?php
// Session is already started in header.php
include('includes/header.php');


// Check if user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Ju duhet të kyçeni për të parë profilin.";
    header("Location: login.php");
    exit();
}


// Load PHPMailer and environment configuration
require_once 'env.php';
require_once 'libs/PHPMailer-master/src/Exception.php';
require_once 'libs/PHPMailer-master/src/PHPMailer.php';
require_once 'libs/PHPMailer-master/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$message = '';
$formData = ['subject' => '', 'message' => ''];


// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate and sanitize input
        $formData['subject'] = trim($_POST['subject'] ?? '');
        $formData['message'] = trim($_POST['message'] ?? '');


        if (empty($formData['subject'])) {
            throw new Exception("Subjekti është i detyrueshëm.");
        }


        if (empty($formData['message'])) {
            throw new Exception("Mesazhi është i detyrueshëm.");
        }


        // Initialize PHPMailer
        $mail = new PHPMailer(true);
       
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $env['SMTP_HOST'] ?? 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $env['EMAIL_USER'];
        $mail->Password   = $env['EMAIL_PASS'];
        $mail->SMTPSecure = $env['SMTP_SECURE'] ?? 'tls';
        $mail->Port       = $env['SMTP_PORT'] ?? 587;
        $mail->CharSet    = 'UTF-8';


        // Recipients
        $mail->setFrom($env['EMAIL_USER'], 'eStore Support');
        $mail->addAddress($env['EMAIL_USER']);
        $mail->addReplyTo($_SESSION['user']['email'], $_SESSION['user']['name'] ?? '');


        // Content
        $mail->isHTML(true);
        $mail->Subject = $formData['subject'];
        $mail->Body    = nl2br(htmlspecialchars($formData['message']));
        $mail->AltBody = strip_tags($formData['message']);


        // Send email
        if (!$mail->send()) {
            throw new Exception("Dërgimi i emailit dështoi: " . $mail->ErrorInfo);
        }


        $message = '<div class="alert alert-success">Emaili u dërgua me sukses!</div>';
       
        // Clear form on success
        $formData = ['subject' => '', 'message' => ''];


    } catch (Exception $e) {
        $message = '<div class="alert alert-danger">Gabim: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}
?>


<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-person-circle" style="font-size: 5rem; color: #6c757d;"></i>
                    </div>
                    <h4><?= htmlspecialchars($_SESSION['user']['name'] ?? 'Përdorues') ?></h4>
                    <p class="text-muted mb-1"><?= htmlspecialchars($_SESSION['user']['email']) ?></p>
                    <p class="text-muted">
                        <span class="badge bg-<?= ($_SESSION['user']['role'] === 'admin') ? 'primary' : 'secondary' ?>">
                            <?= htmlspecialchars($_SESSION['user']['role']) ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>
       
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="mb-4">Dërgo mesazh mbështetës</h3>
                   
                    <?= $message ?>
                   
                    <form method="post" novalidate>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjekti *</label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                   value="<?= htmlspecialchars($formData['subject']) ?>" required>
                        </div>
                       
                        <div class="mb-3">
                            <label for="message" class="form-label">Mesazhi *</label>
                            <textarea class="form-control" id="message" name="message"
                                      rows="6" required><?= htmlspecialchars($formData['message']) ?></textarea>
                        </div>
                       
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-send-fill me-2"></i>Dërgo
                            </button>
                            <small class="text-muted">Fushat me * janë të detyrueshme</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
