<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
include('material_update.php');
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
                                        <form action="material_update.php?post_id=<?php echo $post_id; ?>" method="post" enctype="multipart/form-data">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Title<span class="text-danger">*</span></label>
                                                    <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="file">File</label>
                                                <input type="file" class="form-control" name="file" id="file" value="<?php echo $file; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="description ..."><?php echo $description; ?></textarea>
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



<?php
include('../includes/footer.php');
?>
