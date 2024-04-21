<?php
include('../includes/conn.php');
include('../includes/header.php');
include('../includes/sidebar.php');
if (isset($_POST["delete_faculty"]) && !empty($_POST["delete_faculty"])) {
    $sql = "DELETE FROM faculties WHERE faculty_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_faculty_id);

        // Set parameters
        $param_faculty_id = $_POST["delete_faculty"];

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $_SESSION['guul'] = "success"; // Set session variable for success
            $_SESSION['message'] = "Data saved successfully"; // Set success message
        } else {
            // Error saving data
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
        }
    }

    // Close statement
    $stmt->close();
}


$query = "SELECT * FROM faculties";
if (!empty($facultyFilter)) {
    $query .= " AND faculty_id = '$facultyFilter'";
}
if (!empty($batchFilter)) {
    $query .= " AND faculty_id = '$batchFilter'";
}
// Execute the query
$result = mysqli_query($conn, $query);

?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Faculty</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Faculty</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a class="btn btn-primary filter-btn" href="add_faculty.php" id="filter_search">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Loop through each row of the result set
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><a href="view-estimate.html"><?php echo $row['faculty_id']; ?></a></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- Edit button -->
                                                        <form action="./edit_faculty.php" method="post">
                                                            <input type="hidden" name="edit_faculty" value="<?php echo $row['faculty_id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </button>
                                                        </form>
                                                        <form action="faculties.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                            <input type="hidden" name="delete_faculty" value="<?php echo $row['faculty_id']; ?>">
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