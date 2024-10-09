<?php
include 'koneksidb.php'; // Menghubungkan ke database

// Mendapatkan ID review yang ingin diedit
$id = $_GET['id'];

// Jika form disubmit, update data ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $judul = $conn->real_escape_string($_POST['judul']);
    $rating = $conn->real_escape_string($_POST['rating']);
    $review = $conn->real_escape_string($_POST['review']);

    // Query untuk update data review
    $sql = "UPDATE reviews SET email='$email', judul='$judul', rating='$rating', review='$review' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Review updated successfully!";
        header("Location: display_reviews.php"); // Redirect ke halaman display_reviews.php
        exit();
    } else {
        echo "Error updating review: " . $conn->error;
    }
}

// Ambil data review berdasarkan ID untuk ditampilkan di form
$sql = "SELECT * FROM reviews WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    ?>

    <h2>Edit Review</h2>
    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>

        <label for="judul">Judul Film:</label>
        <input type="text" name="judul" value="<?php echo $row['judul']; ?>" required><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" value="<?php echo $row['rating']; ?>" min="1" max="5" required><br>

        <label for="review">Review:</label>
        <textarea name="review" rows="5" required><?php echo $row['review']; ?></textarea><br>

        <button type="submit">Update Review</button>
    </form>

    <?php
} else {
    echo "Review not found.";
}
$conn->close(); // Tutup koneksi database
?>
