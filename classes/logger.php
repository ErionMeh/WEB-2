<?php
function shkruajNeLog($mesazhi) {
    $file = fopen("log.txt", "a"); // "a" për append
    fwrite($file, date("Y-m-d H:i:s") . " - " . $mesazhi . "\n");
    fclose($file);
}
?>
