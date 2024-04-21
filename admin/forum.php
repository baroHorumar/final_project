<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_forum'])) {
    // Retrieve the ID of the record to be deleted
    $forumId = $_POST['delete_forum'];
    // Prepare SQL DELETE statement
    $deleteQuery = "DELETE FROM discussion_forum WHERE id = ?";

    // Prepare and execute the statement
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $forumId);
    $success = mysqli_stmt_execute($stmt);

    if ($success) {
        $_SESSION['guul'] = "success"; // Set session variable for success
        $_SESSION['message'] = "Data saved successfully"; // Set success message
    } else {
        // Error saving data
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Construct the SQL query
$query = "SELECT * FROM discussion_forum";

// Execute the query
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Discussion Forums</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Discussion Forums</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a class="btn btn-primary filter-btn" href="add_forum.php" id="filter_search">
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
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Faculty ID</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Loop through each row of the result set
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo implode(' ', array_slice(explode(' ', $row['description']), 0, 10)); ?></td>
                                            <td><?php echo $row['faculty_id']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td><?php echo $row['updated_at']; ?></td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- Edit button -->
                                                        <form action="./edit_forum.php" method="post">
                                                            <input type="hidden" name="edit_forum" value="<?php echo $row['id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </button>
                                                        </form>

                                                        <form action="forum.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                            <input type="hidden" name="delete_forum" value="<?php echo $row['id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                            </button>
                                                        </form>
                                                        <form action="forum_chat.php" method="post">
                                                            <input type="hidden" name="forum_id" value="<?php echo $row['id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit" name="chat_button"> <!-- Add name attribute -->
                                                                <i class="far fa-eye me-2"></i>View
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
<script src="../assets/js/select2.min.js"></script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/select2/js/select2.min.js"></script>
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/datatables.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>

</html>