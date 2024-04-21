<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

// Retrieve form data
$status = $_POST['status']; // Report Type
$faculty_id = $_POST['faculty_id']; // Selected Faculty
$batch_id = $_POST['batch_id']; // Selected Batch
if ($status == 'All' && $faculty_id == 'All' && $batch_id = 'All') {
    $sql = "SELECT CONCAT(FirstName, ' ', LastName) AS FullName, ContactNumber, Address, DegreeType, empl_state, faculty_id 
        FROM alumni";
} else if ($status != 'All' && $faculty_id == 'All' && $batch_id = 'All') {
    $sql = "SELECT CONCAT(FirstName, ' ', LastName) AS FullName, ContactNumber, Address, DegreeType, empl_state, faculty_id 
        FROM alumni WHERE empl_state = '$status' ";
} else if ($status != 'All' && $faculty_id != 'All' && $batch_id = 'All') {
    $sql = "SELECT CONCAT(FirstName, ' ', LastName) AS FullName, ContactNumber, Address, DegreeType, empl_state, faculty_id 
        FROM alumni WHERE empl_state = '$status' AND faculty_id = '$faculty_id' ";
} else {
    $sql = "SELECT CONCAT(FirstName, ' ', LastName) AS FullName, ContactNumber, Address, DegreeType, empl_state, faculty_id 
        FROM alumni WHERE faculty_id = '$faculty_id' AND batch_id = '$batch_id' AND empl_state = '$status'";
}
// Execute the query
$result = mysqli_query($conn, $sql);
// Close connection
mysqli_close($conn);
?>
<div class="page-wrapper">
    <header class="mt-6"> <!-- Added mt-4 class for top margin -->
        <h1 class="report-title">Eelo University</h1>
        <h2 class="report-subtitle">Library Management System</h2>
        <address>
            <p>saylici Road, Borama, Awdal, Somaliland.</p>
            <p>(+252) 63 4456789</p>
        </address>
    </header>

    <div class="content container-fluid">
        <div class="page-header">
            <h3 class="page-title"><?php echo 'Employment state: ' . $status ?></h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?php echo 'Faculty: ' . $faculty_id;  ?></li>
                <li class="breadcrumb-item active"><?php echo 'Batch Id: ' . $batch_id; ?></li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Contact Number</th>
                                <th>Address</th>
                                <th>Degree Type</th>
                                <th>Employment State</th>
                                <th>Faculty ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the fetched data and display it in rows
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['FullName'] . "</td>";
                                echo "<td>" . $row['ContactNumber'] . "</td>";
                                echo "<td>" . $row['Address'] . "</td>";
                                echo "<td>" . $row['DegreeType'] . "</td>";
                                echo "<td>" . $row['empl_state'] . "</td>";
                                echo "<td>" . $row['faculty_id'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center print-button">
                    <button class="btn btn-primary" onclick="window.print()">Print</button>
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
<script src="<?php echo appURL; ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo appURL; ?>/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo appURL; ?>/assets/plugins/datatables/datatables.min.js"></script>
<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

<?php include('../includes/footer.php'); ?>