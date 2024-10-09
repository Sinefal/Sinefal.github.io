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
                        <a class="nav-list-link text-white small" href="#sign-in">SIGN IN</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="#create-account">CREATE ACCOUNT</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="review.php">REVIEW</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="#films">FILMS</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="#about">ABOUT</a>
                    </li>
                    <li class="nav-list-item col-2 relative">
                        <input type="search" />
                        <img class="absolute" src="./assets/magnifierIcon.png" alt=""/>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <section class="intro row">
                <article class="col-12 d-flex-col">
                    <h1 class="h1 text-white mx-auto">REVIEW YOUR FILM</h1>

                    <!-- Form Review -->
                    <form action="review.php" method="POST" class="review-form mx-auto col-6 d-flex-col">
                        <label for="email" class="text-white">Email:</label>
                        <input type="email" id="email" name="email" required>
                        
                        <label for="judul" class="text-white">Film Title:</label>
                        <input type="text" id="judul" name="judul" required>
                        
                        <label for="rating" class="text-white">Rating (1-5):</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" required>
                        
                        <label for="review" class="text-white">Review:</label>
                        <textarea id="review" name="review" rows="4" required></textarea>
                        
                        <button type="submit" class="submit-btn">SUBMIT</button>
                    </form>
                    <p class="text-white mt-3"><a href="displayreview.php" class="submit-btn">View All Reviews</a></p>
                </article>
            </section>

            <!-- Bagian PHP untuk Menyimpan Review ke Database dan Menampilkan Review -->
            <?php
            include 'koneksidb.php'; // Memasukkan file koneksi database

            // Proses menyimpan review saat form disubmit
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $conn->real_escape_string($_POST['email']);
                $judul = $conn->real_escape_string($_POST['judul']);
                $rating = $conn->real_escape_string($_POST['rating']);
                $review = $conn->real_escape_string($_POST['review']);

                // Query untuk memasukkan data ke database
                $sql = "INSERT INTO reviews (email, judul, rating, review) VALUES ('$email', '$judul', '$rating', '$review')";

                // Cek apakah query berhasil dieksekusi
                if ($conn->query($sql) === TRUE) {
                    echo "<p class='text-white'>Review added successfully!</p>";
                } else {
                    echo "<p class='text-white'>Error: " . $conn->error . "</p>";
                }
            }
            ?>
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
    <script src="main.js"></script>
</body>
</html>