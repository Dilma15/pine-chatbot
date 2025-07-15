<?php
$host = "localhost";
$user = "root";
$pass = ""; // ubah jika pakai password
$dbname = "pine_expert_system";

$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
