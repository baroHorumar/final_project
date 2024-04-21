<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
include('job-edit.php');
?>


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Edit Post</h3>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="bank-inner-details">
                            <div class="row">
                                <form action="job-edit.php?post_id=<?php echo $post_id; ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="logo">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" value="<?php echo $image; ?>">
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="job_title">Job Title:</label>
                                            <input type="text" id="job_title" class="form-control" name="job_title" value="<?php echo $job_title; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company">Company:</label>
                                        <input type="text" id="Company" class="form-control" name="Company" value="<?php echo $company; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location:</label>
                                        <input type="text" id="location" class="form-control" name="location" value="<?php echo $location; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Job Description:</label>
                                        <textarea id="description" class="form-control" name="description" rows="4" required><?php echo $description; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" id="start_date" class="form-control" name="start_date" value="<?php echo $start_date; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" id="end_date" class="form-control" name="end_date" value="<?php echo $end_date; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apply_link">Apply Link:</label>
                                        <input type="url" id="apply_link" class="form-control" name="apply_link" value="<?php echo $apply_link; ?>" placeholder="https://example.com/apply">
                                    </div>
                                    <div class="blog-categories-btn pt-0">
                                        <div class="bank-details-btn">
                                            <button type="submit" name="submit" class="btn btn-primary me-2">
                                                Update Post
                                            </button>
                                        </div>
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

<script src="<?php echo appURL; ?>/assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo appURL; ?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo appURL; ?>/assets/js/feather.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/select2/js/select2.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/datatables/datatables.min.js"></script>
<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

<?php
include('../includes/footer.php');
?>