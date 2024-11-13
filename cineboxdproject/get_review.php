<?php
include 'koneksi.php';
session_start();

$review_id = isset($_GET['review_id']) ? (int)$_GET['review_id'] : 0;

$stmt = $conn->prepare("SELECT rating, review FROM reviews WHERE review_id = ?");
$stmt->bind_param("i", $review_id);
$stmt->execute();
$result = $stmt->get_result();
$review = $result->fetch_assoc();

if ($review) {
    echo json_encode(['success' => true, 'review' => $review]);
} else {
    echo json_encode(['success' => false, 'message' => 'Review not found']);
}
?>
