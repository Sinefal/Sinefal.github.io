<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Account Created Successfully!'); window.location.href='signin.php';</script>";
    } else {
        echo "<script>alert('Username has been used');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cineboxd - Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container mx-auto relative">
        <div class="background row absolute">
            <img class="absolute" src="./assets/signupbg.jpg" alt=""/>
        </div>
        <header class="row relative justify-content-between">
            <?php include 'navbar.php'; ?>
        </header>
        <main>
            <section class="intro row">
                <article class="col-12 d-flex-col">
                    <h1 class="h1 text-white mx-auto">Create Your Account</h1>
                    <?php if (isset($error)) { echo "<p class='text-red'>$error</p>"; } ?>
                    <form action="signup.php" method="POST" class="review-form mx-auto col-6 d-flex-col">
                        <label for="username" class="text-white">Username:</label>
                        <input type="text" id="username" name="username" required>
                        
                        <label for="password" class="text-white">Password:</label>
                        <input type="password" id="password" name="password" required>
                        
                        <button type="submit" class="submit-btn-sign">SIGN UP</button>
                    </form>
                </article>
            </section>
        </main>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
