<?php
function parseEnv($file) {
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $env = [];
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // linja komenti, e anashkalon
        if (strpos($line, '=') === false) continue; // linja pa =, e anashkalon
        list($key, $value) = explode('=', $line, 2);
        $env[trim($key)] = trim($value);
    }
    return $env;
}

$env = parseEnv(__DIR__ . '/.env');
?>
