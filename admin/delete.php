<?php
include('../includes/conn.php');


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
        // Execut the deletion query
        if ($stmt->execute()) {
            // Deletion successful
            $_SESSION['guul'] = "success"; // Set session variable for success
            $_SESSION['message'] = "Data saved successfully"; // Set success message
            header('location: blogs.php');
        } else {
            // Error saving data
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
            header('location: blogs.php');
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
}
?>
