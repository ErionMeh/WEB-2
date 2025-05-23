<?php
require 'env.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libs/PHPMailer-master/src/Exception.php';
require 'libs/PHPMailer-master/src/PHPMailer.php';
require 'libs/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $env['EMAIL_USER'];  // nga .env
    $mail->Password   = $env['EMAIL_PASS'];  // nga .env
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom($env['EMAIL_USER'], 'Emri yt'); // emri qe do te shfaqet si dërgues
    $mail->addAddress('desti_email@example.com', 'Emri destinuesit'); // emaili ku do ta dergosh

    $mail->isHTML(true);
    $mail->Subject = 'Test Email nga eStore';
    $mail->Body    = 'Ky eshte nje email <b>test</b> nga projekti eStore.';
    $mail->AltBody = 'Ky eshte nje email test nga projekti eStore.';

    $mail->send();
    echo 'Emaili u dergua me sukses!';
} catch (Exception $e) {
    echo "Gabim ne dërgimin e emailit: {$mail->ErrorInfo}";
}
?>
