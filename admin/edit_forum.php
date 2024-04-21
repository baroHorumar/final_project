<?php
// Include necessary files
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

// Fetch faculties data for dropdown
$facultyQuery = "SELECT faculty_id, name FROM faculties";
$facultyResult = mysqli_query($conn, $facultyQuery);

// Check if form is submitted
if (
    $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_forum'])
) {
    // Retrieve form data
    $id = $_POST['edit_forum'];

    // Fetch existing data
    $selectQuery = "SELECT * FROM discussion_forum WHERE id=?";
    $stmt = mysqli_prepare($conn, $selectQuery);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
        exit; // Exit script if error occurs
    }
} else {
    // Redirect to an appropriate page if form data is not submitted or incorrect
    header("Location: ./desired_location.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-forum'], $_POST['title'], $_POST['content'], $_POST['faculty_id'], $_POST['edit_forum'])) {
    // Process form submission
    $id = $_POST['edit_forum'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $facultyId = $_POST['faculty_id'];

    // Perform database update
    $updateQuery = "UPDATE discussion_forum SET title=?, description=?, faculty_id=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssii", $title, $content, $facultyId, $id);
        $success = mysqli_stmt_execute($stmt);
        if ($success) {
            $_SESSION['guul'] = "success"; // Set session variable for success
            $_SESSION['message'] = "Data saved successfully"; // Set success message
        } else {
            // Error saving data
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
        }
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <h3 class="page-title">Edit Discussion Forum Post</h3>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="edit_forum.php">
                            <input type="hidden" name="edit_forum" value="<?php echo $row['id']; ?>">
                            <div class="mb-3 col-lg-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label for="faculty_id" class="form-label">Faculty</label>
                                <select class="form-select" id="faculty_id" name="faculty_id" required>
                                    <option value="">Select Faculty</option>
                                    <?php
                                    if (mysqli_num_rows($facultyResult) > 0) {
                                        while ($facultyRow = mysqli_fetch_assoc($facultyResult)) {
                                            $selected = ($facultyRow['faculty_id'] == $row['faculty_id']) ? 'selected' : '';
                                            echo '<option value="' . $facultyRow['faculty_id'] . '" ' . $selected . '>' . $facultyRow['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $row['description']; ?></textarea>
                            </div>

                            <button type="submit" name="update-forum" class="btn btn-primary">Update</button>
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