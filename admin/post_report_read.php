<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');

$status = "";
$from_date = "";
$to_date = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get filter values from form
    $status = $_POST['status'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
}

// Initialize SQL query
$sql = "SELECT b.id, b.title, b.category, b.created_at, b.alumni_id, b.status";
// Apply filter conditions
if ($status == "All") {
    $sql .= " FROM blog b WHERE 1=1"; // Start with a true condition
    if ($from_date != "" && $to_date != "") {
        $sql .= " AND b.created_at BETWEEN '$from_date' AND '$to_date'";
    }
} elseif ($status == 'pending' || $status == 'approved') {
    $sql .= " FROM blog b WHERE b.status = '$status'";
    if ($from_date != "" && $to_date != "") {
        $sql .= " AND b.created_at BETWEEN '$from_date' AND '$to_date'";
    }
} elseif ($status == 'Most Read') {
    // Fetch most read blogs
    $sql = "SELECT * FROM blog ORDER BY Num_of_read DESC";
} elseif ($status == 'Most Commented') {
    $sql .= ", COUNT(c.post_id) AS comment_count 
            FROM blog b
            LEFT JOIN comments c ON b.id = c.post_id
            GROUP BY b.id, b.title, b.category, b.created_at, b.alumni_id, b.status
            ORDER BY comment_count DESC";
}

$result = mysqli_query($conn, $sql);

function shortenTitle($title)
{
    $words = explode(' ', $title);
    if (count($words) > 3) {
        $shortenedTitle = implode(' ', array_slice($words, 0, 2)) . '...';
        return $shortenedTitle;
    } else {
        return $title;
    }
}
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
                                <th>Category</th>
                                <th>Created At</th>
                                <th>Alumni ID</th>
                                <?php if ($status == 'Most Read') : ?>
                                    <th>Number of Reads</th>
                                <?php else : ?>
                                    <th>Status</th>
                                <?php endif; ?>
                                <?php if ($status == 'Most Commented') : ?>
                                    <th>Comment Number</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the fetched data and display it in rows
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";

                                // Function to shorten the title to 5 words and add ellipsis
                                echo "<td>" . shortenTitle($row['title']) . "</td>";

                                echo "<td>" . $row['category'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>" . $row['alumni_id'] . "</td>";
                                if ($status == 'Most Read') {
                                    echo "<td>" . $row['Num_of_read'] . "</td>"; // Display number of reads
                                } else {
                                    echo "<td>" . $row['status'] . "</td>"; // Display status
                                }
                                if ($status == 'Most Commented') {
                                    echo "<td>" . $row['comment_count'] . "</td>";
                                }
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