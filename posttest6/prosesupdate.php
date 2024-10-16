<?php
include 'koneksidb.php'; 

$id = $_GET['id'];

$email = $conn->real_escape_string($_POST['email']);
$judul = $conn->real_escape_string($_POST['judul']);
$rating = $conn->real_escape_string($_POST['rating']);
$review = $conn->real_escape_string($_POST['review']);

if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
    $poster = $_FILES['poster'];

    if ($poster['size'] > 2 * 1024 * 1024) {
        die("File too large. Maximum size is 2MB.");
    }

    $dateTime = date('Y-m-d H.i.s'); 
    $fileExt = pathinfo($poster['name'], PATHINFO_EXTENSION);
    $newPosterName = "$dateTime.$fileExt";

    if (!move_uploaded_file($poster['tmp_name'], "uploads/$newPosterName")) {
        die("Error uploading file.");
    }

    $sql = "UPDATE reviews SET email='$email', judul='$judul', rating='$rating', review='$review', poster='$newPosterName' WHERE id='$id'";
} else {
    $sql = "UPDATE reviews SET email='$email', judul='$judul', rating='$rating', review='$review' WHERE id='$id'";
}

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Review updated successfully!');
            window.location.href = 'displayreview.php';
          </script>";
} else {
    echo "Error updating review: " . $conn->error;
}

$conn->close();
?>
