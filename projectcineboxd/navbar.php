<img class="col-3 lg-col-4 md-col-5 xsm-col-6" src="./assets/CineboxdLogo.png" alt="Logo" />

<button class="hamburger-icon" onclick="toggleMenu()">
    <img src="./assets/hamburger-icon.png" alt="Menu" />
</button>

<nav class="col-9 d-flex-row align-items-center lg-d-none">
    <ul class="col-12 justify-content-end nav-list lg-d-flex-row md-d-none" id="desktop-menu">
        <?php if (!isset($_SESSION['role'])): ?>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="index.php">HOME</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="films.php">FILMS</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="signin.php">SIGN IN</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="signup.php">CREATE ACCOUNT</a>
            </li>
        <?php elseif ($_SESSION['role'] === 'user'): ?>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="index.php">HOME</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="editprofile.php">PROFILE</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="films.php">FILMS</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="signout.php">SIGN OUT</a>
            </li>
        <?php elseif ($_SESSION['role'] === 'admin'): ?>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="index.php">HOME</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="managefilms.php">MANAGE FILMS</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="films.php">FILMS</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="signout.php">SIGN OUT</a>
            </li>
        <?php endif; ?>
    </ul>

    <ul class="nav-list d-flex-col align-items-center lg-d-none" id="mobile-menu">
        <?php if (!isset($_SESSION['role'])): ?>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="index.php">HOME</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="films.php">FILMS</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="signin.php">SIGN IN</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="signup.php">CREATE ACCOUNT</a>
            </li>
        <?php elseif ($_SESSION['role'] === 'user'): ?>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="index.php">HOME</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="editprofile.php">PROFILE</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="films.php">FILMS</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="signout.php">SIGN OUT</a>
            </li>
        <?php elseif ($_SESSION['role'] === 'admin'): ?>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="index.php">HOME</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="managefilms.php">MANAGE FILMS</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="films.php">FILMS</a>
            </li>
            <li class="nav-list-item">
                <a class="nav-list-link text-white small" href="signout.php">SIGN OUT</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>