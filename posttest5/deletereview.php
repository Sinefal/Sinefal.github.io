<?php
include 'koneksidb.php'; // Menghubungkan ke database

// Mendapatkan ID review yang akan dihapus
$id = $_GET['id'];

// Query untuk menghapus review berdasarkan ID
$sql = "DELETE FROM reviews WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Review deleted successfully!";
    header("Location: displayreview.php"); // Redirect ke halaman display_reviews.php setelah delete
    exit();
} else {
    echo "Error deleting review: " . $conn->error;
}

$conn->close(); // Tutup koneksi database
?>
