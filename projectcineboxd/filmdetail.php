<?php
include 'koneksi.php';
session_start();

$film_id = isset($_GET['film_id']) ? (int)$_GET['film_id'] : 0;
$user_id = $_SESSION['user_id'] ?? null; 
$is_admin = ($_SESSION['role'] ?? '') === 'admin';

$stmt = $conn->prepare("SELECT * FROM films WHERE film_id = ?");
$stmt->bind_param("i", $film_id);
$stmt->execute();
$film = $stmt->get_result()->fetch_assoc();

if (!$film) {
    echo "Film tidak ditemukan.";
    exit;
}

$reviews = null;
$review_stmt = $conn->prepare("SELECT reviews.review_id, users.user_id, users.username, reviews.rating, reviews.review, reviews.created_at 
                               FROM reviews 
                               JOIN users ON reviews.user_id = users.user_id 
                               WHERE reviews.film_id = ?");
if ($review_stmt) {
    $review_stmt->bind_param("i", $film_id);
    $review_stmt->execute();
    $reviews = $review_stmt->get_result();
} else {
    echo "Error preparing statement for reviews: " . $conn->error;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_id'])) {
    $review_id = $_POST['review_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    if ($rating < 1 || $rating > 5 || empty($review)) {
        echo "Rating atau review tidak valid.";
        exit;
    }

    if ($review_id) {
        $stmt = $conn->prepare("UPDATE reviews SET rating = ?, review = ? WHERE review_id = ? AND user_id = ?");
        if ($stmt) {
            $stmt->bind_param("isii", $rating, $review, $review_id, $user_id);
            $stmt->execute();
            header("Location: filmdetail.php?film_id=" . $film_id);
            exit;
        } else {
            echo "Error preparing statement for update: " . $conn->error;
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO reviews (film_id, user_id, rating, review, created_at) VALUES (?, ?, ?, ?, NOW())");
        if ($stmt) {
            $stmt->bind_param("iiis", $film_id, $user_id, $rating, $review);
            $stmt->execute();
            header("Location: filmdetail.php?film_id=" . $film_id);
            exit;
        } else {
            echo "Error preparing statement for insert: " . $conn->error;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_review_id'])) {
    $review_id = $_POST['delete_review_id'];
    $stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ? AND (user_id = ? OR ? = 'admin')");
    if ($stmt) {
        $stmt->bind_param("iis", $review_id, $_SESSION['user_id'], $_SESSION['role']);
        $stmt->execute();
        header("Location: filmdetail.php?film_id=" . $film_id);
        exit;
    } else {
        echo "Error preparing statement for delete: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style2.css" />
    <link rel="stylesheet" href="filmdetail.css" /> 
    <script src="scripts.js" defer></script>
    <title><?= htmlspecialchars($film['title']); ?> - Cineboxd</title>
</head>
<body>
    <div class="container mx-auto relative">
        <div class="background row absolute">
            <img class="absolute" src="uploads/backdrop/<?= htmlspecialchars($film['backdrop']); ?>" alt="Backdrop" />
        </div>

        <header class="row relative justify-content-between">
            <?php include 'navbar.php'; ?>
        </header>

        <main class="row film-detail-section relative">
            <?php if ($film): ?>
                <div class="col-3 sm-col-4">
                    <img src="uploads/poster/<?= htmlspecialchars($film['poster']); ?>" alt="<?= htmlspecialchars($film['title']); ?> Poster" class="film-poster" />
                    <div class="rating text-white">
                        <p class="text-white">RATING</p>
                        <?php
                        $rating_stmt = $conn->prepare("SELECT AVG(rating) AS average_rating FROM reviews WHERE film_id = ?");
                        $rating_stmt->bind_param("i", $film_id);
                        $rating_stmt->execute();
                        $rating_result = $rating_stmt->get_result()->fetch_assoc();
                        $average_rating = $rating_result['average_rating'] ? number_format($rating_result['average_rating'], 1) : "N/A";
                        ?>
                        <p class="text-white"><?= $average_rating; ?> / 5</p>
                    </div>
                </div>  
                <div class="col-9 sm-col-8 film-detail-info text-white">
                    <div class="d-flex-row">
                        <h2><?= htmlspecialchars($film['title']); ?>&nbsp</h2>
                        <p class="year text-white"><?= htmlspecialchars($film['year']); ?>&nbsp</p>
                        <p class="sinopsis">Directed by&nbsp</p>
                        <p class="text-white"> <?= htmlspecialchars($film['director']); ?>&nbsp</p>
                    </div>
                    <p class="text-white"><?= htmlspecialchars($film['genre']); ?></p>
                    <p class="sinopsis film-description"><?= htmlspecialchars($film['synopsis']); ?></p>
                    <?php if ($is_admin || $user_id): ?>
                    <button class="review-button" onclick="showReviewForm()">MAKE A REVIEW</button> 
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p class="text-white">Film not found.</p>
            <?php endif; ?>
        </main>

        <section class="row reviews-section">
            <h3 class="col-12 text-white">REVIEWS</h3>
            <hr class="review-divider col-12"/>
            <?php if (isset($reviews) && $reviews->num_rows > 0): ?>
                <?php while ($review = $reviews->fetch_assoc()): ?>
                    <div class="review-item col-12 d-flex-row align-items-start">
                        <div class="review-text col-10">
                            <p>
                                <strong class="text-white">Review by</strong> <?= htmlspecialchars($review['username']); ?> 
                                &nbsp;|&nbsp; <?= htmlspecialchars($review['rating']); ?> out of 5 
                                &nbsp;|&nbsp; <?= htmlspecialchars($review['created_at']); ?> 
                            </p>
                            <p class= "sinopsis"><?= htmlspecialchars($review['review']); ?></p>
                        </div>
                        <?php if ($is_admin || $user_id == $review['user_id']): ?>
                            <div class="review-actions">
                            <button class="icon-button" onclick="editReview(<?= $review['review_id']; ?>, <?= $review['rating']; ?>, '<?= htmlspecialchars($review['review'], ENT_QUOTES); ?>')">
                                <img src="assets/edit-icon.png" alt="Edit" class="small-icon">
                            </button>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="delete_review_id" value="<?= $review['review_id']; ?>">
                                    <button type="submit" class="icon-button">
                                        <img src="assets/delete-icon.png" alt="Delete" class="small-icon">
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-white">No reviews yet.</p>
            <?php endif; ?>
        </section>

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
            <p class="col-12">&copy; Cineboxd Limited. Made by Koa Team</p>
        </footer>

        <div id="reviewFormOverlay" class="overlay" style="display: none;">
            <form id="reviewForm" class="overlay-content" method="POST">
                <span class="close-btn" onclick="closeReviewForm()">×</span>
                <h2 id="reviewFormTitle">Add a Review</h2>
                <input type="hidden" name="film_id" value="<?= $film_id; ?>">
                <input type="hidden" name="review_id" id="reviewId">
                <label for="rating">Rating</label>
                <input type="number" id="rating" name="rating" min="1" max="5" placeholder="Rate out of 5" required>
                <label for="review">Review</label>
                <textarea id="review" name="review" placeholder="Add a review..." required></textarea>
                <button type="submit" class="submit-btn">SAVE</button>
            </form>
        </div>
    </div>
    <script src="scripts.js" defer></script>
</body>
</html>
