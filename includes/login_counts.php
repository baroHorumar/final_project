<?php
// Establish database connection
require_once '../includes/conn.php'; // Adjust as needed

// Initialize an array to hold the counts for each month
$login_counts_by_month = array_fill(1, 12, 0);

// Query to count login events for each month of the current year
$query = "SELECT MONTH(login_time) AS login_month, COUNT(*) AS login_count 
          FROM login_events 
          WHERE YEAR(login_time) = YEAR(CURRENT_DATE)
          GROUP BY login_month";

$result = mysqli_query($conn, $query);

// Process the query result
while ($row = mysqli_fetch_assoc($result)) {
    $month_number = $row['login_month'];
    $login_count = $row['login_count'];

    // Update login counts array
    $login_counts_by_month[$month_number] = $login_count;
}

// Output the login counts by month as JSON
header('Content-Type: application/json');
echo json_encode($login_counts_by_month);
