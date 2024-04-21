<?php
// Assuming you have a database connection already established
include '../includes/conn.php';
// Fetch data
$query = "SELECT empl_state, COUNT(*) as count FROM alumni GROUP BY empl_state";
$result = mysqli_query($conn, $query);

// Process the fetched data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['empl_state']] = $row['count'];
}

// Prepare data for JSON response
$response = array(
    "employed" => isset($data['Employed']) ? $data['Employed'] : 0,
    "unemployed" => isset($data['Unemployed']) ? $data['Unemployed'] : 0
);

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
