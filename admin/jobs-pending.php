<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
include('../includes/jobs.php');
?>



<div class="content container-fluid p-5">
    <div class="row">

        <!-- Add space on the left -->
        <div class="col-xl-3 col-lg-3 col-md-4">
            <!-- Your sidebar content goes here -->

        </div>
        <!-- Right content -->
        <div class="col-xl-9 col-lg-9 col-md-8">
            <!-- Featured_job_start -->
            <div class="row p-4">
                <div class="col-md-9">
                    <ul class="list-links mb-4">
                        <li class="active"><a href="jobs.php">All</a></li>
                        <li class="active"><a href="jobs-active.php">Active Blog</a></li>
                        <li><a href="jobs-pending.php">Pending Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-3 text-md-end">
                    <a href="job-add.php" class="btn btn-primary btn-blog mb-3" style="background-color:#7638ff; ">
                        <i class="feather-plus-circle me-1"></i> Add New</a>
                </div>
            </div>
            <section class="featured-job-area">
                <div class="container">
                    <!-- Count of Job list Start -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="count-job mb-35">
                                <!-- <span>39, 782 Jobs found</span> -->
                                <!-- Select job items start -->
                                <!-- <div class="select-job-items">
                                        <span>Sort by</span>
                                        <select name="select">
                                            <option value="">None</option>
                                            <option value="">job list</option>
                                            <option value="">job list</option>
                                            <option value="">job list</option>
                                        </select>
                                    </div> -->
                                <!--  Select job items End-->
                            </div>
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM jobs WHERE status = 'pending' ";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($post = $result->fetch_assoc()) {
                    ?>
                            <!-- Count of Job list End -->
                            <!-- single-job-content -->
                            <div class="single-job-items mb-30 " style="background-color:aliceblue; border-radius: 25px; border: 2px solid #38B7FF;">
                                <div class="job-items">
                                    <div class="company-img">
                                        <a href="#"><img src="<?php echo $post['image'] ?? ''; ?>" alt="company-img" style="max-width: 100px; max-height: 80px; min-width: 100px; min-height: 80px;"></a>
                                    </div>
                                    <div class="job-tittle job-tittle2">
                                        <a href="#">
                                            <h4><a href="job_view.php?post_id=<?= $post['id'] ?>"><?php echo $post['job_title'] ?? ''; ?></a></h4>
                                        </a>
                                        <ul class="pt-3">
                                            <li><?php echo $post['company'] ?? ''; ?></li>
                                            <li><i class="fas fa-map-marker-alt"></i><?php echo $post['location'] ?? ''; ?></li>
                                            <li>$3500 - $4000</li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="items-link items-link2 f-right">
                                    <div class="edit-delete-btn">
                                        <a href="job_editc.php?post_id=<?= $post['id'] ?>" class="text-success"><i class="feather-edit-3 me-1"></i> Edit</a>
                                        <!-- <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="feather-trash-2 me-1"></i> Delete</a> -->

                                    </div>

                                    <form method="post" action="job-delete.php" style="margin-right: 10px;">
                                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                        <button type="submit" class="text-danger border-0 border-info rounded-pill mb-2" style="background-color:#ffe5e5;" onclick="return confirm('Are you sure you want to delete this post?')"><Span class="px-4 text-danger">Delete</Span></button>
                                    </form>

                                    <form action="job-status.php" method="post">
                                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                        <button type="submit" class="border-1 border-info rounded-pill" name="toggle_status">
                                            <?php
                                            $status = isset($post['status']) ? $post['status'] : 'pending';
                                            if ($status == "approved") {
                                                echo '<span class="text-success px-3" >Approved</span>';
                                            } else {
                                                echo '<span class="text-warning pr-3 pl-3 ">Pending</span>';
                                            }
                                            ?>
                                        </button>
                                    </form>
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
            </section>
            <!-- Featured_job_end -->
        </div>
    </div>
</div>
</div>
<!-- Job List Area End -->
<script src="<?php echo appURL; ?>/assets/js/jquery-3.6.0.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/feather.min.js"></script>

<script src="<?php echo appURL; ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

<?php
include('../includes/footer.php');
?>