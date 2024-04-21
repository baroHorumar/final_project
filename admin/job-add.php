<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('code.php');
?>


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Add Job</h3>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="bank-inner-details">
                            <div class="row">
                                <form action="job_codec.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="alumni_id" value="<?= $alumni_id ?>">
                                    <input type="hidden" name="username" value="<?= $username ?>">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>
                                        <div class="form-group">
                                            <label>Title<span class="text-danger">*</span></label>
                                            <input type="text" name="job_title" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Company Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Company name" name="Company">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Location<span class="text-danger">*</span></label>
                                        <input type="text" name="location" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Job Description </label>
                                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="body ..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" id="start_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" class="form-control" name="end_date" id="end_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="apply_link">Apply link</label>
                                        <input type="url" class="form-control" name="apply_link" id="apply_link" placeholder="https://example.com/apply">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class=" blog-categories-btn pt-0">
                        <div class="bank-details-btn ">
                            <button type="submit" name="submit" class="btn btn-primary me-2">Add Job</button>
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

<script src="<?php echo appURL; ?>/assets/js/jquery-3.6.0.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/feather.min.js"></script>

<script src="<?php echo appURL; ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

<?php
include('../includes/footer.php');
?>