<?php
include('../../includes/header.php');
include('../../includes/sidebar.php');
include('../../includes/conn.php')


?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                <div class="blog-view">
                    <div class="blog-single-post">
                        <a href="blog.php" class="back-btn"><i class="feather-chevron-left"></i> Back</a>
                        <?php
                        

                        if (isset($_GET['post_id'])) {
                            $post_id = $_GET['post_id'];
                            $post_query = "SELECT * FROM blog WHERE id = $post_id";
                            $post_result = $conn->query($post_query);

                            if ($post_result && $post_result->num_rows > 0) {
                                $post = $post_result->fetch_assoc();
                        ?>
                                <div class="blog-image">
                                    <a href="javascript:void(0);"><img alt="" src="<?= $post['image'] ?>" class="img-fluid"></a>
                                </div>
                                <h3 class="blog-title"><?= $post['title'] ?></h3>
                                <div class="blog-info">
                                    <div class="post-list">
                                        <ul>
                                            <li>
                                                <div class="post-author">
                                                    <a href="profile.html"><img src="assets/img/profiles/avatar-01.jpg" alt="Post Author"> <span>by Prof. Lester </span></a>
                                                </div>
                                            </li>
                                            <li><i class="feather-clock"></i> <?= $post['created_at'] ?></li>
                                            <!-- <li><i class="feather-message-square"></i> 40 Comments</li> -->
                                            <!-- <li><i class="feather-grid"></i> Project Manager</li> -->
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
                        } else {
                            echo "<p>No post ID specified.</p>";
                        }
                        ?>
                        <div class="card blog-comments">
                            <div class="card-header">
                                <h4 class="card-title">Comments (5)</h4>
                            </div>
                            <div class="card-body pb-0">
                                <ul class="comments-list">
                                    <li>
                                        <?php
                                        $comments_query = "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC";
                                        $stmt = $conn->prepare($comments_query);
                                        $stmt->bind_param("i", $post_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            while ($comment = $result->fetch_assoc()) {
                                        ?>
                                                <div class="comment">
                                                    <div class="comment-author">
                                                        <img class="avatar" alt="" src="assets/img/profiles/avatar-13.jpg">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-by">
                                                            <h5 class="blog-author-name"><?= htmlspecialchars($comment['author_name']) ?><span class="blog-date"> <i class="feather-clock me-1"></i>
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
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="floatingInput" name="author_name" placeholder="Enter your name">
                                                            <label for="floatingInput">Name<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea rows="2" class="form-control" name="reply_text" placeholder="Your reply"></textarea>
                                                        </div>
                                                        <div class="submit-section">
                                                            <button class="submit-btn btn-primary" type="submit">Submit Reply</button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <ul class="comments-list reply">
                                                    <?php
                                                    $reply_comments_query = "SELECT * FROM blog_replies WHERE comment_id = ? ORDER BY created_at DESC";
                                                    $stmt_reply = $mysqli->prepare($reply_comments_query);
                                                    $stmt_reply->bind_param("i", $comment['id']);
                                                    $stmt_reply->execute();
                                                    $reply_result = $stmt_reply->get_result();

                                                    if ($reply_result->num_rows > 0) {
                                                        while ($reply_comment = $reply_result->fetch_assoc()) {
                                                    ?>

                                                            <li>
                                                                <div class="comment">
                                                                    <div class="comment-author">
                                                                        <img class="avatar" alt="" src="assets/img/profiles/avatar-06.jpg">
                                                                    </div>
                                                                    <div class="comment-block">
                                                                        <div class="comment-by">
                                                                            <h5 class="blog-author-name"><?= htmlspecialchars($reply_comment['author_name']) ?><span class="blog-date"> <i class="feather-clock me-1"></i>
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
                                                    $stmt_reply->close();
                                                    ?>

                                                </ul>
                                    </li>
                            <?php
                                            }
                                        } else {
                                            echo "<p>No comments yet.</p>";
                                        }
                                        $stmt->close();
                            ?>
                                </ul>
                            </div>
                        </div>


                        <div class="card new-comment clearfix">
                            <div class="card-header">
                                <h4 class="card-title">Leave Comment</h4>
                            </div>
                            <div class="card-body">
                                <form action="blog-comment.php" method="post">
                                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" name="author_name" placeholder="Enter your name">
                                        <label for="floatingInput">Name<span class="text-danger">*</span></label>
                                    </div>

                                    <div class="form-group">
                                        <textarea rows="4" class="form-control bg-grey" name="comment_text" placeholder="Comments"></textarea>
                                    </div>
                                    <div class="submit-section">
                                        <button class="submit-btn btn-primary btn-blog" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- <div class="card blog-share clearfix">
                            <div class="card-header">
                                <h4 class="card-title">Share the post</h4>
                            </div>
                            <div class="card-body">
                                <ul class="social-share">
                                    <li><a href="#"><i class="feather-twitter"></i></a></li>
                                    <li><a href="#"><i class="feather-facebook"></i></a></li>
                                    <li><a href="#"><i class="feather-linkedin"></i></a></li>
                                    <li><a href="#"><i class="feather-instagram"></i></a></li>
                                    <li><a href="#"><i class="feather-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div> -->

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

</div>






</body>

<!-- Add this script at the end of your HTML document -->
<!-- JavaScript function to toggle reply form visibility -->
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

<?php
include('includes/footer.php')
?>

</html>