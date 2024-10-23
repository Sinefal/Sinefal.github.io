<?php
include 'koneksidb.php'; 

session_start(); 

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in to update your review.'); window.location.href='login.php';</script>";
    exit();
}

$id = $_GET['id'];
$username = $_SESSION['username'];

$judul = $conn->real_escape_string($_POST['judul']);
$rating = $conn->real_escape_string($_POST['rating']);
$review = $conn->real_escape_string($_POST['review']);

$result = $conn->query("SELECT * FROM reviews WHERE id='$id' AND username='$username'");
if ($result->num_rows == 0) {
    echo "<script>alert('You do not have permission to edit this review.'); window.location.href='displayreview.php';</script>";
    exit();
}

if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
    $poster = $_FILES['poster'];

    if ($poster['size'] > 2 * 1024 * 1024) {
        echo "<script>alert('File too large. Maximum size is 2MB.'); window.location.href='updatereview.php?id=$id';</script>";
        exit();
    }

    $dateTime = date('Y-m-d H.i.s'); 
    $fileExt = pathinfo($poster['name'], PATHINFO_EXTENSION);
    $newPosterName = "$dateTime.$fileExt";

    if (!move_uploaded_file($poster['tmp_name'], "uploads/$newPosterName")) {
        echo "<script>alert('Error uploading file.'); window.location.href='updatereview.php?id=$id';</script>";
        exit();
    }

    $sql = "UPDATE reviews SET judul='$judul', rating='$rating', review='$review', poster='$newPosterName' WHERE id='$id' AND username='$username'";
} else {
    $sql = "UPDATE reviews SET judul='$judul', rating='$rating', review='$review' WHERE id='$id' AND username='$username'";
}

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Review updated successfully!'); window.location.href='displayreview.php';</script>";
} else {
    echo "<script>alert('Error updating review: " . $conn->error . "'); window.location.href='updatereview.php?id=$id';</script>";
}

$conn->close();
?>