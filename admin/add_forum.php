<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

// Fetch faculties data for dropdown
$facultyQuery = "SELECT faculty_id, name FROM faculties";
$facultyResult = mysqli_query($conn, $facultyQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission
    $title = $_POST['title'];
    $content = $_POST['content'];
    $facultyId = $_POST['faculty_id']; // Get selected faculty ID from the form

    // Check if faculty_id already exists
    $checkQuery = "SELECT COUNT(*) as count FROM discussion_forum WHERE faculty_id = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "i", $facultyId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $facultyExists = $row['count'] > 0;

    if ($facultyExists) {
        echo "The forum already EXISTS";
    } else {
        // Prepare INSERT statement
        $insertQuery = "INSERT INTO discussion_forum (title, description, faculty_id) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);

        if ($stmt) {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $facultyId);
            $success = mysqli_stmt_execute($stmt);

            if ($success) {
                // Data saved successfully
                $_SESSION['guul'] = "success"; // Set session variable for success
                $_SESSION['message'] = "Data saved successfully"; // Set success message
                echo "<script>window.location.href = 'forum.php';</script>";
            } else {
                // Error saving data
                $_SESSION['guul'] = "fail"; // Set session variable for error
                $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
                echo "<script>window.location.href = 'add_forum.php';</script>";
            }
        } else {
            // Error preparing statement
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
            echo "<script>window.location.href = 'forum.php';</script>";
        }
    }
    // Redirect to the page where you want to display the SweetAlert
    // Make sure to exit after redirecting
}
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <h3 class="page-title">Create Discussion Forum Post</h3>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="mb-3 col-lg-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label for="faculty_id" class="form-label">Faculty</label>
                                <select class="form-select" id="faculty_id" name="faculty_id" required>
                                    <option value="">Select Faculty</option>
                                    <?php
                                    if (mysqli_num_rows($facultyResult) > 0) {
                                        while ($row = mysqli_fetch_assoc($facultyResult)) {
                                            echo '<option value="' . $row['faculty_id'] . '">' . $row['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
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

<?php include '../includes/footer.php'; ?>