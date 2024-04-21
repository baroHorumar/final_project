<?php
// Establish database connection
require_once '../includes/conn.php'; // Adjust as needed

// Initialize an array to hold login counts for each day
$login_counts_by_day = array();

// Query to count login events for each day over the last 15 days
$query = "SELECT DATE(login_time) AS login_date, COUNT(*) AS login_count 
          FROM login_events 
          WHERE login_time >= DATE_SUB(CURDATE(), INTERVAL 14 DAY) 
          GROUP BY login_date";

$result = mysqli_query($conn, $query);

// Process the query result
while ($row = mysqli_fetch_assoc($result)) {
    $login_date = $row['login_date'];
    $login_count = $row['login_count'];

    // Update login counts array
    $login_counts_by_day[$login_date] = $login_count;
}

// Output the login counts by day as JSON
header('Content-Type: application/json');
echo json_encode($login_counts_by_day);
