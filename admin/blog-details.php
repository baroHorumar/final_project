<?php
session_start();
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alumni_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

    if ($alumni_id > 0) {
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        $comment_text = isset($_POST['comment_text']) ? mysqli_real_escape_string($conn, $_POST['comment_text']) : '';

        if (empty($comment_text) || $post_id <= 0) {
            echo "Error: Invalid input.";
            exit();
        }

        // Make sure to adjust the table and column names accordingly
        $insert_query = "INSERT INTO comments (post_id, alumni_id,  comment_text) VALUES (?, ?, ?)";

        // Assuming the author_name is not being used, you can remove it if not needed
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("iis", $post_id, $alumni_id,  $comment_text);

        if ($stmt->execute()) {
            header('location: blog-details.php?post_id=$post_id');
        } else {
            // Error saving data
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
        }
    } else {
        echo "Error: Alumni ID or username not found in the session.";
        exit();
    }
}
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $reader_id = $_SESSION['id'];

    // Insert the reader information into the database
    $insert_query = "INSERT INTO reader (post_id, reader_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ii", $post_id, $reader_id);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        // Update Num_of_read in the blog table
        $update_query = "UPDATE blog SET Num_of_read = Num_of_read + 1 WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();

        // Check if the update was successful
        if (!$stmt->affected_rows > 0) {
        }
    } else {
        echo "Failed to insert reader information.";
    }
}

