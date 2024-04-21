<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

$sql = "SELECT faculty_id, name FROM faculties";
$result = mysqli_query($conn, $sql);

$sqlbatch = "SELECT batch_id, batch_year FROM batch";
$resultbatch = mysqli_query($conn, $sqlbatch);
?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <h3 class="page-title">Alumni Report</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Reports</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="alumni_report_read.php" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Report Type</label>
                                <select name="status" class="form-control">
                                    <option value="All">All</option>
                                    <option value="Employed">Employed</option>
                                    <option value="Unemployed">Unemployed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Faculty</label>
                                <select name="faculty_id" class="form-control">
                                    <option value="All">All</option>
                                    <?php
                                    // Loop through the fetched data and display it in rows
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['faculty_id'] . "'>" . $row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Batch</label>
                                <select name="batch_id" class="form-control">
                                    <option value="All">All</option>
                                    <?php
                                    // Loop through the fetched batch data and display it in options
                                    while ($batch_row = mysqli_fetch_assoc($resultbatch)) {
                                        echo "<option value='" . $batch_row['batch_id'] . "'>" . $batch_row['batch_year'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 text-center"> <!-- Adjust the width of the column according to your layout -->
                            <button class="btn btn-primary">Generate Report</button>
                        </div>
                    </div>
                </form>
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
<script src="../assets/js/select2.min.js"></script>

<?php include '../includes/footer.php'; ?>