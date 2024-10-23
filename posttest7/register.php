<?php
include 'koneksidb.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    if (strlen($username) > 50) {
        echo "<script>alert('Username maksimal 50 karakter!'); window.location.href='register.php';</script>";
        exit();
    }

    $checkUsername = $conn->query("SELECT id FROM users WHERE username = '$username'");
    if ($checkUsername->num_rows > 0) {
        echo "<script>alert('Username sudah dipakai! Silakan pilih username lain.'); window.location.href='register.php';</script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "'); window.location.href='register.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cineboxd - Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container mx-auto relative">
        <div class="background row absolute">
            <img class="absolute" src="./assets/jokerback.jpg" alt=""/>
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
                    <h1 class="h1 text-white mx-auto">Create an Account</h1>
                    <form action="register.php" method="POST" class="review-form mx-auto col-6 d-flex-col">
                        <label for="username" class="text-white">Username:</label>
                        <input type="text" id="username" name="username" maxlength="50" required>
                        
                        <label for="password" class="text-white">Password:</label>
                        <input type="password" id="password" name="password" required>
                        
                        <button type="submit" class="submit-btn">Register</button>
                    </form>
                </article>
            </section>
        </main>
    </div>
</body>
</html>
