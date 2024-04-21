<?php
include('../../includes/conn.php');


?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the post ID is received
    if (isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];

        

        // SQL to delete the post
        $sql = "DELETE FROM blog WHERE id = ?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the post ID to the SQL statement
        $stmt->bind_param('i', $post_id);

        // Execute the deletion query
        if ($stmt->execute()) {
            // Deletion successful
            header('Location: blogs.php'); // Redirect to the blog page after successful deletion
            exit;
        } else {
            // Deletion failed
            echo 'Error deleting post.';
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
}
?>
