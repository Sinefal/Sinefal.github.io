<?php
include 'koneksidb.php'; 

$id = $_GET['id'];

$sql = "SELECT * FROM reviews WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <title>Update Review</title>
</head>
<body>
    <div class="container mx-auto relative">
        <div class="background row absolute">
            <img class="absolute" src="./assets/joke.jpg" alt=""/>
        </div>
        <header class="row relative justify-content-between">
            <img class="col-3" src="./assets/CineboxdLogo.png" alt="Cineboxd Logo" />
            <nav class="col-9 d-flex-row align-items-center lg-d-none">
                <ul class="col-12 justify-content-end nav-list">
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="index.php">HOME</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="#sign-in">SIGN IN</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="#create-account">CREATE ACCOUNT</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="review.php">REVIEW</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="displayreviews">VIEW REVIEWS</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="index.php">ABOUT</a>
                    </li>
                    <li class="nav-list-item col-2 relative">
                        <input type="search" />
                        <img class="absolute" src="./assets/magnifierIcon.png" alt=""/>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <h2 class="h2 text-white">Update Review</h2>
            <form action="prosesupdate.php?id=<?php echo $row['id']; ?>" method="POST" class="review-form mx-auto col-6 d-flex-col" enctype="multipart/form-data">
                <label for="email" class="text-white">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                <label for="judul" class="text-white">Film Title:</label>
                <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($row['judul']); ?>" required>
                <label for="rating" class="text-white">Rating (1-5):</label>
                <input type="number" id="rating" name="rating" min="1" max="5" value="<?php echo htmlspecialchars($row['rating']); ?>" required>
                <label for="review" class="text-white">Review:</label>
                <textarea id="review" name="review" rows="4" required><?php echo htmlspecialchars($row['review']); ?></textarea>
                <label for="poster" class="text-white">Poster:</label>
                <input type="file" id="poster" name="poster" accept="image/*">
                <button type="submit" class="submit-btn">Update</button>
            </form>
        </main>
        <footer class="row">
            <div class="d-flex-row justify-content-between col-12 flex-wrap">
                <ul class="d-flex-row no-list-style justify-content-between col-9 lg-col-12 sm-flex-wrap sm-justify-content-start">
                    <li class="font-bold">Help</li>
                    <li class="font-bold">Terms</li>
                    <li class="font-bold">Privacy</li>
                    <li class="font-bold">Contact</li>
                </ul>
                <ul class="d-flex-row no-list-style justify-content-between col-2 sm-col-5">
                    <li><a href="https://x.com/SineFal"><img src="./assets/twitterIcon.png" alt="" /></a></li>
                    <li>/</li>
                    <li><a href="https://www.facebook.com/MyNameIsNopal"><img src="./assets/facebookIcon.png" alt="" /></a></li>
                    <li>/</li>
                    <li><a href="https://www.instagram.com/naufalfahrozi/"><img src="./assets/instagramIcon.png" alt="" /></a></li>
                </ul>
            </div>
            <p class="col-12"> &copy; Cineboxd Limited. Made by Muhammad Naufal Fahrozi - 2309106062</p>
        </footer>
    </div>
</body>
</html>
