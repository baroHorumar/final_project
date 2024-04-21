<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
include('blog-edit.php');
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
                                <form action="blog-edit.php?post_id=<?php echo $post_id; ?>" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Title<span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                                        </div>
                                    </div>
                                    <?php
                                    $query = "SELECT faculty_id, name FROM faculties";
                                    $result = mysqli_query($conn, $query);

                                    // Check if query executed successfully
                                    if ($result) {
                                        $faculties = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all rows as associative array
                                    } else {
                                        // Handle error if query fails
                                        echo "Error: " . mysqli_error($conn);
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <select name="category" class="form-control" required>
                                            <option value="">Select Category</option>
                                            <?php
                                            // Iterate through fetched faculty data and create options
                                            foreach ($faculties as $faculty) {
                                            ?>
                                                <option value=" <?php echo $faculty['name']; ?>"> <?php echo $faculty['name']; ?></option>;
                                            <?php  }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Body</label>
                                        <textarea class="form-control" name="description" id="body" rows="5" placeholder="Body..."><?php echo $description; ?></textarea>
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
</div>



<script src="<?php echo appURL; ?>/assets/js/jquery-3.6.0.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/feather.min.js"></script>

<script src="<?php echo appURL; ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

<?php
include('../includes/footer.php');
?>