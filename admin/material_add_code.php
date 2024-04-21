<?php
session_start(); // Start the session

include('../includes/conn.php');

// Check if file upload has errors
if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    die('File upload error.');
}

// Gather data from the form
$file = $_FILES['file']['name'];
$title = isset($_POST['title']) ? $_POST['title'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';


// Check if alumni ID and username are set in the session
$alumni_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

// Modify session data or add more data
$_SESSION['new_variable'] = 'some_value';

// Set the upload directory
$uploadDirectory = 'uploads/materials/';

// Ensure the directory exists or create it
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}

// Set the full path for the uploaded file
$targetPath = $uploadDirectory . $file;

// Move the uploaded file to the specified directory
if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {

    // SQL query with prepared statements
    $sql = "INSERT INTO materials (file, title, description, created_at, alumni_id) 
            VALUES (?, ?, ?, NOW(), ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssi", $file, $title, $description, $alumni_id,);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['guul'] = "success"; // Set session variable for success
        $_SESSION['message'] = "Data saved successfully"; // Set success message
        header('location: Material.php');
    } else {
        // Error saving data
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
    }
    // Close the statement
    $stmt->close();
} else {
    echo "Error moving the uploaded file.";
}

// Close the connection
$conn->close();
