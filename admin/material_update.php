<?php
include('../includes/conn.php');

// Check if the material ID is provided in the URL
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Retrieve the existing material details from the database
    $sql = "SELECT * FROM materials WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $material = $result->fetch_assoc();

    if ($material) {
        $title = $material['title'];
        $description = $material['description'];
        $file = $material['file'];
        // Additional fields as needed
    } else {
        echo "Material not found.";
    }
} else {
    echo "Material ID not provided.";
}

if (isset($_POST['submit'])) {
    // If form is submitted for editing the material
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Check if a new file is uploaded
    if (isset($_FILES['new_file']) && $_FILES['new_file']['error'] === UPLOAD_ERR_OK) {
        $newFile = $_FILES['new_file']['name'];

        // Set the upload directory within your code folder
        $uploadDirectory = __DIR__ . 'uploads/materials/';

        // Ensure the directory exists or create it
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Set the full path for the new uploaded file
        $targetPath = $uploadDirectory . $newFile;

        // Move the new uploaded file to the specified directory
        if (move_uploaded_file($_FILES['new_file']['tmp_name'], $targetPath)) {
            // Delete the existing file
            if (!empty($file)) {
                unlink($uploadDirectory . $file);
            }
        } else {
            echo "Error moving the new uploaded file.";
            exit;
        }
    } else {
        // If no new file uploaded, keep the existing file
        $newFile = $file;
    }

    // Update the file and other fields in the database
    $sql = "UPDATE materials SET title = ?, description = ?, file = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $title, $description, $newFile, $post_id);
    $stmt->execute();

    if ($stmt->affected_rows >= 0) {
        $_SESSION['guul'] = "success"; // Set session variable for success
        $_SESSION['message'] = "Data saved successfully"; // Set success message
    } else {
        // Error saving data
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
    }
}


?>
<?php if (isset($error_message)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>