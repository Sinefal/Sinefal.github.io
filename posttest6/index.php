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
                <img class="absolute" src="./assets/First-Cow-backdrop.jpg" alt=""/>
            </div>
            <header class="row relative justify-content-between">
                <img class="col-3 lg-col-4 md-col-5 xsm-col-6" src="./assets/CineboxdLogo.png" alt="" />
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
                            <a class="nav-list-link text-white small" href="#about">ABOUT</a>
                        </li>
                        <li class="nav-list-item col-2 relative">
                            <input type="search" />
                            <img class="absolute" src="./assets/magnifierIcon.png" alt=""/>
                        </li>
                    </ul>
                </nav>

                <ul class="burger-menu col-6 d-none lg-d-flex-row justify-content-end no-list-style">
                    <li class="col-6 sm-col-7 xsm-col-8 relative d-flex-row align-items-center">
                        <input type="search" /><img class="absolute" src="./assets/magnifierIcon.png" alt=""/>
                    </li>
                    <li class="col-2 sm-col-3 d-flex-row align-items-center">
                        <img src="./assets/menuIcon.png" alt="" />
                    </li>
                </ul>
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
                    <div class="col-2 relative sm-col-4 sm-d-flex-row sm-justify-content-center">
                        <a href="#" class="col-12 sm-d-flex-row sm-justify-content-center sm-mb-">
                            <img src="./assets/Dunkirk.jpg" alt="" />
                        </a>
                        <ul class="no-list-style absolute d-flex-col align-items-center lg-d-none">
                            <li class="watched"></li>
                            <li>180K</li>
                            <li class="liked"></li>
                            <li>97K</li>
                        </ul>
                    </div>
                    <div class="col-2 relative sm-col-4 sm-d-flex-row sm-justify-content-center">
                        <a href="#" class="col-12 sm-d-flex-row sm-justify-content-center sm-mb-">
                            <img src="./assets/Lawrence-of-Arabia.jpg" alt="" />
                        </a>
                        <ul class="no-list-style absolute d-flex-col align-items-center lg-d-none">
                            <li class="watched"></li>
                            <li>80K</li>
                            <li class="liked"></li>
                            <li>46K</li>
                        </ul>
                    </div>
                    <div class="col-2 relative sm-col-4 sm-d-flex-row sm-justify-content-center">
                        <a href="#" class="col-12 sm-d-flex-row sm-justify-content-center sm-mb-">
                            <img src="./assets/The-Seventh-Seal.jpg" alt="" /></a>
                        <ul class="no-list-style absolute d-flex-col align-items-center lg-d-none">
                            <li class="watched"></li>
                            <li>53K</li>
                            <li class="liked"></li>
                            <li>18K</li>
                        </ul>
                    </div>
                    <div class="col-2 relative sm-col-4 sm-d-flex-row sm-justify-content-center">
                        <a href="#" class="col-12 sm-d-flex-row sm-justify-content-center sm-mb-">
                            <img src="./assets/Dune-Part-One.jpg" alt=""/></a>
                        <ul class="no-list-style absolute d-flex-col align-items-center lg-d-none">
                            <li class="watched"></li>
                            <li>120K</li>
                            <li class="liked"></li>
                            <li>38K</li>
                        </ul>
                    </div>
                    <div class="col-2 relative sm-col-4 sm-d-flex-row sm-justify-content-center">
                        <a href="#" class="col-12 sm-d-flex-row sm-justify-content-center sm-mb-">
                            <img src="./assets/Empire-Strikes-Back.jpg" alt=""/></a>
                        <ul class="no-list-style absolute d-flex-col align-items-center lg-d-none">
                            <li class="watched"></li>
                            <li>133K</li>
                            <li class="liked"></li>
                            <li>42K</li>
                        </ul>
                    </div>
                    <div class="col-2 relative sm-col-4 sm-d-flex-row sm-justify-content-center">
                        <a href="#" class="col-12 sm-d-flex-row sm-justify-content-center">
                            <img src="./assets/Portrait-of-a-Lady-on-Fire.jpg" alt=""/> </a>
                        <ul class="no-list-style absolute d-flex-col align-items-center lg-d-none">
                            <li class="watched"></li>
                            <li>72K</li>
                            <li class="liked"></li>
                            <li>26K</li>
                        </ul>
                    </div>
                </section>
                <section class="letterboxd-lets-you row d-flex-row flex-nowrap">
                    <h3 class="col-12 small font-normal">LETTERBOXD LETS YOU...</h3>
                    <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                        <div class="wrapper blue d-flex-row align-items-start 12 no-p">
                            <div class="watch col-2"></div>
                            <p class="col-4 text-white col-10">
                                Keep track of every film you've ever watched (or just start from the
                                day you join)
                            </p>
                        </div>
                    </article>
                    <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                        <div class="wrapper green d-flex-row align-items-start 12 no-p">
                            <div class="like col-2"></div>
                            <p class="col-4 text-white col-10">
                                Show some love for your favorite films, lists and reviews with a
                                "like"
                            </p>
                        </div>
                    </article>
                    <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                        <div class="wrapper orange d-flex-row align-items-start 12 no-p">
                            <div class="bars col-2"></div>
                            <p class="col-4 text-white col-10">
                                Write and share reviews, and follow friends and other members to
                                read theirs
                            </p>
                        </div>
                    </article>
                    <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                        <div class="wrapper blue d-flex-row align-items-start 12 no-p">
                            <div class="star col-2"></div>
                            <p class="col-4 text-white col-10">
                                Rate each film on a five-star scale (with halves) to record and
                                share your reaction
                            </p>
                        </div>
                    </article>
                    <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                        <div class="wrapper green d-flex-row align-items-start 12 no-p">
                            <div class="case col-2"></div>
                            <p class="col-4 text-white col-10">
                                Keep a diary of your film watching (and upgrade to
                                <span class="font-bold">Pro</span> for comprehensive stats
                            </p>
                        </div>
                    </article>
                    <article class="d-flex-row col-4 sm-col-6 xsm-col-12">
                        <div class="wrapper orange d-flex-row align-items-start 12 no-p">
                            <div class="squares col-2"></div>
                            <p class="col-4 text-white col-10">
                                Compile and share lists of films on any topic and keep a watchlist
                                of films to see
                            </p>
                        </div>
                    </article>
                </section>
                <section id="about" class="about-section">
                    <h2 class="col-12 text-center">About Me</h2>
                    <p class="col-12 text-center">
                    My name is Muhammad Naufal Fahrozi, an informatics student who is very passionate about cinema. This project is a simplified version of Letterboxd, aimed at reviewing and sharing movie experiences. Through this project, I hope to connect with my fellow cinephiles.
                    </p>
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


<!-- Muhammad Naufal Fahrozi
2309106062 -->