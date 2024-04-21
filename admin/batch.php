<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

if (isset($_POST["delete_batch"]) && !empty($_POST["delete_batch"])) {
    // Include database connection

    // Prepare a delete statement
    $sql = "DELETE FROM batch WHERE batch_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_batch_id);

        // Set parameters
        $param_batch_id = $_POST["delete_batch"];


        if ($stmt->execute()) {
            // Bind parameters and execute the statement
            $stmt->bind_param("sss", $name, $email, $faculty_phone);
            if ($stmt->execute()) {
                // Data inserted successfully
                $_SESSION['guul'] = "success"; // Set session variable for success
                $_SESSION['message'] = "Faculty added successfully"; // Set success message
                header("Location: ./faculties.php"); // Redirect to faculties.php
                exit(); // Exit to prevent further execution
            } else {
                // Error handling
                $_SESSION['guul'] = "fail"; // Set session variable for error
                $_SESSION['message'] = "Error: " . $stmt->error; // Set error message
            }
            // Close the statement
            $stmt->close();
        } else {
            // Error handling
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: " . $conn->error; // Set error message
        }
    }
}

$query = "SELECT * FROM batch";

// Execute the query
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Batch</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Batches</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a class="btn btn-primary filter-btn" href="add_batch.php" id="filter_search">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Batch Year</th>
                                        <th>Total Graduates</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Loop through each row of the result set
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><a href="view-estimate.html"><?php echo $row['batch_id']; ?></a></td>
                                            <td><?php echo $row['batch_year']; ?></td>
                                            <td><?php echo $row['TotalGraduates']; ?></td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- Edit button -->
                                                        <form action="./edit_batch.php" method="post">
                                                            <input type="hidden" name="edit_batch" value="<?php echo $row['batch_id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </button>
                                                        </form>
                                                        <form action="batch.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                            <input type="hidden" name="delete_batch" value="<?php echo $row['batch_id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                            </button>
                                                        </form>

                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
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