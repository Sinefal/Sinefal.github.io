<?php
include 'koneksi.php';
$filmId = $_GET['film_id'] ?? null;
$response = ['success' => false, 'message' => ''];

if ($filmId) {
    $stmt = $conn->prepare("SELECT is_popular FROM films WHERE film_id = ?");
    $stmt->bind_param("i", $filmId);
    $stmt->execute();
    $result = $stmt->get_result();
    $film = $result->fetch_assoc();

    $isPopular = $film['is_popular'] ? 0 : 1;
    $message = $isPopular ? "Added to Popular" : "Removed from Popular";

    if ($isPopular) {
        $stmt = $conn->prepare("SELECT COUNT(*) as popular_count FROM films WHERE is_popular = 1");
        $stmt->execute();
        $countData = $stmt->get_result()->fetch_assoc();
        if ($countData['popular_count'] >= 6) {
            $response['message'] = 'Maximum of 6 films can be marked as popular.';
            echo json_encode($response);
            exit;
        }
    }

    $stmt = $conn->prepare("UPDATE films SET is_popular = ? WHERE film_id = ?");
    $stmt->bind_param("ii", $isPopular, $filmId);
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = $message;
        $response['isPopular'] = $isPopular;
    } else {
        $response['message'] = 'Failed to update popular status.';
    }
}
echo json_encode($response);