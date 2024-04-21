<?php
session_start();
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['faculty_submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $faculty_phone = $_POST['faculty_phone'];

    // Prepare INSERT statement
    $sql = "INSERT INTO faculties (name, email, phone) VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("sss", $name, $email, $faculty_phone);
        if ($stmt->execute()) {
            // Data inserted successfully
            $_SESSION['guul'] = "success"; // Set session variable for success
            $_SESSION['message'] = "Faculty added successfully"; // Set success message
            echo "<script>window.location.href = 'faculties.php';</script>";

            // Exit to prevent further execution
        } else {
            // Error handling
            $_SESSION['guul'] = "fail"; // Set session variable for error
            $_SESSION['message'] = "Error: "  . $stmt->error; // Set error message
            echo "<script>window.location.href = 'ad_faculty.php';</script>";
        }
        // Close the statement
        $stmt->close();
    } else {
        // Error handling
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . $conn->error; // Set error message
    }
}
?>

<div class="page-wrapper">
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
                        <h4 class="card-title">Add Faculty</h4>
                    </div>
                    <div class="card-body">
                        <form action="add_faculty.php" method="post">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Faculty Name</label>
                                        <input type="text" required name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Faculty Email</label>
                                        <input type="email" required name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="text" required name="faculty_phone" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" name="faculty_submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/select2/js/select2.min.js"></script>
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/datatables.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>


<?php include('../includes/footer.php'); ?>