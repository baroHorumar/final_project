<?php
session_start();
include('../includes/conn.php');

// Check if alumni ID and username are set in the session
$alumni_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Gather data from the form
$image = $_POST['image'];
$job_title = $_POST['job_title'];
$company = $_POST['company'];
$location = $_POST['location'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$apply_link = $_POST['apply_link'];

// SQL query with prepared statements
$sql = "INSERT INTO jobs ( image, job_title, company, location, description, start_date, end_date, apply_link, created_at, alumni_id, username) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("ssssssssis", $image, $job_title, $company, $location, $description, $start_date, $end_date, $apply_link, $alumni_id, $username);

// Execute the statement
if ($stmt->execute()) {
    $_SESSION['guul'] = "success"; // Set session variable for success
    $_SESSION['message'] = "Data saved successfully"; // Set success message
} else {
    // Error saving data
    $_SESSION['guul'] = "fail"; // Set session variable for error
    $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
}

// Close the statement and connection
$stmt->close();
$conn->close();
