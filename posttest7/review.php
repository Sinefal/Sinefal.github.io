<?php
include 'koneksidb.php'; 
session_start(); 

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Harap login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <title>Cineboxd - Review Film</title>
</head>
<body>
    <div class="container mx-auto relative">
        <div class="background row absolute">
            <img class="absolute" src="./assets/Oppenheimer-backdrop.jpg" alt=""/>
        </div>
        <header class="row relative justify-content-between">
            <img class="col-3" src="./assets/CineboxdLogo.png" alt="Cineboxd Logo" />
            <nav class="col-9 d-flex-row align-items-center lg-d-none">
                <ul class="col-12 justify-content-end nav-list">
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="index.php">HOME</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="login.php">SIGN IN</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="register.php">CREATE ACCOUNT</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="review.php">REVIEW</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="displayreview.php">VIEW REVIEWS</a>
                    </li>
                    <li class="nav-list-item">
                            <a class="nav-list-link text-white small" href="logout.php">SIGN OUT</a>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <section class="intro row">
                <article class="col-12 d-flex-col">
                    <h1 class="h1 text-white mx-auto">REVIEW YOUR FILM</h1>

                    <form action="review.php" method="POST" class="review-form mx-auto col-6 d-flex-col" enctype="multipart/form-data">
                        <label for="judul" class="text-white">Film Title:</label>
                        <input type="text" id="judul" name="judul" required>
                        
                        <label for="rating" class="text-white">Rating (1-5):</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" required>
                        
                        <label for="review" class="text-white">Review:</label>
                        <textarea id="review" name="review" rows="4" required></textarea>

                        <label for="poster" class="text-white">Upload Poster Film (max 2MB):</label>
                        <input type="file" id="poster" name="poster" accept="image/*">
                        
                        <button type="submit" class="submit-btn">SUBMIT</button>
                    </form>
                </article>
            </section>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $judul = $conn->real_escape_string($_POST['judul']);
                $rating = $conn->real_escape_string($_POST['rating']);
                $review = $conn->real_escape_string($_POST['review']);
                $poster = NULL;

                if (isset($_FILES['poster']) && $_FILES['poster']['error'] == UPLOAD_ERR_OK) {
                    $target_dir = "uploads/";
                    $timestamp = date('Y-m-d H.i.s'); 
                    $imageFileType = strtolower(pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION));
                    $poster = $timestamp . '.' . $imageFileType;

                    $check = getimagesize($_FILES['poster']['tmp_name']);
                    if ($check !== false) {
                        if ($_FILES['poster']['size'] <= 2097152) { 
                            move_uploaded_file($_FILES['poster']['tmp_name'], $target_dir . $poster);
                        } else {
                            echo "<script>alert('File terlalu besar. Ukuran maksimum 2MB.');</script>";
                            $poster = NULL;
                        }
                    } else {
                        echo "<script>alert('Silakan upload file gambar yang valid.');</script>";
                        $poster = NULL;
                    }
                }

                $sql = "INSERT INTO reviews (username, judul, rating, review, poster) VALUES ('$username', '$judul', '$rating', '$review', '$poster')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Review berhasil ditambahkan!'); window.location.href='login.php';</script>";
                } else {
                    echo "<script>alert('Error: " . $conn->error . "');</script>";
                }
            }
            ?>
        </main>
    </div>
</body>
</html>
