<?php
session_start();

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
if (isset($_POST['edit_alumni'])) {
    // Get the ID of the alumni record to be updated
    $id = $_POST['edit_alumni'];

    // Retrieve other form data
    $email = $_POST['Email'];
    $contactNumber = $_POST['ContactNumber'];
    $address = $_POST['Address'];
    $employmentState = $_POST['EmploymentState'];
    $studyingState = $_POST['StuddingState'];
    $degreeType = $_POST['DegreeType'];
    $fid = $_POST['Fid'];
    $linked = $_POST['Linked'];
    $tweet = $_POST['Tweet'];

    // Update query
    $query = "UPDATE alumni SET 
                Email = '$email', 
                ContactNumber = '$contactNumber', 
                Address = '$address', 
                empl_state = '$employmentState', 
                StuddingState = '$studyingState', 
                DegreeType = '$degreeType', 
                Fid = '$fid', 
                Linked = '$linked', 
                Tweet = '$tweet' 
                WHERE Id = $id";

    // Execute the update query
    $result = mysqli_query($conn, $query);

    // Check if update was successful
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
                        <form action="alumni_edit_profile.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <?php
                                if (isset($_POST['userID'])) {
                                    // Get the ID from the form submission
                                    $id = $_POST['userID'];

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
                                                <label class="form-label">Email</label>
                                                <input type="email" required value="<?php echo $row['Email'] ?>" name="Email" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" required value="<?php echo $row['ContactNumber']; ?>" name="ContactNumber" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <input type="text" required value="<?php echo $row['Address']; ?>" name="Address" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Employment State</label>
                                                <select name="EmploymentState" class="form-control" required>
                                                    <option value="<?php echo $row['empl_state']; ?>"><?php echo $row['empl_state']; ?></option>
                                                    <option value="Employed">Employed</option>
                                                    <option value="Unemployed">Unemployed</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Facebook ID</label>
                                                <input type="text" value="<?php echo $row['Fid']; ?>" name="Fid" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Studying State</label>
                                                <select name="StuddingState" class="form-control" required>
                                                    <option value="<?php echo $row['StuddingState']; ?>"><?php echo $row['StuddingState']; ?></option>
                                                    <option value="Still Studying">Still Studying</option>
                                                    <option value="Taking Break">Taking Break</option>
                                                </select>
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
                                                <label class="form-label">Image</label>
                                                <input type="file" name="Img" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">LinkedIn</label>
                                                <input type="text" value="<?php echo $row['Linked']; ?>" name="Linked" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Twitter</label>
                                                <input type="text" value="<?php echo $row['Tweet']; ?>" name="Tweet" class="form-control">
                                            </div>
                                        </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <button type="submit" name="edit_alumni" value="<?php echo $row['Id'] ?>" class="btn btn-primary">Submit</button>
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
<script src="<?php echo appURL; ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/apexchart/chart-data.js"></script>
<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<script src="<?php echo appURL; ?>/assets/js/feather.min.js"></script>
<script src="<?php echo appURL; ?>/assets/js/ckeditor.js"></script>
<script src="<?php echo appURL; ?>/assets/js/select2.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
<script src="../assets/js/select2.min.js"></script>

<?php

include('../includes/footer.php');
?>