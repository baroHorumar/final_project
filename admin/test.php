<?php
session_start();
// Include database connection
include('../includes/conn.php');

// Fetch the latest messages from the database for both sender and receiver
$query = "SELECT m.Message, CONCAT(a.FirstName, ' ', a.LastName) AS SenderName, m.Timestamp
          FROM chat m
          INNER JOIN alumni a ON m.SenderId = a.Id
          WHERE m.ReceiverId = ? OR m.SenderId = ?
          ORDER BY m.Timestamp DESC
          LIMIT 1";
$stmt = mysqli_prepare($conn, $query);
$current_user_id = $_SESSION['id'];
mysqli_stmt_bind_param($stmt, "ii", $current_user_id, $current_user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Prepare an array to hold the latest messages
$latest_messages = array();

// Fetch the latest message details
while ($row = mysqli_fetch_assoc($result)) {
    $latest_messages[] = array(
        'sender' => $row['SenderName'],
        'message' => $row['Message'],
        'timestamp' => $row['Timestamp']
    );
}

// Return the latest messages as JSON
echo json_encode($latest_messages);
echo 'current user:' . $_SESSION['id'];
