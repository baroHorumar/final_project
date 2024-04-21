<?php
include('../includes/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["toggle_status"], $_POST["post_id"])) {
    $post_id = $_POST["post_id"];

    // Retrieve the current status from the database
    $query = "SELECT status FROM jobs WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $post_id);
    $statement->execute();
    $statement->bind_result($current_status);
    $statement->fetch();
    $statement->close();

    // Toggle the status
    $new_status = ($current_status == "approved") ? "pending" : "approved";

    // Update the status of the post in the database
    $update_query = "UPDATE jobs SET status = ? WHERE id = ?";
    $update_statement = $conn->prepare($update_query);
    $update_statement->bind_param("si", $new_status, $post_id);

    if ($update_statement->execute()) {
        $_SESSION['guul'] = "success"; // Set session variable for success
        $_SESSION['message'] = "Data saved successfully"; // Set success message
    } else {
        // Error saving data
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
    }

    $update_statement->close();
}

$conn->close();
header('Location: jobs.php');
exit;
