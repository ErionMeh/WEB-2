<?php
$servername = "localhost";
$username = "root";
$password = "C@mp.90HFGD";
$dbname = "projekti";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Lidhja me DB dështoi: " . $conn->connect_error);
}
?>
