<?php
include 'koneksi.php'; 
session_start();

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$filterGenre = isset($_GET['genre']) ? $_GET['genre'] : '';
$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'year_desc';

$sql = "SELECT * FROM films WHERE title LIKE ?";
$params = ["%$searchQuery%"];
$types = "s";

if ($filterGenre) {
    $sql .= " AND genre = ?";
    $params[] = $filterGenre;
    $types .= "s";
}

switch ($sortOrder) {
    case 'alpha_asc':
        $sql .= " ORDER BY title ASC";
        break;
    case 'alpha_desc':
        $sql .= " ORDER BY title DESC";
        break;
    case 'year_asc':
        $sql .= " ORDER BY year ASC";
        break;
    default:
        $sql .= " ORDER BY year DESC";
        break;
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();

$result = $stmt->get_result();
$films = $result->fetch_all(MYSQLI_ASSOC);

$genreResult = $conn->query("SELECT DISTINCT genre FROM films WHERE genre IS NOT NULL");
$genres = $genreResult->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineboxd - Katalog Film</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="films.css">
</head>
<body>
    <div class="container mx-auto relative">
        <div class="background row absolute">
            <img class="absolute" src="./assets/filmsbg.jpg" alt=""/>
        </div>

        <header class="row relative justify-content-between">
            <?php include 'navbar.php'; ?>
        </header>

        <main>
            <section class="intro row">
                <article class="col-12 d-flex-col">
                    <div class="search-filter-sort d-flex justify-content-between align-items-center">
                        <div class="search-form">
                            <input type="text" name="search" placeholder="Search film title..." class="search-input text-white" value="<?php echo htmlspecialchars($searchQuery); ?>">
                            <button type="button" onclick="applyFilterSort()" class="icon-button">
                                <img src="assets/magnifier-icon.png" alt="Search">
                            </button>
                        </div>
                        
                        <div class="filter">
                            <label for="genre">Genre:</label>
                            <select id="genre" name="genre" onchange="applyFilterSort()">
                                <option value="">All</option>
                                <?php foreach ($genres as $genre): ?>
                                    <option value="<?php echo htmlspecialchars($genre['genre']); ?>" <?php echo ($filterGenre == $genre['genre']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($genre['genre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="sort">
                            <label for="sort">Sort by:</label>
                            <select id="sort" name="sort" onchange="applyFilterSort()">
                                <option value="year_desc" <?php echo ($sortOrder == 'year_desc') ? 'selected' : ''; ?>>Release Year (Newest)</option>
                                <option value="year_asc" <?php echo ($sortOrder == 'year_asc') ? 'selected' : ''; ?>>Release Year (Earliest)</option>
                                <option value="alpha_asc" <?php echo ($sortOrder == 'alpha_asc') ? 'selected' : ''; ?>>Alphabetical (A-Z)</option>
                                <option value="alpha_desc" <?php echo ($sortOrder == 'alpha_desc') ? 'selected' : ''; ?>>Alphabetical (Z-A)</option>
                            </select>
                        </div>
                    </div>

                    <?php if (isset($error_message)): ?>
                        <p class="error-message"><?php echo $error_message; ?></p>
                    <?php endif; ?>

                    <div class="row film-grid">
                        <?php foreach ($films as $film): ?>
                            <div class="col-3 film-item">
                                <div class="film-card">
                                    <a href="filmdetail.php?film_id=<?php echo $film['film_id']; ?>">
                                        <img src="uploads/poster/<?php echo ($film['poster']); ?>" alt="<?php echo htmlspecialchars($film['title']); ?>" class="film-image">
                                        <div class="film-overlay">
                                            <p><?php echo htmlspecialchars($film['title']); ?> (<?php echo htmlspecialchars($film['year']); ?>)</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
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
        <script>
            function applyFilterSort() {
                const genre = document.getElementById('genre').value;
                const sort = document.getElementById('sort').value;
                const search = document.querySelector('.search-input').value;
                window.location.href = `films.php?search=${search}&genre=${genre}&sort=${sort}`;
            }
        </script>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
