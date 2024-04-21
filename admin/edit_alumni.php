<?php
session_start();

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
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
                        <h4 class="card-title">Edit Alumni</h4>
                    </div>
                    <div class="card-body">
                        <form action="./code.php" method="post">
                            <div class="row">
                                <?php
                                if (isset($_POST['edit_alumni'])) {
                                    // Get the ID from the form submission
                                    $id = $_POST['edit_alumni'];

                                    // Assuming you have a database connection already established

                                    // Perform the query to fetch the data
                                    $query = "SELECT * FROM alumni WHERE id = $id";
                                    $result = mysqli_query($conn, $query);

                                    // Check if the query was successful
                                    if ($result) {
                                        // Fetch the data from the result set
                                        $row = mysqli_fetch_assoc($result);

                                        // Now $row contains the data for the alumni with the specified ID
                                        // You can use $row['column_name'] to access individual fields
                                ?>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Student ID</label>
                                                <input type="text" value="<?php echo $row['Id']; ?>" required name="student_id" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">First Name</label>
                                                <input type="text" required name="FirstName" value="<?php echo $row['FirstName'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" required name="LastName" value="<?php echo $row['LastName'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Sex</label>
                                                <select name="Sex" class="form-control" required>
                                                    <option value="">Select Sex</option>
                                                    <option value="Male" <?php if ($row['Sex'] == 'Male') echo 'selected'; ?>>Male</option>
                                                    <option value="Female" <?php if ($row['Sex'] == 'Female') echo 'selected'; ?>>Female</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <input type="email" required value="<?php echo $row['Email'] ?>" name="Email" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Date of Birth</label>
                                                <input type="date" required name="Dob" value="<?php echo $row['Dob']; ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" required value="<?php echo $row['Email']; ?>" name="ContactNumber" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <textarea name="Address" value="<?php echo $row['Address']; ?>" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Employment State</label>
                                                <input type="text" required value="<?php echo $row['empl_state']; ?>" name="empl_state" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Studying State</label>
                                                <input type="text" value="<?php echo $row['StuddingState']; ?>" required name="StuddingState" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Faculty ID</label>
                                                <input type="text" value="<?php echo $row['faculty_id']; ?>" required name="faculty_id" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Degree Type</label>
                                                <select name="DegreeType" class="form-control" required>
                                                    <option value="<?php echo $row['DegreeType']; ?>"><?php echo $row['DegreeType']; ?></option>
                                                    <option value="Bachelor">Bachelor</option>
                                                    <option value="Master">Master</option>
                                                    <option value="Diploma">Diploma</option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label class="form-label">Enrollment Year</label>
                                                <input type="text" value="<?php echo $row['batch_id'] ?>" required name="EnrollmentYear" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Batch ID</label>
                                                <input type="text" value="<?php echo $row['batch_id'] ?>" required name="batch_id" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Image</label>
                                                <input type="file" name="Img" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Username</label>
                                                <input type="text" value="<?php echo $row['Username'] ?>" required name="Username" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Password</label>
                                                <input type="password" value="<?php echo $row['Password'] ?>" required name="Password" class="form-control">
                                            </div>

                                        </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <button type="submit" name="edit_alumni" value="<?php echo $row['Id'] ?>" class="btn btn-primary">Submit</button>
                                    <button type="close" class="btn btn-light">Cancel</button>
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

<script src="<?php echo appURL; ?>/assets/js/jquery-3.6.0.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/feather.min.js"></script>

<script src="<?php echo appURL; ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

<?php
include('../includes/footer.php');
?>