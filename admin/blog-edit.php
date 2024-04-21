<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

?>
<?php
// Check if the post ID is provided in the URL
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Retrieve the existing post details from the database
    $sql = "SELECT * FROM blog WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if ($post) {
        $title = $post['title'];
        //   $tag = $post['tag'];
        $description = $post['description'];
        $created_at = $post['created_at'];
        $updated_at = $post['updated_at'];
        //echo "Created at: $created_at<br>";
        //echo "Last updated at: $updated_at<br>";
    } else {
        echo "Post not found.";
    }
} else {
    echo "Post ID not provided.";
}

if (isset($_POST['submit'])) {
    // If form is submitted for editing the post
    //$post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Update the existing post in the database
    $sql = "UPDATE blog SET title = ?, category = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $title, $category, $description, $post_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Make sure no output is sent before the header() function
        // redirect('blogs.php'); // Redirect to the blog page after updating
        $_SESSION['guul'] = "success"; // Set session variable for success
        $_SESSION['message'] = "Data saved successfully"; // Set success message
    } else {
        // Error saving data
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
    }
}

?>

<?php
include('../includes/footer.php');
?>
