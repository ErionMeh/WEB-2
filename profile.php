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

// Marrja e preferencave të përdoruesit nga cookie
$userPrefs = [];
if (isset($_COOKIE['user_prefs_'.$_SESSION['user']['id']])) {
    $userPrefs = json_decode($_COOKIE['user_prefs_'.$_SESSION['user']['id']], true);
}

// Përpunimi i formës së preferencave
if (isset($_POST['update_preferences'])) {
    try {
        $newPrefs = [
            'theme' => $_POST['theme'] ?? 'light',
            'language' => $_POST['language'] ?? 'sq',
            'font_size' => $_POST['font_size'] ?? 'medium',
            'notifications' => isset($_POST['notifications']) ? 1 : 0
        ];
        
setcookie('user_prefs_'.$_SESSION['user']['id'], json_encode($newPrefs), [
            'expires' => time() + (30 * 24 * 60 * 60), // 30 ditë
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        
        $_SESSION['success_message'] = "Preferencat u ruajtën me sukses!";
        header("Location: profile.php");
        exit();
    } catch (Exception $e) {
        $message = '<div class="alert alert-danger">Gabim: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}

// Process form submission for support message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject'])) {
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
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success_message']) ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <?php if (!empty($_SESSION['user']['avatar'])): ?>
                            <img src="<?= htmlspecialchars($_SESSION['user']['avatar']) ?>" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;" alt="Profile Photo">
                        <?php else: ?>
                            <i class="bi bi-person-circle" style="font-size: 5rem; color: #6c757d;"></i>
                        <?php endif; ?>
                    </div>
                    <h4><?= htmlspecialchars($_SESSION['user']['name'] ?? 'Përdorues') ?></h4>
                    <p class="text-muted mb-1"><?= htmlspecialchars($_SESSION['user']['email']) ?></p>
                    <p class="text-muted">
                        <span class="badge bg-<?= ($_SESSION['user']['role'] === 'admin') ? 'primary' : 'secondary' ?>">
                            <?= htmlspecialchars($_SESSION['user']['role']) ?>
                        </span>
                    </p>

                </div>
                
                <div class="card-footer">
                    <h5 class="mb-3">Statistikat</h5>
                    <div class="d-flex justify-content-between small">
                        <span>Anëtar që:</span>
                        <span><?= date('d/m/Y', strtotime($_SESSION['user']['created_at'] ?? 'now')) ?></span>
                    </div>
                    <div class="d-flex justify-content-between small mt-2">
                        <span>Hyrja e fundit:</span>
                        <span><?= date('d/m/Y H:i', strtotime($_SESSION['user']['last_login'] ?? 'now')) ?></span>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="support-tab" data-bs-toggle="tab" data-bs-target="#support" type="button" role="tab">Mbështetje</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="preferences-tab" data-bs-toggle="tab" data-bs-target="#preferences" type="button" role="tab">Preferencat</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab">Aktiviteti</button>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body">
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Support Tab -->
                        <div class="tab-pane fade show active" id="support" role="tabpanel">
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
                        
                        <!-- Preferences Tab -->
                        <div class="tab-pane fade" id="preferences" role="tabpanel">
                            <h3 class="mb-4">Preferencat e tua</h3>
                            
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tema</label>
                                        <select class="form-select" name="theme">
                                            <option value="light" <?= ($userPrefs['theme'] ?? 'light') === 'light' ? 'selected' : '' ?>>Light</option>
                                            <option value="dark" <?= ($userPrefs['theme'] ?? 'light') === 'dark' ? 'selected' : '' ?>>Dark</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="update_preferences" class="btn btn-primary px-4">
                                        <i class="bi bi-save me-2"></i>Ruaj Preferencat
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Aktiviteti Tab -->
<div class="tab-pane fade" id="activity" role="tabpanel">
    <h3 class="mb-4">Aktiviteti i fundit</h3>
    
    <div class="list-group">
        <div class="list-group-item">
            <div class="d-flex justify-content-between">
                <span>Hyrja e fundit</span>
                <span><?= date('d/m/Y H:i', strtotime($_SESSION['user']['last_login'] ?? 'now')) ?></span>
            </div>
        </div>
        <div class="list-group-item">
            <div class="d-flex justify-content-between">
                <span>Numri i vizitave</span>
                <span><?= $_COOKIE['visit_count_'.$_SESSION['user']['id']] ?? 1 ?></span>
            </div>
        </div>
        <div class="list-group-item">
            <div class="d-flex justify-content-between">
                <span>Preferuara tema</span>
                <span><?= ucfirst($_SESSION['user']['theme'] ?? 'light') ?></span>
            </div>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>