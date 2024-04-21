<?php
include('../includes/header.php');
include('../includes/sidebar.php');
// include('material_add_code.php')
?>


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Add Post</h3>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="bank-inner-details">
                            <div class="row">
                                <form action="material_add_code.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="alumni_id" value="<?= $alumni_id ?>">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Title<span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control" name="file" id="file" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="description ..."></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class=" blog-categories-btn pt-0">
                        <div class="bank-details-btn ">
                            <button type="submit" name="submit" class="btn btn-primary me-2">Add Post</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
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
include('../includes/footer.php');
?>