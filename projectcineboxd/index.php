<?php
include 'koneksi.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="./style2.css" />
    <title>Cineboxd</title>
</head>
<body>
    <div class="container mx-auto relative">
        <div class="background row absolute">
            <img class="absolute" src="./assets/landingbg.jpg" alt="Backdrop"/>
        </div>
        <header class="row relative justify-content-between">
            <?php include 'navbar.php'; ?>
        </header>
        <main>
            <section class="intro row">
                <article class="col-12 d-flex-col">
                    <h1 class="h1 text-white mx-auto col-12">
                        Track films you’ve watched. <br />
                        Save those you want to see. <br />
                        Tell your friends what’s good.
                    </h1>
                    <p class="d-flex-row sm-d-none mx-auto col-8 lg-col-12 justify-content-center">
                    The social network for film lovers. Also available on
                    <i class="apple-logo"></i><i class="android-logo"></i></p>
                </article>
            </section>
            <section class="popular-films row">
                <h2 class="col-12 text-center text-white">POPULAR THIS WEEK</h2>
                <?php
                $stmt = $conn->prepare("SELECT * FROM films WHERE is_popular = 1 LIMIT 6");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($film = $result->fetch_assoc()): ?>
                    <div class="col-2 relative sm-col-4 sm-d-flex-row sm-justify-content-center">
                        <a href="filmdetail.php?film_id=<?= $film['film_id']; ?>" class="col-12 sm-d-flex-row sm-justify-content-center">
                            <img src="uploads/poster/<?= htmlspecialchars($film['poster']); ?>" alt="<?= htmlspecialchars($film['title']); ?>">
                        </a>
                    </div>
                <?php endwhile; ?>
            </section>
            <section class="letterboxd-lets-you row d-flex-row flex-nowrap">
                <h3 class="col-12 small font-normal">CINEBOXD LETS YOU...</h3>
                <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                    <div class="wrapper blue d-flex-row align-items-start no-p">
                        <div class="watch col-2"></div>
                        <p class="col-4 text-white col-10">
                            Keep track of every film you've ever watched (or just start from the day you join)
                        </p>
                    </div>
                </article>
                <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                    <div class="wrapper green d-flex-row align-items-start no-p">
                        <div class="like col-2"></div>
                        <p class="col-4 text-white col-10">
                            Show some love for your favorite films, lists and reviews with a "like"
                        </p>
                    </div>
                </article>
                <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                    <div class="wrapper orange d-flex-row align-items-start no-p">
                        <div class="bars col-2"></div>
                        <p class="col-4 text-white col-10">
                            Write and share reviews, and follow friends and other members to read theirs
                        </p>
                    </div>
                </article>
                <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                    <div class="wrapper blue d-flex-row align-items-start no-p">
                        <div class="star col-2"></div>
                        <p class="col-4 text-white col-10">
                            Rate each film on a five-star scale (with halves) to record and share your reaction
                        </p>
                    </div>
                </article>
                <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                    <div class="wrapper green d-flex-row align-items-start no-p">
                        <div class="case col-2"></div>
                        <p class="col-4 text-white col-10">
                            Keep a diary of your film watching (and upgrade to <span class="font-bold">Pro</span> for comprehensive stats)
                        </p>
                    </div>
                </article>
                <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                    <div class="wrapper orange d-flex-row align-items-start no-p">
                        <div class="squares col-2"></div>
                        <p class="col-4 text-white col-10">
                            Compile and share lists of films on any topic and keep a watchlist of films to see
                        </p>
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
    </div>
    <script src="scripts.js"></script>
</body>
</html>
