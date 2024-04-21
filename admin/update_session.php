<?php
session_start();
include('../includes/conn.php');

if (isset($_POST['userId'])) {
    $_SESSION['to'] = $_POST['userId'];
    echo "Session updated successfully.";
} else {
    echo "Failed to update session.";
}
