<?php
include 'koneksidb.php'; 

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Login berhasil!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cineboxd - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container mx-auto relative">
        <div class="background row absolute">
            <img class="absolute" src="./assets/thesocialnetworkback.jpg" alt=""/>
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
                    <h1 class="h1 text-white mx-auto">Sign-in to Your Account</h1>
                    <form action="login.php" method="POST" class="review-form mx-auto col-6 d-flex-col">
                        <label for="username" class="text-white">Username:</label>
                        <input type="text" id="username" name="username" required>
                        
                        <label for="password" class="text-white">Password:</label>
                        <input type="password" id="password" name="password" required>
                        
                        <button type="submit" class="submit-btn">Login</button>
                    </form>
                </article>
            </section>
        </main>
    </div>
</body>
</html>
