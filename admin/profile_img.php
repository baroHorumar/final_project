<?php
include('../includes/conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_avatar'])) {
    $alumni_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

    // Check if a file was selected
    if (isset($_FILES['avatar_upload']) && $_FILES['avatar_upload']['error'] === UPLOAD_ERR_OK) {
        $avatar_filename = $_FILES['avatar_upload']['name'];
        $avatar_temp_path = $_FILES['avatar_upload']['tmp_name'];
        $avatar_upload_dir = 'uploads/avatars/';

        // Create a unique name for the file
        $avatar_new_filename = uniqid('avatar_', true) . '_' . $avatar_filename;

        $avatar_destination = 'uploads/avatars/' . $avatar_new_filename;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($avatar_temp_path, $avatar_destination,)) {
            // Update the database with the avatar image path
            $update_query = "UPDATE alumni SET AvatarImagePath = '$avatar_destination' WHERE Id = '$alumni_id'";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result > 0) {
                $_SESSION['guul'] = "success"; // Set session variable for success
                $_SESSION['message'] = "Data saved successfully"; // Set success message
            } else {
                // Error saving data
                $_SESSION['guul'] = "fail"; // Set session variable for error
                $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
            }
        } else {
            // Error message if file move fails
            echo '<div class="alert alert-danger" role="alert">Error moving file to destination directory.</div>';
        }
    } else {
        // Error message if no file is selected
        echo '<div class="alert alert-danger" role="alert">Please select an avatar image to upload.</div>';
    }
}
