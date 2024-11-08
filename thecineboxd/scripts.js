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

function editReview(reviewId) {
    console.log("Edit review clicked for review ID:", reviewId);
    
    fetch(`get_review.php?review_id=${reviewId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('reviewFormOverlay').style.display = 'flex';
                document.getElementById('reviewFormTitle').innerText = 'Edit Review';
                document.getElementById('rating').value = data.review.rating;
                document.getElementById('review').value = data.review.review;
                document.getElementById('reviewId').value = reviewId;
            } else {
                alert('Error: Review not found.');
            }
        })
        .catch(error => {
            console.error('Error fetching review:', error);
            alert('Error loading review data.');
        });
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

document.addEventListener('DOMContentLoaded', function() {
    const hamburgerButton = document.getElementById('hamburger-button');
    if (hamburgerButton) {
        hamburgerButton.addEventListener('click', toggleMenu);
    } else {
        console.error('Hamburger button not found.');
    }
});

function toggleMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu) {
        mobileMenu.classList.toggle('active');
    } else {
        console.error('Element with ID "mobile-menu" not found.');
    }
}