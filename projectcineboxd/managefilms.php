<?php
include 'koneksi.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filmId = $_POST['film_id'] ?? null;
    $title = $_POST['title'];
    $year = $_POST['year'];
    $director = $_POST['director'];
    $genre = $_POST['genre'];
    $synopsis = $_POST['synopsis'];
    
    $backdrop = null;
    if (!empty($_FILES['backdrop']['name'])) {
        $backdrop = 'backdrop_' . time() . '_' . $_FILES['backdrop']['name'];
        move_uploaded_file($_FILES['backdrop']['tmp_name'], "uploads/backdrop/$backdrop");
    }

    $poster = null;
    if (!empty($_FILES['poster']['name'])) {
        $poster = 'poster_' . time() . '_' . $_FILES['poster']['name'];
        move_uploaded_file($_FILES['poster']['tmp_name'], "uploads/poster/$poster");
    }

    if ($filmId) {
        $sql = "UPDATE films SET title = ?, year = ?, director = ?, genre = ?, synopsis = ?";
        $params = [$title, $year, $director, $genre, $synopsis];
        
        if ($backdrop) {
            $sql .= ", backdrop = ?";
            $params[] = $backdrop;
        }
        
        if ($poster) {
            $sql .= ", poster = ?";
            $params[] = $poster;
        }
        
        $sql .= " WHERE film_id = ?";
        $params[] = $filmId;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat('s', count($params) - 1) . 'i', ...$params);
    } else {
        $sql = "INSERT INTO films (title, year, director, genre, synopsis, backdrop, poster) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $title, $year, $director, $genre, $synopsis, $backdrop, $poster);
    }

    $stmt->execute();
    header('Location: managefilms.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['film_id'])) {
    $filmId = $_GET['film_id'];
    $stmt = $conn->prepare("DELETE FROM films WHERE film_id = ?");
    $stmt->bind_param("i", $filmId);
    $stmt->execute();
    header('Location: managefilms.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'toggle_popular' && isset($_GET['film_id'])) {
    $filmId = $_GET['film_id'];
    $stmt = $conn->prepare("SELECT is_popular FROM films WHERE film_id = ?");
    $stmt->bind_param("i", $filmId);
    $stmt->execute();
    $result = $stmt->get_result();
    $film = $result->fetch_assoc();

    $isPopular = $film['is_popular'] ? 0 : 1;

    if ($isPopular) {
        $stmt = $conn->prepare("SELECT COUNT(*) as popular_count FROM films WHERE is_popular = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $countData = $result->fetch_assoc();
        
        if ($countData['popular_count'] >= 6) {
            echo "<script>alert('Maximum of 6 films can be marked as popular.');</script>";
        } else {
            $stmt = $conn->prepare("UPDATE films SET is_popular = ? WHERE film_id = ?");
            $stmt->bind_param("ii", $isPopular, $filmId);
            $stmt->execute();
        }
    } else {
        $stmt = $conn->prepare("UPDATE films SET is_popular = ? WHERE film_id = ?");
        $stmt->bind_param("ii", $isPopular, $filmId);
        $stmt->execute();
    }
    header('Location: managefilms.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Films - Cineboxd</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="container mx-auto relative">
    <div class="background row absolute">
        <img class="absolute" src="assets/managefilmsbg.jpg" alt="">
    </div>
    <header class="row relative justify-content-between">
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <div class="search-form d-flex justify-content-between align-items-center">
            <form action="managefilms.php" method="GET" class="search-form d-flex justify-content-between align-items-center">
                <input type="text" name="search" placeholder="Search film title..." class="search-input text-white" value="<?= htmlspecialchars($searchQuery); ?>">
                <button type="submit" class="icon-button">
                    <img src="assets/magnifier-icon.png" alt="Search">
                </button>
                <button type="button" onclick="showAddFilmForm()" class="submit-btn green">ADD FILM</button>
            </form>
        </div>

        <table class="text-white">
            <tr>
                <th>Title</th>
                <th>Year</th>
                <th>Director</th>
                <th>Genre</th>
                <th>Synopsis</th>
                <th>Backdrop</th>
                <th>Poster</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM films";
            if ($searchQuery) {
                $sql .= " WHERE title LIKE '%$searchQuery%'";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($film = $result->fetch_assoc()) {
                    $popularIcon = $film['is_popular'] ? 'assets/star-icon-active.png' : 'assets/star-icon.png';
                    $toggleMessage = $film['is_popular'] ? 'Remove from Popular' : 'Add to Popular';
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($film['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($film['year']) . "</td>";
                    echo "<td>" . htmlspecialchars($film['director']) . "</td>";
                    echo "<td>" . htmlspecialchars($film['genre']) . "</td>";
                    echo "<td>" . htmlspecialchars($film['synopsis']) . "</td>";
                    echo "<td><img src='uploads/backdrop/" . htmlspecialchars($film['backdrop']) . "' alt='Backdrop' width='80'></td>";
                    echo "<td><img src='uploads/poster/" . htmlspecialchars($film['poster']) . "' alt='Poster' width='80'></td>";
                    echo "<td>
                            <button onclick='showEditFilmForm(" . $film['film_id'] . ")' class='icon-button'><img src='assets/edit-icon.png' alt='Edit'></button>
                            <button onclick='deleteFilm(" . $film['film_id'] . ")' class='icon-button'><img src='assets/delete-icon.png' alt='Delete'></button>
                            <button onclick='togglePopular(" . $film['film_id'] . ")' class='icon-button' title='$toggleMessage'><img src='$popularIcon' alt='Popular'></button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No films found.</td></tr>";
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

    <div id="filmFormOverlay" class="overlay" style="display: none;">
        <form id="filmForm" class="overlay-content" method="POST" action="managefilms.php" enctype="multipart/form-data">
            <span class="close-btn" onclick="closeFilmForm()">×</span>
            <input type="hidden" name="film_id" id="filmId">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
            <label for="year">Year</label>
            <input type="number" id="year" name="year" required>
            <label for="director">Director</label>
            <input type="text" id="director" name="director">
            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre">
            <label for="synopsis">Synopsis</label>
            <textarea id="synopsis" name="synopsis"></textarea>
            <label for="backdrop">Backdrop</label>
            <input type="file" id="backdrop" name="backdrop">
            <label for="poster">Poster</label>
            <input type="file" id="poster" name="poster">
            <button type="submit" class="submit-btn">SAVE</button>
        </form>
    </div>
    <script src="scripts.js" defer></script>
</body>
</html>
