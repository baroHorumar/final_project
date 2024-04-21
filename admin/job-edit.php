<?php
include('../includes/conn.php');

// Check if the post ID is provided in the URL
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Retrieve the existing post details from the database
    $sql = "SELECT * FROM jobs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if ($post) {
        $image = $post['image'];
        $job_title = $post['job_title'];
        $company = $post['company'];
        $location = $post['location'];
        $description = $post['description'];
        $start_date = $post['start_date'];
        $end_date = $post['end_date'];
        $apply_link = $post['apply_link'];
        $created_at = $post['created_at'];
        // echo "Created at: $created_at<br>";
    } else {
        echo "Job not found.";
    }
} else {
    echo "Post ID not provided.";
}

if (isset($_POST['submit'])) {
    // If form is submitted for editing the post
    $image = $_POST['image'];
    $job_title = $_POST['job_title'];
    $company = $_POST['Company'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $apply_link = $_POST['apply_link'];

    // Update the existing job in the database
    $sql = "UPDATE jobs SET image = ?, job_title = ?, company = ?, location = ?, description = ?, start_date = ?, end_date = ?, apply_link = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssi', $image, $job_title, $company, $location, $description, $start_date, $end_date, $apply_link, $post_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
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