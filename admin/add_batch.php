<?php
session_start();
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['batch_submit'])) {
    // Retrieve form data
    $batch_year = $_POST['batch_year'];
    $total_graduates = $_POST['number_graduates'];

    // Prepare INSERT statement
    $sql = "INSERT INTO batch (batch_year, TotalGraduates) VALUES (?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ss", $batch_year, $total_graduates);
        if ($stmt->execute()) {
            // Data inserted successfully
            $_SESSION['guul'] = "success"; // Set session variable for success
            $_SESSION['message'] = "Batch added successfully";
            echo '<script>window.location.href = "batch.php";</script>';
        } else {
            // Error handling
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: " . $stmt->error; // Set error message
            echo '<script>window.location.href = "add_batch.php";</script>';
        }
        // Close the statement
        $stmt->close();
    } else {
        // Error handling
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . $conn->error; // Set error message
    }

    // Redirect to the page where you want to display the SweetAlert
    header("Location: batch.php");
    exit(); // Make sure to exit after redirecting
}
?>


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles mx-2">
            <div class="col-sm-6 p-md-2">
                <div class="welcome-text">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Batch</h4>
                    </div>
                    <div class="card-body">
                        <form action="add_batch.php" method="post">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Batch Year</label>
                                        <input type="text" required name="batch_year" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Total Graduates</label>
                                        <input type="text" required name="number_graduates" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" name="batch_submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
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

<script>
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>

<?php

include('../includes/footer.php');
?>