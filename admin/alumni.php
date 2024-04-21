<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');


if (isset($_POST['edit_alumni'])) {
    $id = $_POST['edit_alumni'];
    $student_id = $_POST['student_id'];
    $first_name = $_POST['FirstName'];
    $last_name = $_POST['LastName'];
    $sex = $_POST['Sex'];
    $email = $_POST['Email'];
    $dob = $_POST['Dob'];
    $contact_number = $_POST['ContactNumber'];
    $address = $_POST['Address'];
    $empl_state = $_POST['empl_state'];
    $studying_state = $_POST['StuddingState'];
    $faculty_id = $_POST['faculty_id'];
    $degree_type = $_POST['DegreeType'];
    $enrollment_year = $_POST['EnrollmentYear'];
    $batch_id = $_POST['batch_id'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    // Construct the SQL update query
    $query = "UPDATE alumni SET 
    student_id = '$student_id',
    FirstName = '$first_name',
    LastName = '$last_name',
    Sex = '$sex',
    Email = '$email',
    Dob = '$dob',
    ContactNumber = '$contact_number',
    Address = '$address',
    empl_state = '$empl_state',
    StuddingState = '$studying_state',
    faculty_id = '$faculty_id',
    DegreeType = '$degree_type',
    EnrollmentYear = '$enrollment_year',
    batch_id = '$batch_id',
    Username = '$username',
    Password = '$password'
    WHERE Id = $id";
    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_POST['delete_alumni'])) {
    // Get the ID of the user record to be deleted
    $id = $_POST['delete_alumni'];
    // Delete query
    $query = "DELETE FROM alumni WHERE Id = $id";
    // Execute the delete query
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Data saved successfully
        $_SESSION['guul'] = "success"; // Set session variable for success
        $_SESSION['message'] = "Data saved successfully"; // Set success message
    } else {
        // Error saving data
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
    }
}
// Initialize filter variables
$facultyFilter = isset($_POST['facultyFilter']) ? $_POST['facultyFilter'] : '';
$batchFilter = isset($_POST['batchFilter']) ? $_POST['batchFilter'] : '';
// Construct the SQL query based on filter values
$query = "SELECT * FROM alumni WHERE 1=1";
if (!empty($facultyFilter)) {
    $query .= " AND faculty_id = '$facultyFilter'";
}
if (!empty($batchFilter)) {
    $query .= " AND batch_id = '$batchFilter'";
}

// Execute the query
$result = mysqli_query($conn, $query);
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Alumni</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Alumni</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
                        <i class="fas fa-filter"></i>
                    </a>
                </div>
            </div>
        </div>

        <div id="filter_inputs" class="card filter-card">
            <div class="card-body pb-0">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Faculty</label>
                                <select class="form-control" name="facultyFilter" id="facultyFilter">
                                    <option value="">Select Faculty</option>
                                    <?php
                                    $facultyQuery = "SELECT * FROM faculties";
                                    $facultyResult = mysqli_query($conn, $facultyQuery);
                                    if (mysqli_num_rows($facultyResult) > 0) {
                                        while ($row = mysqli_fetch_assoc($facultyResult)) {
                                            $selected = ($row['faculty_id'] == $facultyFilter) ? 'selected' : '';
                                            echo '<option value="' . $row['faculty_id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Batch</label>
                                <select class="form-control" name="batchFilter" id="batchFilter">
                                    <option value="">Select Batch</option>
                                    <?php
                                    $batchQuery = "SELECT * FROM batch";
                                    $batchResult = mysqli_query($conn, $batchQuery);
                                    if (mysqli_num_rows($batchResult) > 0) {
                                        while ($row = mysqli_fetch_assoc($batchResult)) {
                                            $selected = ($row['batch_id'] == $batchFilter) ? 'selected' : '';
                                            echo '<option value="' . $row['batch_id'] . '" ' . $selected . '>' . $row['batch_year'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary" id="filterButton">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                                        <th>Enrollment Year</th>
                                        <th>Faculty</th>
                                        <th>Batch</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Loop through each row of the result set
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><a href="view-estimate.html"><?php echo $row['Id']; ?></a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="profile.php?alumni_id=<?= $row['Id'] ?>"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="<?php echo appURL; ?>/assets/img/sawir/one.jpg" alt="User Image"> <?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></a>
                                                </h2>
                                            </td>
                                            <td><?php echo $row['EnrollmentYear']; ?></td>
                                            <td>
                                                <?php
                                                // Fetch faculty name based on faculty_id
                                                $facultyId = $row['faculty_id'];
                                                $facultyQuery = "SELECT name FROM faculties WHERE faculty_id = $facultyId";
                                                $facultyResult = mysqli_query($conn, $facultyQuery);

                                                if ($facultyData = mysqli_fetch_assoc($facultyResult)) {
                                                    echo $facultyData['name'];
                                                } else {
                                                    echo "Unknown Faculty"; // If faculty name not found
                                                }
                                                ?>
                                            </td>

                                            <td><?php echo $row['batch_id']; ?></td>
                                            <?php if ($row['empl_state'] == 'Employed') {
                                                $color = 'success';
                                            } else {
                                                $color = 'warning';
                                            } ?>
                                            <td><span class="badge bg-<?php echo $color; ?>-light"><?php echo $row['empl_state']; ?></span></td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- Edit button -->
                                                        <form action="./edit_alumni.php" method="post">
                                                            <input type="hidden" name="edit_alumni" value="<?php echo $row['Id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-edit me-2"></i>Edit
                                                            </button>
                                                        </form>
                                                        <form action="alumni.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                            <input type="hidden" name="delete_alumni" value="<?php echo $row['Id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                            </button>
                                                        </form>

                                                        <form action="./profile.php" method="post">
                                                            <input type="hidden" name="profile" value="<?php echo $row['Id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-eye me-2"></i>View
                                                            </button>
                                                        </form>
                                                        </form>
                                                        <form action="./chat.php" method="post">
                                                            <input type="hidden" name="edit_user" value="<?php echo $row['Id']; ?>">
                                                            <button class="dropdown-item btn btn-sm" type="submit">
                                                                <i class="far fa-paper-plane me-2"></i>Chat
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

<?php
include('../includes/footer.php');
?>