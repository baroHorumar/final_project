<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php'); // Include your database connection file

if (isset($_FILES['csvFile']) && !empty($_FILES['csvFile']['tmp_name'])) {
    $file = $_FILES['csvFile']['tmp_name'];

    // Open the CSV file for reading
    if (($handle = fopen($file, "r")) !== FALSE) {
        // Read the CSV headers
        $headers = fgetcsv($handle, 1000, ",");
        // Loop through each row of the CSV file
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Assign CSV values to variables
            $student_id = $data[0];
            $FirstName = $data[1];
            $LastName = $data[2];
            $Sex = $data[3];
            $Email = $data[4];
            $Img = $data[5];
            $Dob = $data[6];
            $ContactNumber = $data[7];
            $Address = $data[8];
            $empl_state = $data[9];
            $StuddingState = $data[10];
            $faculty_id = $data[11];
            $DegreeType = $data[12];
            $EnrollmentYear = $data[13];
            $batch_id = $data[14];
            $Fid = $data[15];
            $Linked = $data[16];
            $Tweet = $data[17];
            $Username = $data[18];
            $Password = $data[19];
            $Created_at = $data[20];
            $Updated_at = $data[21];
            $Created_by = $data[22];
            $Updated_by = $data[23];

            // Insert data into the database
            $sql = "INSERT INTO alumni (student_id, FirstName, LastName, Sex, Email, Img, Dob, ContactNumber, Address, empl_state, StuddingState, faculty_id, DegreeType, EnrollmentYear, batch_id, Fid, Linked, Tweet, Username, Password, Created_at, Updated_at, Created_by, Updated_by) VALUES ('$student_id', '$FirstName', '$LastName', '$Sex', '$Email', '$Img', '$Dob', '$ContactNumber', '$Address', '$empl_state', '$StuddingState', '$faculty_id', '$DegreeType', '$EnrollmentYear', '$batch_id', '$Fid', '$Linked', '$Tweet', '$Username', '$Password', '$Created_at', '$Updated_at', '$Created_by', '$Updated_by')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['guul'] = "success"; // Set session variable for success
                $_SESSION['message'] = "Data saved successfully"; // Set success message
            } else {
                // Error saving data
                $_SESSION['guul'] = "fail"; // Set session variable for error
                $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
            }
        }

        // Close the file handle
        fclose($handle);
    }
}
?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles mx-3 ">
            <div class="col-sm-6 p-md-2">
                <div class="welcome-text">
                    <h4>Upload Students CSV File</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Choose a CSV File to Upload</h4>
                    </div>
                    <div class="card-body">
                        <form action="uplaod_alumni.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="csvFile">Choose CSV File</label>
                                <div class="custom-file">
                                    <input type="file" required class="custom-file-input" id="csvFile" name="csvFile" accept=".csv">
                                    <label class="custom-file-label" for="csvFile">Choose file</label>
                                </div>
                            </div>
                            <button type="submit" name="csvFile" class="btn btn-primary btn-sm">Upload</button>
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
<?php
include('../includes/footer.php');
?>