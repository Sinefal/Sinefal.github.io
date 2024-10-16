<?php
include 'koneksidb.php'; 

$id = $_GET['id'];

$sql = "DELETE FROM reviews WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Review deleted successfully!";
    header("Location: displayreview.php"); 
    exit();
} else {
    echo "Error deleting review: " . $conn->error;
}

$conn->close(); 
?>
