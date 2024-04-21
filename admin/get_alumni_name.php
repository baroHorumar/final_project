<?php
session_start();
include('../includes/conn.php');

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    // Fetch the alumni's name from the database based on the ID
    $query = "SELECT FirstName, LastName FROM alumni WHERE Id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['FirstName'] . " " . $row['LastName']; // Concatenating first name and last name with a space
    } else {
        echo "User not found";
    }
} else {
    echo "User ID not provided";
}
