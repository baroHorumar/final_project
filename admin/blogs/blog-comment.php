<?php
include('../../includes/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $author_name = isset($_POST['author_name']) ? mysqli_real_escape_string($conn, $_POST['author_name']) : '';
    $comment_text = isset($_POST['comment_text']) ? mysqli_real_escape_string($conn, $_POST['comment_text']) : '';

    if (empty($author_name) || empty($comment_text) || $post_id <= 0) {
        echo "Error: Invalid input.";
        exit();
    }

    $insert_query = "INSERT INTO comments (post_id, author_name, comment_text) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iss", $post_id, $author_name, $comment_text);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: blog-details.php?post_id=$post_id");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $stmt->error;
        $stmt->close();
        $conn->close();
    }
} else {
    header("Location: blogs.php");
    exit();
}
?>
