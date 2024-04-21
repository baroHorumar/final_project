<?php
session_start();
include('../includes/conn.php');


if (isset($_POST['submit'])) {
    $job_title = $_POST['job_title'];
    $company = $_POST['Company'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $apply_link = $_POST['apply_link'];

    // Ensure that alumni ID and username are set in the session
    $alumni_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_destination = '../assets/uploads/jobs' . $image_name; // Directory where images will be stored

        if (move_uploaded_file($image_tmp, $image_destination)) {
            if ($conn->connect_errno) {
                die('Could not connect to the database: ' . $conn->connect_error);
            }

            $sql = "INSERT INTO jobs ( image, job_title, company, location, description, start_date, end_date, apply_link, created_at, alumni_id) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssssi", $image_destination, $job_title, $company, $location, $description, $start_date, $end_date, $apply_link, $alumni_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['guul'] = "success"; // Set session variable for success
                $_SESSION['message'] = "Data saved successfully"; // Set success message
                header('location: jobs.php');
            } else {
                // Error saving data
                $_SESSION['guul'] = "fail"; // Set session variable for error
                $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
            }

            $conn->close();
        } else {
            echo 'Error moving the uploaded file.';
        }
    } else {
        echo 'Error uploading the image or image not set.';
    }
}
