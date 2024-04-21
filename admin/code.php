<?php
session_start();
include('../includes/conn.php');
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Ensure that alumni ID and username are set in the session
    $alumni_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

    if ($alumni_id > 0) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Retrieve image details
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_destination = '../assets/uploads/post/' . $image_name; // Directory where images will be stored

            // Move uploaded image to destination
            if (move_uploaded_file($image_tmp, $image_destination)) {

                // Prepare SQL query
                $sql = "INSERT INTO blog (title, image, category, description, created_at, alumni_id) VALUES (?, ?, ?, ?, NOW(), ?)";
                $stmt = $conn->prepare($sql);

                // Bind parameters and execute query
                $stmt->bind_param('ssssi', $title, $image_destination, $category, $description, $alumni_id);
                $stmt->execute();

                // Check if query was executed successfully
                if ($stmt) {
                    $_SESSION['guul'] = "success"; // Set session variable for success
                    $_SESSION['message'] = "Data saved successfully"; // Set success message
                    header('location: blogs.php');
                } else {
                    // Error saving data
                    $_SESSION['guul'] = "fail"; // Set session variable for error
                    $_SESSION['message'] = "Error: " . $conn->error; // Set error message
                    echo "<script>window.location.href = 'add-blog.php';</script>";
                }
                // Close database connection
                $conn->close();
            } else {
                // Error moving the uploaded file
                $_SESSION['guul'] = "fail"; // Set session variable for error
                $_SESSION['message'] = "Error moving the uploaded file.";
                echo "<script>window.location.href = 'add-blog.php';</script>";
                // Set error message
            }
        } else {
            // Error uploading the image or image not set
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error uploading the image or image not set."; // Set error message
            echo "<script>window.location.href = 'add-blog.php';</script>";
        }
    } else {
        // Error: Alumni ID or username not found in the session
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: Alumni ID or username not found in the session."; // Set error message
        echo "<script>window.location.href = 'add-blog.php';</script>";
    }

    // Redirect back to the form page

}

// if (isset($_POST['submit'])) {
// $title = $_POST['title'];
// $category = $_POST['category'];
// $description = $_POST['description'];

// // Ensure that alumni ID and username are set in the session
// $alumni_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

// if ($alumni_id > 0) {
// if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
// $image_name = $_FILES['image']['name'];
// $image_tmp = $_FILES['image']['tmp_name'];
// $image_destination = '../assets/uploads/post' . $image_name; // Directory where images will be stored

// if (move_uploaded_file($image_tmp, $image_destination)) {
// if ($conn->connect_errno) {
// die('Could not connect to the database: ' . $conn->connect_error);
// }
// $sql = "INSERT INTO blog (title, image, category, description, created_at, alumni_id) VALUES (?, ?, ?, ?, NOW(), ?)";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param('ssssi', $title, $image_destination, $category, $description, $alumni_id);
// $stmt->execute();

// if ($stmt) {
// $_SESSION['guul'] = "success"; // Set session variable for success
// $_SESSION['message'] = "Data saved successfully"; // Set success message
// } else {
// // Error saving data
// $_SESSION['guul'] = "fail"; // Set session variable for error
// $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
// }

// $conn->close();
// } else {
// echo 'Error moving the uploaded file.';
// }
// } else {
// echo 'Error uploading the image or image not set.';
// }
// } else {
// echo 'Error: Alumni ID or username not found in the session.';
// }
// }