<?php
include 'koneksidb.php'; 
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
                        <a class="nav-list-link text-white small" href="#sign-in">SIGN IN</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="#create-account">CREATE ACCOUNT</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="review.php">REVIEW</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="displayreview.php">VIEW REVIEWS</a>
                    </li>
                    <li class="nav-list-item">
                        <a class="nav-list-link text-white small" href="index.php">ABOUT</a>
                    </li>
                    <li class="nav-list-item col-2 relative">
                        <input type="search" />
                        <img class="absolute" src="./assets/magnifierIcon.png" alt=""/>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <h2 class="h2 text-white">All Reviews</h2>
            <br>
            <table class="text-white">
                <tr>
                    <th class='text-white'>Email</th>
                    <th class='text-white'>Judul Film</th>
                    <th class='text-white'>Rating</th>
                    <th class='text-white'>Review</th>
                    <th class='text-white'>Poster</th>
                    <th class='text-white'>Actions</th>
                </tr>
                <?php
                $sql = "SELECT id, email, judul, rating, review, poster FROM reviews";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='text-white'>" . htmlspecialchars($row['email']) . "</td>"; 
                        echo "<td class='text-white'>" . htmlspecialchars($row['judul']) . "</td>"; 
                        echo "<td class='text-white'>" . htmlspecialchars($row['rating']) . "/5</td>"; 
                        echo "<td class='text-white'>" . htmlspecialchars($row['review']) . "</td>"; 
                        if (!empty($row['poster'])) {
                            echo "<td class='text-white'><img src='uploads/" . htmlspecialchars($row['poster']) . "' alt='Poster' style='width: 100px;'></td>";
                        } else {
                            echo "<td class='text-white'>No Poster</td>";
                        }
                        
                        echo "<td>
                                <a href='updatereview.php?id=" . $row['id'] . "' class='text-secondary'>Edit</a> | 
                                <a href='deletereview.php?id=" . $row['id'] . "' class='text-secondary' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-white'>No reviews found.</td></tr>"; 
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
