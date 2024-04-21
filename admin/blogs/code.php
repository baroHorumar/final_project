<?php
include('../../includes/conn.php');


if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $tag = $_POST['tag'];
    $description = $_POST['description'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_destination = '../../assets/uploads/post' . $image_name; // Directory where images will be stored

        if (move_uploaded_file($image_tmp, $image_destination)) {
            $conn = new mysqli('localhost', 'root', '', 'alumnidb');

            if ($conn->connect_errno) {
                die('Could not connect to the database: ' . $conn->connect_error);
            }

            $sql = "INSERT INTO blog (title, image, tag, description,created_at) VALUES (?, ?, ?, ?,NOW())";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssss', $title, $image_destination, $tag, $description);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
              header('Location: blogs.php');
            } else {
                echo 'Error inserting blog post.';
            }

            $conn->close();
        } else {
            echo 'Error moving the uploaded file.';
        }
    } else {
        echo 'Error uploading the image or image not set.';
    }
}
?>
