<?php
include('../../includes/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["toggle_status"], $_POST["post_id"])) {
    $post_id = $_POST["post_id"];

    // Retrieve the current status from the database
    $query = "SELECT status FROM blog WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $post_id);
    $statement->execute();
    $statement->bind_result($current_status);
    $statement->fetch();
    $statement->close();

    // Toggle the status
    $new_status = ($current_status == "approved") ? "pending" : "approved";

    // Update the status of the post in the database
    $update_query = "UPDATE blog SET status = ? WHERE id = ?";
    $update_statement = $conn->prepare($update_query);
    $update_statement->bind_param("si", $new_status, $post_id);

    if ($update_statement->execute()) {
        echo "Post status updated successfully";
    } else {
        echo "Error updating post status: " . $conn->error;
    }

    $update_statement->close();
}

$conn->close();
header('Location: blogs.php');
exit;
?>
