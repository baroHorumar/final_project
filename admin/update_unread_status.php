<?php
session_start();
include('../includes/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['userId'])) {
        $current_user_id = $_SESSION['id'];
        $selected_user_id = $_POST['userId'];

        // Update unread status to read
        $query = "UPDATE chat SET is_read = 1 WHERE ReceiverId = ? AND SenderId = ? AND is_read = 0";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $current_user_id, $selected_user_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Data saved successfully
            $_SESSION['guul'] = "success"; // Set session variable for success
            $_SESSION['message'] = "Data saved successfully"; // Set success message
        } else {
            // Error saving data
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
        }
    }
}
