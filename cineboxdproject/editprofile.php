<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit;
}

$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'];
    $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE user_id = ?");
    $stmt->bind_param("ssi", $newUsername, $newPassword, $userId);
    
    if ($stmt->execute()) {
        $_SESSION['username'] = $newUsername;
        echo "<script>alert('Profile updated successfully!'); </script>";
    } else {
        echo "<script>alert('Failed to update profile!'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container mx-auto relative">
        <div class="background row absolute">
            <img class="absolute" src="./assets/editprofilebg.jpg" alt=""/>
        </div>
        <header class="row relative justify-content-between">
            <?php include 'navbar.php'; ?>
        </header>
        <main>
            <section class="intro row">
                <article class="col-12 d-flex-col">
                    <h1 class="h1 text-white mx-auto">Edit Your Profile</h1>
                    <?php if (isset($success)) { echo "<p class='text-green'>$success</p>"; } ?>
                    <?php if (isset($error)) { echo "<p class='text-red'>$error</p>"; } ?>
                    <form action="editprofile.php" method="POST" class="review-form mx-auto col-6 d-flex-col">
                        <label for="username" class="text-white">New Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                        
                        <label for="password" class="text-white">New Password:</label>
                        <input type="password" id="password" name="password" required>
                        
                        <button type="submit" class="submit-btn-sign">SAVE</button>
                    </form>
                </article>
            </section>
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
                    <li><a href="https://x.com/SineFal"><img src="./assets/twitterIcon.png" alt="Twitter" /></a></li>
                    <li>/</li>
                    <li><a href="https://www.facebook.com/MyNameIsNopal"><img src="./assets/facebookIcon.png" alt="Facebook" /></a></li>
                    <li>/</li>
                    <li><a href="https://www.instagram.com/naufalfahrozi/"><img src="./assets/instagramIcon.png" alt="Instagram" /></a></li>
                </ul>
            </div>
            <p class="col-12"> &copy; Cineboxd Limited. Made by Kelompok 6 B1 2023</p>
        </footer>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
