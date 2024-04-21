<?php
session_start();
include('../includes/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $post_id = intval($_GET['id']);

    // Update number_of_downloads in the materials table
    $update_query = "UPDATE materials SET number_of_downloads = number_of_downloads + 1 WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $post_id);

    if ($stmt->execute()) {
        // Redirect to the download link
        header("Location: process-download.php?id=$post_id");
        exit();
    } else {
        echo "Error updating downloads.";
    }
} else {
    echo "Invalid request.";
}
