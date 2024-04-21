<?php
include('../../includes/conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get values from the form
    $commentId = $_POST['comment_id'];
    $postId = $_POST['post_id'];
    $authorName = $_POST['author_name'];
    $replyText = $_POST['reply_text'];

    // Insert reply into the database
    $insertReplyQuery = "INSERT INTO comment_replies (comment_id, post_id, author_name, reply_text, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($insertReplyQuery);
    $stmt->bind_param("iiss", $commentId, $postId, $authorName, $replyText);

    if ($stmt->execute()) {
        // Reply inserted successfully
        header("Location: blog-details.php?post_id=$post_id"); // Redirect to the blog page or wherever you want to redirect after submitting a reply
        exit();
    } else {
        // Error handling if the insertion fails
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Redirect to the blog page if accessed without a POST request
header("Location: blogs.php");
exit();
?>
