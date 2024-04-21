<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
?>

<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Material</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Material</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="material-add.php" class="btn btn-primary me-1">
                        <i class="fas fa-plus"></i>
                    </a>
                    <!-- <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
                        <i class="fas fa-filter"></i>
                    </a> -->
                </div>
            </div>
        </div>


        <div id="filter_inputs" class="card filter-card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Customer</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Payment Mode</label>
                            <select class="select">
                                <option>Payment Mode</option>
                                <option>Cash</option>
                                <option>Cheque</option>
                                <option>Card</option>
                                <option>Online</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Material ID</th>
                                        <th>User Upload</th>
                                        <th>Number Download</th>
                                        <th>date</th>
                                        <th> </th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $sql = "SELECT * FROM materials";
                                $result = $conn->query($sql);

                                if ($result && $result->num_rows > 0) {
                                    while ($post = $result->fetch_assoc()) {
                                ?>
                                        <tbody>
                                            <tr>
                                                <td><a href="javascript:void(0);">#<?php echo $post['id'] ?? ''; ?></a></td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.php"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="../assets/img/sawir/one.jpg" alt="User Image"> Mohamed Ali</a>
                                                    </h2>
                                                </td>
                                                <td><?php echo $post['number_of_downloads'] ?? ''; ?></td>
                                                <td><?php echo $post['created_at'] ?? ''; ?></td>

                                                <td>
                                                    <a class="btn btn-sm btn-white me-2" href="download.php?id=<?= $post['id'] ?>" onclick="console.log('Clicked download with post_id <?= $post['id'] ?>')">
                                                        <i class="fas fa-download me-1"></i> Download
                                                    </a>

                                                    <!-- <a class="btn btn-sm btn-white" href="view-invoice.html">
                                                        <i class="far fa-eye me-1"></i> View
                                                    </a> -->
                                                </td>
                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="material-edit.php?post_id=<?= $post['id'] ?>"><i class="far fa-edit me-2"></i>Edit</a>
                                                            <!-- <a class="dropdown-item" href="#"><i class="far fa-eye me-2"></i>Edit</a> -->
                                                            <form method="post" action="material-delete.php" style="margin-left: 3px;">
                                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                                <button type="submit" class="text-danger border-0 bg-white " onclick="return confirm('Are you sure you want to delete this post?')"><Span class="px-1 text-danger"><i class="far fa-trash-alt me-2"></i>Delete</Span></button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                        </tbody>
                                <?php
                                    }
                                } else {
                                    echo "No posts found.";
                                }

                                // Close the database connection
                                $conn->close();
                                ?>
                            </table>
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
<script src="<?php echo appURL; ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo appURL; ?>/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/datatables/datatables.min.js"></script>
<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<?php
include('../includes/footer.php');
?>