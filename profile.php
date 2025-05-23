<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include('includes/header.php');

// Përfshijmë libraritë PHPMailer dhe env.php jashtë POST sepse duhet përpara përdorimit
require 'env.php';
require 'libs/PHPMailer-master/src/Exception.php';
require 'libs/PHPMailer-master/src/PHPMailer.php';
require 'libs/PHPMailer-master/src/SMTP.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = htmlspecialchars($_POST['subject']);
    $body = htmlspecialchars($_POST['message']);

    if (!empty($subject) && !empty($body)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $env['EMAIL_USER'];
            $mail->Password   = $env['EMAIL_PASS'];
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Vendosim që emaili me shku tek ai i SMTP-së (emaili yt)
            $mail->setFrom($env['EMAIL_USER'], 'eStore');
            $mail->addAddress($env['EMAIL_USER']); // emaili i marrësit është ai i SMTP-së

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = nl2br($body);
            $mail->AltBody = $body;

            $mail->send();
            $message = '<div class="alert alert-success">Emaili u dërgua me sukses!</div>';
        } catch (Exception $e) {
            $message = '<div class="alert alert-danger">Gabim në dërgimin e emailit: ' . $mail->ErrorInfo . '</div>';
        }
    } else {
        $message = '<div class="alert alert-warning">Ju lutem plotësoni të gjitha fushat.</div>';
    }
}
?>

<div class="container mt-5">
    <h2>Profili i përdoruesit</h2>
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
    <p><strong>Roli:</strong> <?= htmlspecialchars($_SESSION['user']['role']) ?></p>

    <hr>

    <h3>Dërgo email</h3>
    <?= $message ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="subject" class="form-label">Subjekti</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mesazhi</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Dërgo Email</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
