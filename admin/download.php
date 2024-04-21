<?php
include('../includes/conn.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $update_query = "UPDATE materials SET number_of_downloads = number_of_downloads + 1 WHERE id = ?";
    $stmt_update = $conn->prepare($update_query);
    $stmt_update->bind_param("i", $id);

    if (!$stmt_update->execute()) {
        echo "Error updating download count.";
        exit();
    }

    // Fetch file details from the database
    $sql = "SELECT file FROM materials WHERE id = ?";
    $stmt_select = $conn->prepare($sql);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $stmt_select->bind_result($file);

    if ($stmt_select->fetch()) {
        // Provide the file for download
        $file_path = 'uploads/materials/' . $file; // Adjust the file path as per your directory structure
        if (file_exists($file_path)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit();
        } else {
            echo "File not found.";
        }
    } else {
        echo "File not found.";
    }
}
