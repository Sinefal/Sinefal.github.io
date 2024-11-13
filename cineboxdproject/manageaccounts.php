<?php
include 'koneksi.php';
session_start();

// Hanya admin yang bisa akses halaman ini
if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

// Ambil query pencarian jika ada
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Proses penghapusan akun
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $user_id = $_POST['delete_user_id'];

    // Hapus akun dari tabel users
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    header('Location: manageaccounts.php');
    exit;
}

// Query untuk mendapatkan data akun pengguna
$sql = "SELECT users.user_id, users.username, users.created_at, COUNT(reviews.review_id) AS review_count
        FROM users
        LEFT JOIN reviews ON users.user_id = reviews.user_id";
if ($searchQuery) {
    $sql .= " WHERE users.username LIKE '%$searchQuery%'";
}
$sql .= " GROUP BY users.user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Accounts - Cineboxd</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="container mx-auto relative">
    <div class="background row absolute">
        <img class="absolute" src="assets/manageaccountsbg.jpg" alt="">
    </div>
    <header class="row relative justify-content-between">
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <!-- Search bar untuk mencari username akun -->
        <div class="search-form d-flex justify-content-between align-items-center">
            <form action="manageaccounts.php" method="GET" class="search-form d-flex justify-content-between align-items-center">
                <input type="text" name="search" placeholder="Search username..." class="search-input text-white" value="<?= htmlspecialchars($searchQuery); ?>">
                <button type="submit" class="icon-button">
                    <img src="assets/magnifier-icon.png" alt="Search">
                </button>
            </form>
        </div>

        <!-- Tabel akun pengguna -->
        <table class="text-white">
            <tr>
                <th>Username</th>
                <th>Account Created</th>
                <th>Review Count</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($user = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['created_at']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['review_count']) . "</td>";
                    echo "<td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='delete_user_id' value='" . $user['user_id'] . "'>
                                <button type='submit' class='icon-button' onclick='return confirm(\"Are you sure you want to delete this account?\");'>
                                    <img src='assets/delete-icon.png' alt='Delete' class='small-icon'>
                                </button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No accounts found.</td></tr>";
            }
            ?>
        </table>
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
<script src="scripts.js" defer></script>
</body>
</html>
