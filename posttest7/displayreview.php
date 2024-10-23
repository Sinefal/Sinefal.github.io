<?php
include 'koneksidb.php';
session_start(); 

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in to view reviews.'); window.location.href='login.php';</script>";
    exit();
}

$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $conn->real_escape_string($_GET['search']);
}
?>

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
            <img class="absolute" src="./assets/bat.jpg" alt=""/>
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
            <h2 class="h2 text-white">All Reviews</h2>
            <br>

            <form action="displayreview.php" method="GET" class="d-flex justify-content-center mb-4">
                <input type="text" name="search" placeholder="Search Movie Titles..." class="search-input text-white" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit" class="submit-btn">Search</button>
            </form>
            <table class="text-white">
                <tr>
                    <th class='text-white'>Username</th>
                    <th class='text-white'>Judul Film</th>
                    <th class='text-white'>Rating</th>
                    <th class='text-white'>Review</th>
                    <th class='text-white'>Poster</th>
                    <th class='text-white'>Actions</th>
                </tr>
                <?php

                $sql = "SELECT * FROM reviews";
                if (!empty($searchQuery)) {
                    $sql .= " WHERE judul LIKE '%$searchQuery%'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='text-white'>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td class='text-white'>" . htmlspecialchars($row['judul']) . "</td>";
                        echo "<td class='text-white'>" . htmlspecialchars($row['rating']) . "/5</td>";
                        echo "<td class='text-white'>" . htmlspecialchars($row['review']) . "</td>";

                        echo "<td class='text-white'>";
                        if ($row['poster']) {
                            echo "<img src='uploads/" . htmlspecialchars($row['poster']) . "' alt='Poster' style='width: 100px;'>";
                        } else {
                            echo "No Poster";
                        }
                        echo "</td>";

                        if ($_SESSION['username'] === $row['username']) {
                            echo "<td>
                                    <a href='updatereview.php?id=" . $row['id'] . "' class='text-secondary'>Edit</a> | 
                                    <a href='deletereview.php?id=" . $row['id'] . "' class='text-secondary' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                                  </td>";
                        } else {
                            echo "<td class='text-white'>-</td>";
                        }
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-white'>No reviews found.</td></tr>";
                }
                ?>
            </table>
        </main>
    </div>
</body>
</html>