?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="blog-view">
                    <div class="blog-single-post">
                        <a href="blogs.php" class="back-btn"><i class="feather-chevron-left"></i> Back</a>
                        <!-- PHP code for checking post_id and inserting data into the database -->
                        <?php
                        if (isset($_GET['post_id'])) {
                            $post_id = $_GET['post_id'];
                            $reader_id = $_SESSION['id'];
                            $insert_query = "INSERT INTO reader (post_id, reader_id) VALUES (?, ?)";
                            $stmt = $conn->prepare($insert_query);
                            $stmt->bind_param("ii", $post_id, $reader_id);
                            $stmt->execute();
                        }

                        // Fetch post details
                        $post_query = "SELECT * FROM blog WHERE id = $post_id";
                        $post_result = $conn->query($post_query);
                        if ($post_result && $post_result->num_rows > 0) {
                            $post = $post_result->fetch_assoc();
                        ?>
                            <!-- HTML code to display post details -->
                            <div class="blog-image">
                                <a href="javascript:void(0);"><img alt="" src="<?= $post['image'] ?>" class="img-fluid"></a>
                            </div>
                            <h3 class="blog-title"><?= $post['title'] ?></h3>
                            <div class="blog-info">
                                <div class="post-list">
                                    <ul>
                                        <li>
                                            <div class="post-author">
                                                <a href="profile.html"><img src="../assets/img/profiles/avatar-01.jpg" alt="Post Author"> <span>by Prof. Lester </span></a>
                                            </div>
                                        </li>
                                        <li><i class="feather-clock"></i> <?= $post['created_at'] ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-content">
                                <p><?= $post['description'] ?></p>
                            </div>
                        <?php
                        } else {
                            echo "<p>Post not found.</p>";
                        }
                        ?>

                        <!-- Comments section -->
                        <!-- Comments section -->
                        <div class="card blog-comments">
                            <div class="card-header">
                                <h4 class="card-title">Comments (5)</h4>
                            </div>
                            <div class="card-body pb-0">
                                <ul class="comments-list">
                                    <!-- PHP code for fetching and displaying comments -->
                                    <?php
                                    $comments_query = "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC";
                                    $comments_stmt = $conn->prepare($comments_query);
                                    $comments_stmt->bind_param("i", $post_id);
                                    $comments_stmt->execute();
                                    $comments_result = $comments_stmt->get_result();

                                    if ($comments_result->num_rows > 0) {
                                        while ($comment = $comments_result->fetch_assoc()) {
                                            // Fetch alumni details for each comment
                                            $alumni_query = "SELECT CONCAT(FirstName, ' ', LastName) AS FullName FROM alumni WHERE Id = ?";
                                            $alumni_stmt = $conn->prepare($alumni_query);
                                            $alumni_stmt->bind_param("i", $comment['alumni_id']);
                                            $alumni_stmt->execute();
                                            $alumni_result = $alumni_stmt->get_result();
                                            $alumni_data = $alumni_result->fetch_assoc();
                                            $full_name = $alumni_data['FullName'];
                                    ?>
                                            <li>
                                                <div class="comment">
                                                    <div class="comment-author">
                                                        <img class="avatar" alt="" src="../assets/img/profiles/avatar-13.jpg">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-by">
                                                            <h5 class="blog-author-name"><?= htmlspecialchars($full_name) ?><span class="blog-date"> <i class="feather-clock me-1"></i>
                                                                    <?= $comment['created_at'] ?></span></h5>
                                                        </div>
                                                        <p><?= htmlspecialchars($comment['comment_text']) ?></p>
                                                        <a class="comment-btn " data-comment-id="<?= $comment['id'] ?>" onclick="showReplyForm(this);" href="#">
                                                            <i class="fa fa-reply me-2"></i> Reply
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- Reply Form -->
                                                <div id="reply-form-<?= $comment['id'] ?>" class="reply-form" style="display: none;">
                                                    <form action="blog-comment-reply.php" method="post">
                                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                                        <input type="hidden" name="username" value="<?= $username ?>">
                                                        <div class="form-group">
                                                            <textarea rows="2" class="form-control" name="reply_text" placeholder="Your reply"></textarea>
                                                        </div>
                                                        <div class="submit-section">
                                                            <button class="submit-btn btn-primary" type="submit">Submit Reply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <ul class="comments-list reply">
                                                    <!-- PHP code for fetching and displaying reply comments -->
                                                    <?php
                                                    $reply_comments_query = "SELECT * FROM replies WHERE comment_id = ? ORDER BY created_at DESC";
                                                    $reply_stmt = $conn->prepare($reply_comments_query);
                                                    $reply_stmt->bind_param("i", $comment['id']);
                                                    $reply_stmt->execute();
                                                    $reply_result = $reply_stmt->get_result();

                                                    if ($reply_result->num_rows > 0) {
                                                        while ($reply_comment = $reply_result->fetch_assoc()) {
                                                    ?>
                                                            <li>
                                                                <div class="comment">
                                                                    <div class="comment-author">
                                                                        <img class="avatar" alt="" src="../assets/img/profiles/avatar-06.jpg">
                                                                    </div>
                                                                    <div class="comment-block">
                                                                        <div class="comment-by">
                                                                            <h5 class="blog-author-name"><?= htmlspecialchars($reply_comment['username']) ?><span class="blog-date"> <i class="feather-clock me-1"></i>
                                                                                    <?= $reply_comment['created_at'] ?></span></h5>
                                                                        </div>
                                                                        <p><?= htmlspecialchars($reply_comment['reply_text']) ?></p>
                                                                        <a class="comment-btn" href="#">
                                                                            <i class="fa fa-reply me-2"></i> Reply
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                    <?php
                                        }
                                    } else {
                                        echo "<p>No comments yet.</p>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- New Comment Form -->
                        <div class="card new-comment clearfix">
                            <div class="card-header">
                                <h4 class="card-title">Leave Comment</h4>
                            </div>
                            <div class="card-body">
                                <form action="blog-details.php" method="post">
                                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                    <input type="hidden" name="username" value="<?= $username ?>">
                                    <div class="form-group">
                                        <textarea rows="4" class="form-control bg-grey" name="comment_text" placeholder="Comments"></textarea>
                                    </div>
                                    <div class="submit-section">
                                        <button class="submit-btn btn-primary btn-blog" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function showReplyForm(self) {
        var commentId = self.getAttribute("data-comment-id");
        var formId = "reply-form-" + commentId; // Adjusted form ID
        var replyForm = document.getElementById(formId);

        if (replyForm.style.display == "" || replyForm.style.display == "none") {
            replyForm.style.display = "block"; // Use "block" to display the form
        } else {
            replyForm.style.display = "none";
        }
    }
</script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/select2/js/select2.min.js"></script>
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/datatables.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

<?php
include('../includes/footer.php')
?>