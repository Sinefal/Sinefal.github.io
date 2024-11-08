<?php
include 'koneksi.php';

$filmId = $_GET['film_id'] ?? null;
if ($filmId) {
    $stmt = $conn->prepare("SELECT * FROM films WHERE film_id = ?");
    $stmt->bind_param("i", $filmId);
    $stmt->execute();
    $result = $stmt->get_result();
    $film = $result->fetch_assoc();
    echo json_encode($film);
}
?>
