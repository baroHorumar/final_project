<?php
session_start();

include('../includes/conn.php');

if (isset($_POST['edit_batch1'])) {
    // Retrieve form data
    $batch_id = $_POST['edit_batch1'];
    $batch_year = $_POST['batch_year'];
    $total_graduates = $_POST['TotalGraduates'];

    // Prepare UPDATE statement
    $sql = "UPDATE batch SET batch_year = ?, TotalGraduates = ? WHERE batch_id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ssi", $batch_year, $total_graduates, $batch_id);
        if ($stmt->execute()) {
            // Data updated successfully
            $_SESSION['guul'] = "success"; // Set session variable for success
            $_SESSION['message'] = "Data saved successfully"; // Set success message
        } else {
            // Error saving data
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
        }
        // Close the statement
    } else {
        // Error handling
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

include('../includes/header.php');
include('../includes/sidebar.php');
?>
<div class="page-wrapper">
    <!-- row -->
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
                        <h4 class="card-title">Edit Batch</h4>
                    </div>
                    <div class="card-body">
                        <form action="edit_batch.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <?php
                                if (isset($_POST['edit_batch'])) {
                                    // Get the ID from the form submission
                                    $id = $_POST['edit_batch'];

                                    // Assuming you have a database connection already established

                                    // Perform the query to fetch the data
                                    $query = "SELECT * FROM batch WHERE batch_id = $id";
                                    $result = mysqli_query($conn, $query);

                                    // Check if the query was successful
                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                ?>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Batch Year</label>
                                                <input type="text" required value="<?php echo $row['batch_year'] ?>" name="batch_year" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Number of Graduates</label>
                                                <input type="text" required value="<?php echo $row['TotalGraduates']; ?>" name="TotalGraduates" class="form-control">
                                            </div>
                                        </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <button type="submit" name="edit_batch1" value="<?php echo $row['batch_id'] ?>" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                    <?php
                                    } else {
                                        // Handle the case where the query fails
                                        echo "Error: " . mysqli_error($conn);
                                    }
                                }
                    ?>
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