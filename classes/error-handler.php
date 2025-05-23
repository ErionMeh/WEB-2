<?php
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    $error_message = "Gabim: [$errno] $errstr në fajllin $errfile në linjën $errline";
    // Ruaje gabimin në log
    file_put_contents("error_log.txt", date("Y-m-d H:i:s") . " - " . $error_message . "\n", FILE_APPEND);
    
    // Shfaqje gabimi me stil (mund edhe me mos e shfaq direkt në prodhim)
    echo "<b>Ndodhi një problem:</b> $errstr në linjën $errline<br>";
}

// Aktivizo error handlerin
set_error_handler("customErrorHandler");
?>
