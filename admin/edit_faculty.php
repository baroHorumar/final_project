<?php
session_start();

include('../includes/conn.php');


if (isset($_POST['edit_batch1'])) {
    // Retrieve form data
    $faculty_id = $_POST['edit_batch1'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Prepare UPDATE statement
    $sql = "UPDATE faculties SET name = ?, email = ?, phone = ? WHERE faculty_id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("sssi", $name, $email, $phone, $faculty_id);
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
        $stmt->close();
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
                        <h4 class="card-title">Edit Faculty</h4>
                    </div>
                    <div class="card-body">
                        <form action="edit_faculty.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <?php
                                if (isset($_POST['edit_faculty'])) {
                                    // Get the ID from the form submission
                                    $id = $_POST['edit_faculty'];
                                    $query = "SELECT * FROM faculties WHERE faculty_id = $id";
                                    $result = mysqli_query($conn, $query);

                                    // Check if the query was successful
                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                ?>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">faculty Name</label>
                                                <input type="text" required value="<?php echo $row['name'] ?>" name="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <input type="text" required value="<?php echo $row['email']; ?>" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Phone</label>
                                                <input type="text" required value="<?php echo $row['phone']; ?>" name="phone" class="form-control">
                                            </div>
                                        </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <button type="submit" name="edit_batch1" value="<?php echo $row['faculty_id'] ?>" class="btn btn-primary">Submit</button>
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