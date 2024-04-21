<?php
session_start();

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
//include('../includes/conn.php');

if (isset($_POST['add_alumni'])) {
    $student_id = $_POST['student_id'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $sex = $_POST['Sex'];
    $email = $_POST['Email'];
    $img = ''; // Placeholder for image file, handle separately if needed
    $dob = $_POST['Dob'];
    $contactNumber = $_POST['ContactNumber'];
    $address = $_POST['Address'];
    $empl_state = $_POST['empl_state'];
    $studdingState = $_POST['StuddingState'];
    $faculty_id = $_POST['faculty_id'];
    $degreeType = $_POST['DegreeType'];
    $enrollmentYear = $_POST['EnrollmentYear'];
    $batch_id = $_POST['batch_id'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    // Perform database insertion
    $query = "INSERT INTO alumni (student_id, FirstName, LastName, Sex, Email, Img, Dob, ContactNumber, Address, empl_state, StuddingState, faculty_id, DegreeType, EnrollmentYear, batch_id, Username, Password) 
                  VALUES ('$student_id', '$firstName', '$lastName', '$sex', '$email', '$img', '$dob', '$contactNumber', '$address', '$empl_state', '$studdingState', '$faculty_id', '$degreeType', '$enrollmentYear', '$batch_id', '$username', '$password')";
    $result = mysqli_query($conn, $query);
    // Check if insertion was successful
    if ($result) {
        // Data saved successfully
        $_SESSION['guul'] = "success"; // Set session variable for success
        $_SESSION['message'] = "Data saved successfully"; // Set success message
        echo '<script>window.location.href = "alumni.php";</script>';
    } else {
        // Error saving data
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
        echo '<script>window.location.href = "add_alumni.php";</script>';
    }
}

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
                        <h4 class="card-title">Add Alumni</h4>
                    </div>
                    <div class="card-body">
                        <form action="add_alumni.php" method="post">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Student ID</label>
                                        <input type="text" required name="student_id" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input type="text" required name="FirstName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" required name="LastName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Sex</label>
                                        <select name="Sex" class="form-control" required>
                                            <option value="">Select Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" required name="Email" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" required name="Dob" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" required name="ContactNumber" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <textarea name="Address" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Sex</label>
                                        <select name="empl_state" class="form-control" required>
                                            <option value="">Employement state</option>
                                            <option value="Employed">Employed</option>
                                            <option value="Unemployed">Unemployed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Studying State</label>
                                        <select name="StuddingState" class="form-control" required>
                                            <option value="">Select studing state</option>
                                            <option value="Studding">Studding</option>
                                            <option value="Not Studing">Not Studing</option>
                                        </select>
                                    </div>
                                    <?php
                                    $query = "SELECT faculty_id, name FROM faculties";
                                    $result = mysqli_query($conn, $query);

                                    // Check if query executed successfully
                                    if ($result) {
                                        $faculties = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all rows as associative array
                                    } else {
                                        // Handle error if query fails
                                        echo "Error: " . mysqli_error($conn);
                                    }
                                    ?>

                                    <div class="form-group">
                                        <label class="form-label">Faculty ID</label>
                                        <select name="faculty_id" class="form-control" required>
                                            <option value="">Select Faculty</option>
                                            <?php
                                            // Iterate through fetched faculty data and create options
                                            foreach ($faculties as $faculty) {
                                            ?>
                                                <option value=" <?php echo $faculty['faculty_id']; ?>"> <?php echo $faculty['name']; ?></option>;
                                            <?php  }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Degree Type</label>
                                        <select name="DegreeType" class="form-control" required>
                                            <option value="">Select Degree Type</option>
                                            <option value="Bachelor">Bachelor</option>
                                            <option value="Master">Master</option>
                                            <option value="Diploma">Diploma</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Enrollment Year</label>
                                        <input type="text" required name="EnrollmentYear" class="form-control">
                                    </div>
                                    <?php
                                    // Assuming you have a database connection established already
                                    // Fetch batch data from the database
                                    $query = "SELECT batch_id, batch_year FROM batch";
                                    $result = mysqli_query($conn, $query);

                                    // Check if query executed successfully
                                    if ($result) {
                                        $batches = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all rows as associative array
                                    } else {
                                        // Handle error if query fails
                                        echo "Error: " . mysqli_error($conn);
                                    }

                                    // Close database connection
                                    mysqli_close($conn);
                                    ?>

                                    <div class="form-group">
                                        <label class="form-label">Batch ID</label>
                                        <select name="batch_id" class="form-control" required>
                                            <option value="">Select Batch</option>
                                            <?php
                                            // Iterate through fetched batch data and create options
                                            foreach ($batches as $batch) {
                                            ?>
                                                <option value="<?php echo $batch['batch_id']; ?>"> <?php echo  $batch['batch_year']; ?></option>
                                            <?php  }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="Img" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" required name="Username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="password" required name="Password" class="form-control">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <button type="submit" name="add_alumni" class="btn btn-primary">Submit</button>
                                    <button type="close" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
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
<?php
include('../includes/footer.php');
?>