function showNotification(message) {
    alert(message);
}

function login() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if (username === "admin" && password === "admin") {
        showNotification("Login successful!");
        window.location.href = "films.php";
    } else if (username !== "admin") {
        showNotification("Username incorrect.");
    } else if (password !== "admin") {
        showNotification("Password incorrect.");
    }
}

function showAddFilmForm() {
    document.getElementById("filmFormOverlay").style.display = "block";
    document.getElementById("formTitle").innerText = "Add Film";
    document.getElementById("filmForm").reset();
    document.getElementById("filmId").value = "";
}

function showEditFilmForm(filmId) {
    document.getElementById("filmFormOverlay").style.display = "block";
    fetch(`getFilm.php?film_id=${filmId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("filmId").value = data.film_id;
            document.getElementById("title").value = data.title;
            document.getElementById("year").value = data.year;
            document.getElementById("director").value = data.director;
            document.getElementById("genre").value = data.genre;
            document.getElementById("synopsis").value = data.synopsis;
        });
}

function closeFilmForm() {
    document.getElementById("filmFormOverlay").style.display = "none";
}

function deleteFilm(filmId) {
    if (confirm("Are you sure you want to delete this film?")) {
        window.location.href = `managefilms.php?action=delete&film_id=${filmId}`;
    }
}

function togglePopular(filmId) {
    window.location.href = `managefilms.php?action=toggle_popular&film_id=${filmId}`;
}

function togglePopular(filmId) {
    const icon = document.querySelector(`button[onclick='togglePopular(${filmId})'] img`);
    fetch(`toggle_popular.php?film_id=${filmId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                icon.src = data.isPopular ? 'assets/star-icon-active.png' : 'assets/star-icon.png';
                alert(data.message);
            } else {
                alert('Max 6 coy.');
            }
        })
        .catch(error => console.error('Error:', error));
}

function toggleFilterOptions() {
    const filterOptions = document.getElementById("filter-options");
    filterOptions.style.display = filterOptions.style.display === "flex" ? "none" : "flex";
}

function openReviewModal(filmId) {
    document.getElementById('filmId').value = filmId;
    document.getElementById('reviewModal').style.display = 'flex';
}

function closeReviewModal() {
    document.getElementById('reviewModal').style.display = 'none';
}

function showReviewForm() {
    document.getElementById('reviewFormOverlay').style.display = 'flex';
    document.getElementById('reviewFormTitle').innerText = 'Add a Review';
    document.getElementById('rating').value = '';
    document.getElementById('review').value = '';
    document.getElementById('reviewId').value = '';
}

function editReview(reviewId, rating, reviewText) {
    console.log("Edit review clicked for review ID:", reviewId);
    
    // Tampilkan modal dan isi form dengan data review yang sudah ada
    document.getElementById('reviewFormOverlay').style.display = 'flex';
    document.getElementById('reviewFormTitle').innerText = 'Edit Review';
    document.getElementById('rating').value = rating;
    document.getElementById('review').value = reviewText;
    document.getElementById('reviewId').value = reviewId;
}

function closeReviewForm() {
    document.getElementById('reviewFormOverlay').style.display = 'none';
}

function deleteReview(reviewId) {
    if (confirm("Are you sure you want to delete this review?")) {
        document.getElementById('deleteReviewId').value = reviewId;
        document.getElementById('deleteReviewForm').submit();
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const hamburgerIcon = document.querySelector(".hamburger-icon");
    const navbarMenu = document.querySelector(".navbar-menu");

    hamburgerIcon.addEventListener("click", function() {
        navbarMenu.classList.toggle("show");
    });
});

function toggleMenu() {
    const mobileMenu = document.getElementById("mobile-menu");
    mobileMenu.style.display = mobileMenu.style.display === "none" ? "flex" : "none";
}
