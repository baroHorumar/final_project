<?php
session_start();
include('../includes/conn.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alumni_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

    if ($alumni_id > 0) {
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        $comment_id = isset($_POST['comment_id']) ? intval($_POST['comment_id']) : 0; // Corrected variable name
        $reply_text = isset($_POST['reply_text']) ? mysqli_real_escape_string($conn, $_POST['reply_text']) : '';

        if (empty($reply_text) || $post_id <= 0 || $comment_id <= 0) {
            echo "Error: Invalid input.";
            exit();
        }

        // Make sure to adjust the table and column names accordingly
        $insert_query = "INSERT INTO replies (post_id, alumni_id, comment_id, reply_text) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("iiis", $post_id, $alumni_id, $comment_id, $reply_text);

        if ($stmt->execute()) {
            $stmt->close();
            // Redirect to the appropriate page after successful comment submission
            header("Location: blog-details.php?post_id=$post_id");
            exit();
        } else {
            // Redirect to the appropriate page with an error message
            header("Location: index.php?error=Unable to submit reply. Please try again.");
            exit();
        }
    } else {
        echo "Error: Alumni ID not found in the session.";
        exit();
    }
} else {
    // Display an error message instead of redirecting
    echo "Error: Invalid request.";
    exit();
}
