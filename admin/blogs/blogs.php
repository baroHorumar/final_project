<?php
include('../../includes/header.php');
include('../../includes/sidebar.php');
include('../../includes/conn.php');
?>


<div class="page-wrapper">
    <div class="content container-fluid">


        <div class="row">
            <div class="col-md-9">
                <ul class="list-links mb-4">
                    <li class="active"><a href="blogs.php">All</a></li>
                    <li class="active"><a href="blog-active.php">Active Blog</a></li>
                    <li class="pending"><a href="blogs-pending.php">Pending Blog</a></li>
                </ul>
            </div>
            <div class="col-md-3 text-md-end">
                <a href="add-blog.php" class="btn btn-primary btn-blog mb-3"><i class="feather-plus-circle me-1"></i> Add New</a>
            </div>
        </div>
        <div class="row">
            <?php
            // Fetch all posts
            $sql = "SELECT * FROM blog";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($post = $result->fetch_assoc()) {
            ?>

                    <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
                        <div class="blog grid-blog flex-fill">
                            <div class="blog-image">
                                <a href="blog-details.php?post_id=<?= $post['id'] ?>">
                                    <img class="img-fluid" src="<?php echo $post['image'] ?? ''; ?>" alt="Post Image" style="max-width: 300px; max-height: 150px;">
                                </a>
                                <div class="blog-views">
                                    <i class="feather-eye me-1"></i> 225
                                </div>
                            </div>
                            <div class="blog-content">
                                <ul class="entry-meta meta-item">
                                    <li>
                                        <div class="post-author">
                                            <a href="profile.html">
                                                <img src="../../assets/img/sawir/one.jpg" alt="Post Author">
                                                <span>
                                                    <span class="post-title">Mohamed Ali</span>
                                                    <span class="post-date"><i class="far fa-clock"></i> <?php echo $post['created_at'] ?? ''; ?></span>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <h3 class="blog-title"><a href="blog-details.php?post_id=<?= $post['id'] ?>"><?php echo $post['title'] ?? ''; ?></a></h3>
                                <p class="blog-description"><?php echo $post['title'] ?? ''; ?></p>
                            </div>
                            <div class="row ">
                                <div class="edit-options">
                                    <div class="edit-delete-btn">
                                        <a href="blog-editcode.php?post_id=<?= $post['id'] ?>" class="text-success"><i class="feather-edit-3 me-1"></i> Edit</a>
                                        <!-- <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="feather-trash-2 me-1"></i> Delete</a> -->

                                    </div>
                                    <form method="post" action="delete.php" style="margin-right: 20px;">
                                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                        <button type="submit" class="text-danger border-0 rounded" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                    <form action="blog-status.php" method="post">
                                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                        <button type="submit" class="border-0" name="toggle_status">
                                            <?php
                                            $status = isset($post['status']) ? $post['status'] : 'pending';
                                            if ($status == "approved") {
                                                echo '<span class="text-success">Approved</span>';
                                            } else {
                                                echo '<span class="text-warning">Pending</span>';
                                            }
                                            ?>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No posts found.";
            }

            // Close the database connection
            $conn->close();
            ?>


        </div>
    </div>
</div>

</div>


<?php
include('../../includes/footer.php')
?>

</html>