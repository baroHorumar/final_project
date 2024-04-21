<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

$status = "All"; // Default status
$from_date = "";
$to_date = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get filter values from form
    $status = $_POST['status'] ?? "All";
    $from_date = $_POST['from_date'] ?? "";
    $to_date = $_POST['to_date'] ?? "";
}

// Initialize SQL query
$sql = "SELECT id, alumni_id, number_of_downloads, created_at, title FROM materials";

// Apply filter conditions
if ($status == "All") {
    // Apply date filter if provided
    if ($from_date != "" && $to_date != "") {
        $sql .= " WHERE created_at BETWEEN '$from_date' AND '$to_date'";
    }
} elseif ($status == 'Number') {
    $sql .= " ORDER BY number_of_downloads DESC";
}

$result = mysqli_query($conn, $sql);

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
            <h3 class="page-title"><?php echo $status ?></h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><?php echo $from_date ?></li>
                <li class="breadcrumb-item active"><?php echo $to_date ?></li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Alumni ID</th>
                                <th>Number of Downloads</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the fetched data and display it in rows
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>" . $row['alumni_id'] . "</td>";
                                echo "<td>" . $row['number_of_downloads'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
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
<?php
include('../includes/footer.php');
?>