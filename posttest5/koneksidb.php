<?php
$servername = "localhost";
$username = "root"; // Ubah jika ada username lain
$password = ""; // Ubah jika ada password lain
$dbname = "reviewsdb"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
